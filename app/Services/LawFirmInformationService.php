<?php

namespace App\Services;

use App\Models\LawFirmInformation;
use App\Helpers\CommonHelper;


class LawFirmInformationService
{
    public function update($requestData)
    {
        try
        {
            $commonHelper = new CommonHelper();

            $data = LawFirmInformation::first();

            if(!$data){
                $data = new LawFirmInformation();
            }

            $data->company_name  = $requestData['company_name'];
            $data->attorney_1  = isset($requestData['attorney_1']) ? $requestData['attorney_1'] : NULL;
            $data->attorney_2 = isset($requestData['attorney_2']) ? $requestData['attorney_2'] : NULL;
            $data->attorney_3 = isset($requestData['attorney_3']) ? $requestData['attorney_3'] : NULL;
            $data->address = isset($requestData['address']) ? $requestData['address'] : NULL;
            $data->suite = isset($requestData['suite']) ? $requestData['suite'] : NULL;
            $data->city_state_zip = isset($requestData['city_state_zip']) ? $requestData['city_state_zip'] : NULL;
            $data->telephone_no = isset($requestData['telephone_no']) ? $requestData['telephone_no'] : NULL;
            $data->fax_no  = isset($requestData['fax_no']) ? $requestData['fax_no'] : NULL;
            $data->email_address = isset($requestData['email_address']) ? $requestData['email_address'] : NULL;
            $data->email_signature = isset($requestData['email_signature']) ? $requestData['email_signature'] : NULL;
            $data->show_email_signature = isset($requestData['show_email_signature']) ? $requestData['show_email_signature']: 1;

            if(isset($requestData['logo_image']) && $requestData['logo_image']!=''){
                $logo_image =  $commonHelper->saveImageFromDataImage($requestData['logo_image']);
                if($logo_image){
                    $data->logo_image =  $logo_image;
                }
            }
            if(isset($requestData['signature']) && $requestData['signature']!=''){
                $signature = $commonHelper->saveImageFromDataImage($requestData['signature']);
                if($signature){
                    $data->signature = $signature;
                }
            }

            $data->save();

            session()->flash('success','Law Firm Information update successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage ='Unable to handle request! Error on line' . $th->getLine();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
}
