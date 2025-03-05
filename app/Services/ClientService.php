<?php

namespace App\Services;

use App\Models\Client;
use App\Models\ClientLog;
use App\Models\EmailFile;
use App\Models\ClientTask;
use App\Models\LeadStatus;
use App\Models\ClientEmail;
use App\Models\ClientStatus;
use App\Jobs\SendClientEmail;
use App\Models\ClientDocument;
use App\Models\ClientAppointment;
use App\Models\OpposingPartyinfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\ClientCaseInformation;
use App\Mail\ClientEmail as MailClientEmail;
use App\Models\ClientIntakeInformation;

class ClientService
{
    public function createLead($data)
    {
        try {
            if(isset($data['client_id']) && !empty($data['client_id']))
            {
                $existing_lead = Client::find($data['client_id']);

                $existing_lead->primary_client_name = $data['primary_client_name'];
                $existing_lead->property_address = isset($data['property_address']) ? $data['property_address'] : NULL;
                $existing_lead->telephone_number = isset($data['telephone_number']) ? $data['telephone_number'] : NULL;
                $existing_lead->alt_phone = isset($data['alt_phone']) ? $data['alt_phone'] : NULL;
               
                $existing_lead->drivers_license_no = isset($data['drivers_license_no']) ? $data['drivers_license_no'] : NULL;
                $existing_lead->ssn = isset($data['ssn']) ? $data['ssn'] : NULL;
                $existing_lead->date_of_birth = isset($data['date_of_birth']) ? $data['date_of_birth'] : NULL;
                $existing_lead->marital_status = isset($data['marital_status']) ? $data['marital_status'] : NULL;
                $existing_lead->other_notes = isset($data['other_notes']) ? $data['other_notes'] : NULL;
                $existing_lead->secondary_client_name = isset($data['secondary_client_name']) ? $data['secondary_client_name'] : NULL;
                $existing_lead->secondary_telephone_number = isset($data['secondary_telephone_number']) ? $data['secondary_telephone_number'] : NULL;
                $existing_lead->secondary_email_address = isset($data['secondary_email_address']) ? $data['secondary_email_address'] : NULL;
                $existing_lead->secondary_drivers_license_no = isset($data['secondary_drivers_license_no']) ? $data['secondary_drivers_license_no'] : NULL;
                $existing_lead->secondary_ssn = isset($data['secondary_ssn']) ? $data['secondary_ssn'] : NULL;
                $existing_lead->secondary_date_of_birth = isset($data['secondary_date_of_birth']) ? $data['secondary_date_of_birth'] : NULL;
                $existing_lead->save();

                 /// get parent id
                $clientParentCase = ClientCaseInformation::where('client_id', $data['client_id'])->whereNull('parent_id')->first();

                 /// create  client caseinfo and related tables  with null values records.
                $clientCaseInfo = new ClientCaseInformation();
               

                $clientCaseInfo->client_id = $existing_lead->id;
                $clientCaseInfo->parent_id  =$clientParentCase->id;
                $clientCaseInfo->case_type_id  = $data['case_type'];
                $clientCaseInfo->lead_source_id  = isset($data['hear_about_us']) ? $data['hear_about_us'] : NULL;
                $clientCaseInfo->city = isset($data['city']) ? $data['city'] : NULL;
                $clientCaseInfo->a_d_placement_id  = isset($data['area']) ? $data['area'] : NULL;
                $clientCaseInfo->case_notes = isset($data['case_notes']) ? $data['case_notes'] : NULL;

                $clientCaseInfo->save();

                $opposingPartyInfo = new OpposingPartyinfo();
                $opposingPartyInfo->client_case_information_id  = $clientCaseInfo->id;
                $opposingPartyInfo->save();

                session()->flash('success', 'Lead saved successfully');
                return [$existing_lead->id, $clientCaseInfo->id];
            }
            else
            {
                $status = ClientStatus::where('name', 'Intro')->first();
                $lead_status = LeadStatus::where('name', 'New Lead')->first();
                $user = Auth::user();

                $lead = new Client();

                $lead->primary_client_name = $data['primary_client_name'];
                $lead->property_address = isset($data['property_address']) ? $data['property_address'] : NULL;
                $lead->telephone_number = isset($data['telephone_number']) ? $data['telephone_number'] : NULL;
                $lead->alt_phone = isset($data['alt_phone']) ? $data['alt_phone'] : NULL;
                $lead->email_address = $data['email_address'];
                $lead->drivers_license_no = isset($data['drivers_license_no']) ? $data['drivers_license_no'] : NULL;
                $lead->ssn = isset($data['ssn']) ? $data['ssn'] : NULL;
                $lead->date_of_birth = isset($data['date_of_birth']) ? $data['date_of_birth'] : NULL;
                $lead->marital_status = isset($data['marital_status']) ? $data['marital_status'] : NULL;
                $lead->other_notes = isset($data['other_notes']) ? $data['other_notes'] : NULL;
                $lead->secondary_client_name = isset($data['secondary_client_name']) ? $data['secondary_client_name'] : NULL;
                $lead->secondary_telephone_number = isset($data['secondary_telephone_number']) ? $data['secondary_telephone_number'] : NULL;
                $lead->secondary_email_address = isset($data['secondary_email_address']) ? $data['secondary_email_address'] : NULL;
                $lead->secondary_drivers_license_no = isset($data['secondary_drivers_license_no']) ? $data['secondary_drivers_license_no'] : NULL;
                $lead->secondary_ssn = isset($data['secondary_ssn']) ? $data['secondary_ssn'] : NULL;
                $lead->secondary_date_of_birth = isset($data['secondary_date_of_birth']) ? $data['secondary_date_of_birth'] : NULL;
                $lead->lead_status_id = $lead_status->id;
                $lead->type = 'lead';
                $lead->client_status_id = $status->id;
                $lead->entered_by = $user->id;

                $lead->save();

                /// create  client caseinfo and related tables  with null values records.
                $clientCaseInfo = new ClientCaseInformation();

                $clientCaseInfo->client_id = $lead->id;
                $clientCaseInfo->case_type_id  = $data['case_type'];
                $clientCaseInfo->lead_source_id  = isset($data['hear_about_us']) ? $data['hear_about_us'] : NULL;
                $clientCaseInfo->city = isset($data['city']) ? $data['city'] : NULL;
                $clientCaseInfo->a_d_placement_id  = isset($data['area']) ? $data['area'] : NULL;
                $clientCaseInfo->case_notes = isset($data['case_notes']) ? $data['case_notes'] : NULL;

                $clientCaseInfo->save();

                $opposingPartyInfo = new OpposingPartyinfo();
                $opposingPartyInfo->client_case_information_id  = $clientCaseInfo->id;
                $opposingPartyInfo->save();

                // $clientIntakeInfo = new ClientIntakeInformation();
                // $clientIntakeInfo->client_id = $lead->id;
                // $clientIntakeInfo->save();
            }
            
            session()->flash('success', 'Lead saved successfully');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateClientCaseinfo($data, $client_id, $client_case_information_id)
    {
        try
        {
            if($data['tab'] == "false")
            {
                $clientCaseinfo = ClientCaseInformation::where('id', $client_case_information_id)->first();
                
                $clientCaseinfo->case_analyst = isset($data['case_analyst']) ? $data['case_analyst'] : NULL;
                $clientCaseinfo->attorney_assigned  = isset($data['attorney_assigned']) ? $data['attorney_assigned'] : NULL;
                $clientCaseinfo->case_number  = isset($data['case_number']) ? $data['case_number'] : NULL;
                $clientCaseinfo->case_title = isset($data['case_title']) ? $data['case_title'] : NULL;
                $clientCaseinfo->case_filed = isset($data['case_filed']) ? $data['case_filed'] : NULL;
                $clientCaseinfo->complaint_filed = isset($data['complaint_filed']) ? $data['complaint_filed'] : NULL;
                $clientCaseinfo->complaint_served = isset($data['complaint_served']) ? $data['complaint_served'] : NULL;
                $clientCaseinfo->court_address = isset($data['court_address']) ? $data['court_address'] : NULL;
                $clientCaseinfo->department = isset($data['department']) ? $data['department'] : NULL;
                $clientCaseinfo->judge = isset($data['judge']) ? $data['judge'] : NULL;
                $clientCaseinfo->answer_filed = isset($data['answer_filed']) ? $data['answer_filed'] : NULL;
                $clientCaseinfo->answer_served = isset($data['answer_served']) ? $data['answer_served'] : NULL;

                $clientCaseinfo->save();


                $opposingPartyInfo = OpposingPartyinfo::where('client_case_information_id', $client_case_information_id)->first();

                $opposingPartyInfo->opposing_party_name = isset($data['opposing_party_name']) ? $data['opposing_party_name'] : NULL;
                $opposingPartyInfo->opposing_party_address = isset($data['opposing_party_address']) ? $data['opposing_party_address'] : NULL;
                $opposingPartyInfo->opposing_party_phone_number = isset($data['opposing_party_phone_number']) ? $data['opposing_party_phone_number'] : NULL;
                $opposingPartyInfo->attorney_name = isset($data['attorney_name']) ? $data['attorney_name'] : NULL;
                $opposingPartyInfo->attorney_firm = isset($data['attorney_firm']) ? $data['attorney_firm'] : NULL;
                $opposingPartyInfo->attorney_phone_number  = isset($data['attorney_phone_number']) ? $data['attorney_phone_number'] : NULL;
                $opposingPartyInfo->attorney_fax = isset($data['attorney_fax']) ? $data['attorney_fax'] : NULL;
                $opposingPartyInfo->attorney_email  = isset($data['attorney_email']) ? $data['attorney_email'] : NULL;
             
                $opposingPartyInfo->save();
                $this->intakeInfoUpdate($data['intake_fields'] , $client_id);
            


                /// client intake info ///
                //$clientInfo = ClientIntakeInformation::where('client_id', $client_id)->first();
            }
            else
            {
                $this->intakeInfoUpdate($data['intake_fields'] , $client_case_information_id);

                $client = Client::where('id', $client_id)->first();
                $clientCaseinfo = ClientCaseInformation::where('id', $client_case_information_id)->first();
                

                $clientCaseinfo->lead_source_id  = isset($data['hear_about_us']) ? $data['hear_about_us'] : NULL;
                $clientCaseinfo->city = isset($data['city']) ? $data['city'] : NULL;
                $clientCaseinfo->a_d_placement_id  = isset($data['area']) ? $data['area'] : NULL;

                $clientCaseinfo->save();

                $client->lead_status_id  = isset($data['lead_status_id']) ? $data['lead_status_id'] : NULL;
                $client->lead_assigned_to  = isset($data['lead_assigned_to']) ? $data['lead_assigned_to'] : NULL;
                $client->attorney_percentage  = isset($data['attorney_percentage']) ? $data['attorney_percentage'] : NULL;
                $client->lead_notes  = isset($data['lead_notes']) ? $data['lead_notes'] : NULL;

                $client->save();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function  intakeInfoUpdate($intake_fields , $client_case_information_id)
    {
        /// first delete the previous question 
        ClientIntakeInformation::where('client_case_information_id', $client_case_information_id)->delete();

        if($intake_fields)
        {
            foreach($intake_fields as $intake_filed)
            {
                $clientInfo = new ClientIntakeInformation;

                $clientInfo->client_case_information_id = $client_case_information_id;
                $clientInfo->case_intake_field_id  = isset($intake_filed['dataId']) ? $intake_filed['dataId'] : NULL;
                $clientInfo->answer = isset($intake_filed['value']) ? $intake_filed['value'] : NULL;
                $clientInfo->save();
            }
        }
    }

    public function createAppointment($data, $client_case_information_id)
    {
        try
        {
            $clientAppointment = new ClientAppointment();
            $clientAppointment->client_case_information_id = $client_case_information_id;
            $clientAppointment->date                     = $data['date'];
            $clientAppointment->time                     = $data['time'];
            $clientAppointment->type                     = $data['type'];
            $clientAppointment->attorney_id              = $data['attorney'];
            $clientAppointment->appointment_location_id  = $data['location'];
            $clientAppointment->status                   = $data['status'];
            $clientAppointment->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
               
    }

    public function uploadClientDoc($data, $client_case_information_id)
    {
        if ($data->hasFile('documents')) {
            foreach ($data->file('documents') as $file) {
                // Generate a unique file name
                $filename = getFileName($file);
                // Store the file
                $filePath = $file->storeAs("uploads/clients", $filename, 'public');
                $fileSizeInBytes = $file->getSize();
                $fileSizeInKB = $fileSizeInBytes / 1024;

                ClientDocument::create([
                    'client_case_information_id' => $client_case_information_id,
                    'name'          => $filename,
                    'path'          => $filePath,
                    'file_size'     => $fileSizeInKB,
                ]);
            }
            return true;
        }
        return false;
    }

    public function createClientLogs($data)
    {
        try {
            $log = new ClientLog();
            $log->client_case_information_id        = $data['client_case_information_id'];
            $log->user_id         = $data['user_id'];
            $log->title           = $data['title'];
            $log->comment         = $data['comment'];
            $log->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateClientLogs($data, $log_id)
    {
        try {
            $log = ClientLog::where('id', $log_id)->first();
            $log->title           = $data['title'];
            $log->comment         = $data['comment'];
            $log->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function createTasks($data)
    {
        try {
            $task = new ClientTask();
            $task->client_case_information_id       = $data['client_case_information_id'];
            $task->details         = $data['details'];
            $task->date            = $data['date'];
            $task->time            = $data['time'];
            $task->status          = 'incomplete';

            if (isset($data['assign_task']) && is_array($data['assign_task'])) {
                $task->user_assigned = implode(',', $data['assign_task']);
            } else {
                $task->user_assigned = '';
            }

            $task->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateTasks($data, $task_id)
    {
        try {
            $task = ClientTask::where('id', $task_id)->first();

            $task->details         = $data['details'];
            $task->date            = $data['date'];
            $task->time            = $data['time'];

            if (isset($data['assign_task']) && is_array($data['assign_task'])) {
                $task->user_assigned = implode(',', $data['assign_task']);
            } else {
                $task->user_assigned = '';
            }
            $task->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function createEmails($data)
    {
        try
        {
        
            $filePath = NULL;
            
            $email = new ClientEmail();
            $email->client_case_information_id       = $data['client_case_information_id'];
            $email->subject         = $data['subject'];
            $email->from            = $data['from'];
            $email->to              = $data['to'];
            $email->body            = $data['email_body'];
            
            $email->save();

            $filePaths = [];
            if ($data->hasFile('email_file')) {
                foreach ($data->file('email_file') as $file) {

                    $filename = getFileName($file);
                
                    $filePath = $file->storeAs("uploads/clients/emails", $filename, 'public');
                    $filePaths[] = storage_path("app/public/$filePath"); // Save full file path for email attachment

                    $email_file = new EmailFile();
                    $email_file->client_email_id   = $email->id;
                    $email_file->file_path         = $filePath;
                    $email_file->name              = $filename;
                    
                    $email_file->save();
                }
            }

            // send email
            SendClientEmail::dispatch($data['email_body'], $filePaths, $data['from'], $data['to'], $data['subject'], NULL);
            //Mail::to($data['to'])->send(new MailClientEmail($data['email_body'], $data['email_file'], $data['from'], $data['subject']));
            return true;
        }
        catch(\Throwable $th)
        {
            return false;
        }
            
    }

    public function saveStatus($recordId, $statusId)
    {
        try {
            $record = client::findOrFail($recordId);
            $record->client_status_id = $statusId; // Update the status
            return $record->save();
        } catch (\Exception $e) {
            return false;
        }
    }
    
} 
     
