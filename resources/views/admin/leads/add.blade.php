@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

<form id="leadForm">
    @csrf
    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Personal Information for Primary Client</div>
        <div class="row">
            <div class="col-lg-7">
                <input type="hidden" name = "client_id" id= "client_id" value={{isset($client_record->id) ? $client_record->id : ''}}>
                <div class="text_16_400 text_404248 mb_12">Client Name <span class="text_B4173A">*</span></div>
                <input type="text" value="{{isset($client_record->primary_client_name) ? $client_record->primary_client_name: ''}}" id="primary_client_name" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_primary_client_name"></div>

                <div class="text_16_400 text_404248 mb_12">Property Address</div>
                <input type="text" value="{{isset($client_record->property_address) ? $client_record->property_address: ''}}" id="property_address" class="form-control myinput mb_16">
                

                <div class="text_16_400 text_404248 mb_12">Telephone Number</div>
                <input type="tel" value="{{isset($client_record->telephone_number) ? $client_record->telephone_number: ''}}" id="telephone_number" name="telephone_number" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_telephone_number"></div>
                
                <div class="text_16_400 text_404248 mb_12">Alt. Phone</div>
                <input type="tel" value="{{isset($client_record->alt_phone) ? $client_record->alt_phone: ''}}" id="alt_phone" name="alt_phone" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_alt_phone"></div>
                
                <div class="text_16_400 text_404248 mb_12">Email Address 1 <span class="text_B4173A">*</span></div>
                <input type="text"  value="{{isset($client_record->email_address) ? $client_record->email_address: ''}}" {{isset($client_record->email_address) ? 'disabled' : ''}} id="email_address" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_email_address"></div>

                <div class="text_16_400 text_404248 mb_12">Drivers License No</div>
                <input type="text" value="{{isset($client_record->drivers_license_no) ? $client_record->drivers_license_no: ''}}" id="drivers_license_no" name="drivers_license_no" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_drivers_license_no"></div>

                {{-- <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="number" value="{{isset($client_record->ssn) ? $client_record->ssn: ''}}" id="ssn" name="ssn" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_ssn"></div> --}}
                <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="text" value="{{ old('ssn', $client_record->ssn ?? '') }}"id="ssn" name="ssn" 
                    class="form-control myinput mb_16"
                    oninput="validateSSN(this)">
                <div class="invalid-feedback" id="error_ssn"></div>


                <div class="text_16_400 text_404248 mb_12">Date of Birth</div>
                <input type="date" value="{{isset($client_record->date_of_birth) ? $client_record->date_of_birth: ''}}" id="date_of_birth" class="form-control myinput mb_16">

                <div class="text_16_400 text_404248 mb_12">Marital Status</div>
                <input type="text" value="{{isset($client_record->marital_status) ? $client_record->marital_status: ''}}" id="marital_status" name="marital_status" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_marital_status"></div>

                <div class="text_16_400 text_404248 mb_12">Other Notes</div>
                <input type="text" value="{{isset($client_record->other_notes) ? $client_record->other_notes: ''}}" id="other_notes" class="form-control myinput mb_16">
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Personal Information for Client 2</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Client Name</div>
                <input type="text" value="{{isset($client_record->secondary_client_name) ? $client_record->secondary_client_name: ''}}" id="secondary_client_name" class="form-control myinput mb_16">

                <div class="text_16_400 text_404248 mb_12">Telephone Number</div>
                <input type="text" value="{{isset($client_record->secondary_telephone_number) ? $client_record->secondary_telephone_number: ''}}" id="secondary_telephone_number" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_secondary_telephone_number"></div>

                <div class="text_16_400 text_404248 mb_12">Email Address</div>
                <input type="text"  value="{{isset($client_record->secondary_email_address) ? $client_record->secondary_email_address: ''}}" id="secondary_email_address" name="secondary_email_address" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_secondary_email_address"></div>

                <div class="text_16_400 text_404248 mb_12">Drivers License No</div>
                <input type="text" value="{{isset($client_record->secondary_drivers_license_no) ? $client_record->secondary_drivers_license_no: ''}}" id="secondary_drivers_license_no" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_secondary_drivers_license_no"></div>
                
                <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="text" value="{{ old('ssn', $client_record->secondary_ssn ?? '') }}"id="secondary_ssn" name="secondary_ssn" 
                    class="form-control myinput mb_16"
                    oninput="validateSecondarySSN(this)">
                <div class="invalid-feedback" id="error_secondary_ssn"></div>

                {{-- <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="number" value="{{isset($client_record->secondary_ssn) ? $client_record->secondary_ssn: ''}}" id="secondary_ssn" class="form-control myinput mb_16"> --}}
                
                <div class="text_16_400 text_404248 mb_12">Date of Birth</div>
                <input type="date" value="{{isset($client_record->secondary_date_of_birth) ? $client_record->secondary_date_of_birth: ''}}" id="secondary_date_of_birth" class="form-control myinput mb_16">
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Case Type </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Case Type <span class="text_B4173A">*</span></div>

                <select name="case_type" id="case_type" class="form-control myinput mb_16">
                    <option value="">Select</option>
                    @foreach($case_types as $case_type)
                        <option  {{isset($client_record) ? 'selected': ''}} value="{{$case_type->id}}">{{$case_type->name}}</option>
                    @endforeach
                </select>   
                
                
                <div class="invalid-feedback" id="error_case_type"></div>

                <div class="text_16_400 text_404248 mb_12">How did you hear about us</div>

                <select name="hear_about_us" id="hear_about_us" class="form-control myinput mb_16">
                    <option value="">Select</option>
                    @foreach($lead_sources as $lead_source)
                        <option value="{{$lead_source->id}}">{{$lead_source->name}}</option>
                    @endforeach
                </select>

                <div class="text_16_400 text_404248 mb_12">Where do you live (City)</div>
                <input type="text" id="city" class="form-control myinput mb_16">
                <div class="invalid-feedback" id="error_city"></div>

                <div class="text_16_400 text_404248 mb_12">Area</div>
                <select name="area" id="area" class="form-control myinput mb_16">
                    <option value="">Select</option>
                    @foreach($ad_placements as $ad_placement)
                        <option value="{{$ad_placement->id}}">{{$ad_placement->name}}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Case Notes</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Notes</div>
                <textarea class="form-control myinput mb_16" id="primary_case_notes" rows="5"></textarea>
            </div>
        </div>
    </div>

    <button class="btn text_14_400 text-white br_6 bg_126C9B cp_3 save-info-btn">Save Information</button>
</form>

@include('admin.'.$controller.'.modals')
@include('admin.leads.lead-script')
 
@endsection('content')