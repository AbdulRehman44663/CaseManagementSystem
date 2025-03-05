<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\LawFirmInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\LawFirmInformationService;

class LawFirmInformationController extends Controller
{
    protected $lawFirmInformationService;
    public function __construct(LawFirmInformationService $lawFirmInformationService)
    {
        $this->lawFirmInformationService = $lawFirmInformationService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'law_firm_information';
        $this->data['controller_name'] = 'Law Firm Information';
        $this->data['data'] = LawFirmInformation::first();
        return view('admin.'.$this->data['controller'].'.add')->with($this->data);
    }

    public function update(Request $request)
    {
        $data = LawFirmInformation::first();

        $rules = [
            'company_name' => 'required|string',
            'attorney_1' => 'nullable|string',
            'attorney_2' => 'nullable|string', 
            'attorney_3' => 'nullable|string',
            'address' => 'nullable|string',
            'suite' => 'nullable|string',
            'city_state_zip' => 'nullable|string|regex:/^[A-Za-z ]+, [A-Z]{2} \d{5}$/',
            'telephone_no' => 'nullable|string|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'fax_no' => 'nullable|string|max:20|regex:/^\+?[0-9]{1,4}?[ -]?(\(?[0-9]{2,5}\)?)?[ -]?[0-9]{3,4}[ -]?[0-9]{3,4}$/',
            'email_address' => 'nullable|email',
            'email_signature' => 'nullable|string',
            'show_email_signature' => 'nullable|string',
        ];

        $messages = [
            'city_state_zip.regex' => 'The city, state, and ZIP format is invalid. Example: "Los Angeles, CA 90001".',
            'telephone_no.regex' => 'The telephone number format is invalid.',
            'fax_no.regex' => 'The fax number format is invalid.',
        ];
        
        // If no data exists, make logo_image and signature required
        if (!$data) {
            $rules = array_merge($rules, [
                'logo_image' => 'required|string|image|mimes:jpeg,png,gif',
                'signature' => 'required|string',
            ]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        
        $result = $this->lawFirmInformationService->update($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
}
