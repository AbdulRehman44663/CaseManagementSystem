<?php
namespace App\Services;

use Log;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\UserConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientVerificationEmail;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\SendClientVerificationEmail;
use App\Jobs\SendPasswordResetEmail;
use App\Models\UserAccess;
use App\Models\UserEvent;

class UserService
{
    public function createClientUser(array $data, $leadid)
    {
        $user = User::create($data);
        
        //$user = User::find($user->id);
        Client::where('id', $leadid)->update([
            'user_id' => $user->id,
        ]);
        if ($user) {
            $verificationUrl = route('client.verify', ['token' => $user->verification_token]);

            // Dispatch Email Job
            SendClientVerificationEmail::dispatch($user, $verificationUrl);
        }
        return $user;
    }

    public function createLawyerUser($data)
    {
        try {
            DB::beginTransaction();  

            $token = Str::random(60);

            $user = new User();
            $user->name        = $data['name'];
            $user->email       = $data['email'];
            $user->hourly_rate = $data['hourly_rate'];
            $user->user_type   = $data['user_type'];
            $user->status      = 'user_not_confirmed_yet';
            $user->verification_token = $token;
            $user->save();
            
            // Send email
            $verificationUrl = route('user.verify', ['token' => $user->verification_token]);
            SendClientVerificationEmail::dispatch($user, $verificationUrl);
            // Mail::to($user->email)->send(new ClientVerificationEmail($user, $verificationUrl));
           
           DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();  
            // Log error message  
            \Log::error('User creation failed: ' . $th->getMessage());
            return false;
        }
    }

    public function updateLawyerUser($data, $userId)
    {
        try {
            DB::beginTransaction();  
        
            $user = User::findOrFail($userId);
        
            // Update the fields
            $user->name        = $data['name'];
            $user->email       = $data['email'];
            $user->hourly_rate = $data['hourly_rate'];
            $user->user_type   = $data['user_type'];
            $user->save();
        
            DB::commit();  
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            
            \Log::error('User update failed: ' . $th->getMessage());
        
            return false;
        }
    }
    
    public function setUserEvent($data, $userId)
    {
        try {
            DB::beginTransaction(); 

            $userEvent = UserEvent::where('user_id', $userId)->first();

            $jsonFormatted = !empty($data->selectedCaseTypes) ? json_encode(implode(',', $data->selectedCaseTypes)) : null;

            $account_event = ($data->accounting_event == "yes") ? "yes" : null;

            if ($userEvent) {
                // Update existing record
                $userEvent->user_id = $userId;
                $userEvent->case_type_events = $jsonFormatted;
                $userEvent->account_event = $account_event;
                $userEvent->save();
            } else {
                // Create new record
                $event = new UserEvent();
                $event->user_id = $userId;
                $event->case_type_events = $jsonFormatted;
                $event->account_event = $account_event;
                $event->save();
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();  
            Log::error('Error in setUserEvent: ' . $th->getMessage()); // Log error for debugging

           return false;
        }
    }
    
    public function setUserAccess($data, $userId)
    {
        try {
            DB::beginTransaction(); 

            $userAccess = UserAccess::where('user_id', $userId)->first();

            $jsonFormatted = !empty($data->selectedUserAccess) ? json_encode(implode(',', $data->selectedUserAccess)) : null;
            
            if ($userAccess) {
                // Update existing record
                $userAccess->user_id = $userId;
                $userAccess->access_modules = $jsonFormatted;
               
                $userAccess->save();
            } else {
                // Create new record
                $access = new UserAccess();
                $access->user_id = $userId;
                $access->access_modules = $jsonFormatted;
              
                $access->save();
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();  
            Log::error('Error in set user access/permission: ' . $th->getMessage()); // Log error for debugging

           return false;
        }
    }

    public function sendResetPasswordEmail($userId)
    {
        try {
            $user = User::findOrFail($userId);  

            $resetPasswordLink = route('admin.reset.password', $user->id);

            // Dispatch Email Job
            SendPasswordResetEmail::dispatch($user, $resetPasswordLink);

            return true;
        } catch (\Throwable $th) {
            \Log::error('Error sending password reset email: ' . $th->getMessage());
            
            return false;
        }
    }
}
