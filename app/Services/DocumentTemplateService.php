<?php

namespace App\Services;

use App\Models\DocumentTemplates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentTemplateService
{
    public function create($requestData)
    {
        try
        {
            DB::beginTransaction(); 
            
            $data = new DocumentTemplates();
            $data->case_type_id = $requestData['caseTypeId'];
            $data->title        = $requestData['template_name'];
            $data->body         = $requestData['document_body'];
            $data->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();  
            Log::error('Error in create document template: ' . $th->getMessage());
            return false;
        }
    }

    public function update($requestData, $id)
    {
        try {
            DB::beginTransaction();

            $data = DocumentTemplates::findOrFail($id);
            
            $data->title        = $requestData['template_name'];
            $data->body         = $requestData['document_body'];
            $data->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();  
            Log::error('Error in update document template: ' . $th->getMessage());
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $data = DocumentTemplates::findOrFail($id);
            $data->delete();
            return true;
        } catch (\Throwable $th) {
            
            Log::error('Error in delete document template: ' . $th->getMessage());
            return false;
        }
    }
} 
     