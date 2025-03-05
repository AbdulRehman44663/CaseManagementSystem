<?php

namespace App\Services;

use App\Models\EmailTemplates;
 

class EmailTemplateService
{
    public function create($requestData)
    {
        try
        {
            $data = new EmailTemplates();
            $data->case_type_id = $requestData['caseTypeId'];
            $data->name = $requestData['name'];
            $data->subject = $requestData['subject'];
            $data->body = $requestData['email_body'];
            $data->save();
            session()->flash('success', 'Email Tempalte saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function update($requestData, $id)
    {
        try {
            $data = EmailTemplates::findOrFail($id);
    
            // Update the fields
            $data->case_type_id = $requestData['caseTypeId'];
            $data->name = $requestData['name'];
            $data->subject = $requestData['subject'];
            $data->body = $requestData['email_body'];
            $data->save();
            
            session()->flash('success', 'Email Tempalte  updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = $id.'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $data = EmailTemplates::findOrFail($id);
            $data->delete();
            
            session()->flash('success', 'Email Tempalte deleted successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
} 
     