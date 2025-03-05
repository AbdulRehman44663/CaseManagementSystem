<?php

namespace App\Http\Controllers\admin;

use App\Models\BkCourtState;
use Illuminate\Http\Request;
use App\Models\CaseTypeSelection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BkCourtSelectedState;
use App\Models\ImmigrationCourtState;
use App\Models\BkCourtSelectedDistrict;
use App\Models\GenaralCourtState;
use App\Models\GeneralSelectedState;
use App\Models\GenSelectedCountry;
use App\Models\ImmigrationCourtSelectedState;
use App\Models\ImmSelectedState;

class CourtSelectorManagementController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['selected_cases'] = CaseTypeSelection::all();
        /// bk court ///
        $this->data['court_states'] = BkCourtState::with('courtDistricts')->get();
        $this->data['selected_court_states'] = BkCourtSelectedState::with('selectedCourtDistricts')->get();
      

        /// immigration court ///
        $this->data['immigration_court_states'] = ImmigrationCourtState::all();
        $this->data['immigration_selected_court_states'] = ImmSelectedState::all();

        /// general court ///
        $this->data['general_court_states'] = GenaralCourtState::with('generalCourtCountry')->get();
        $this->data['general_selected_states'] = GeneralSelectedState::with('selectedCourtCountry')->get();

        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'court_selector_management';
        $this->data['controller_name'] = 'Court Selector Management';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function bkCourtSelection(Request $request)
    {
        $type = $request->type;
        $stateId = $request->state_id;
        $districtId = $request->district_id;
        $checked = $request->checked;
        DB::beginTransaction();
    
        try {
            if ($type === "state") {
                if ($checked) {
                    BkCourtSelectedState::create(['bk_court_state_id' => $stateId]);
                } else {
                    BkCourtSelectedState::where('bk_court_state_id', $stateId)->delete();
                }
            } elseif ($type === "district") {
                if ($checked) {
                    $stateRecord = BkCourtSelectedState::where('bk_court_state_id', $stateId)->first();
    
                    if (!$stateRecord) {
                        throw new \Exception("State record not found.");
                    }
    
                    BkCourtSelectedDistrict::create([
                        'bk_court_selected_state_id' => $stateRecord->id,
                        'bk_court_district_id'       => $districtId,
                    ]);
                } else {
                    BkCourtSelectedDistrict::where('bk_court_district_id', $districtId)->delete();
                }
            }
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Checkbox updated successfully']);
    
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error('Error in update checkbox selection: ' . $th->getMessage());
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
    }

    public function bkCourtCaseTypeSelection(Request $request)
    {
        try {
            $caseType = $request->case_type;
            $checked = $request->checked;
    
            DB::beginTransaction();
    
            if ($checked) 
            {
                CaseTypeSelection::create(
                    [
                        'case_selection_name' => $caseType,
                        'selection_value'     => $checked,
                    ]
                );
               
            } else {
                CaseTypeSelection::where('case_selection_name', $caseType)->delete();
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Case type updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function immigrationCourtSelection(Request $request)
    {
        $stateId = $request->state_id;
        $checked = $request->checked;
        DB::beginTransaction();
    
        try {
            if ($checked) {
                ImmSelectedState::create(['immigration_court_state_id' => $stateId]);
            } else {
                ImmSelectedState::where('immigration_court_state_id', $stateId)->delete();
            }
             
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Checkbox updated successfully']);
    
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error('Error in update checkbox selection: ' . $th->getMessage());
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
    }

    public function generalCourtSelection(Request $request)
    {
        
        $type = $request->type;
        $stateId = $request->state_id;
        $countryId = $request->country_id;
        $checked = $request->checked;
        DB::beginTransaction();
    
        try {
            if ($type === "state") {
                if ($checked) {
                    GeneralSelectedState::create(['genaral_court_state_id' => $stateId]);
                } else {
                    GeneralSelectedState::where('genaral_court_state_id', $stateId)->delete();
                }
            } elseif ($type === "country") {
                if ($checked) {
                    $stateRecord = GeneralSelectedState::where('genaral_court_state_id', $stateId)->first();
    
                    if (!$stateRecord) {
                        throw new \Exception("State record not found.");
                    }
    
                    GenSelectedCountry::create([
                        'general_selected_state_id' => $stateRecord->id,
                        'genaral_court_country_other_id'       => $countryId,
                    ]);
                } else {
                    GenSelectedCountry::where('genaral_court_country_other_id', $countryId)->delete();
                }
            }
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Checkbox updated successfully']);
    
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error('Error in update checkbox selection: ' . $th->getMessage());
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
    }
}
