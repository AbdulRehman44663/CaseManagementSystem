@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

<form id="clientForm">
    @csrf
    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Personal Information for Primary Client</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Client Name</div>
                <input type="text" id="primary_client_name" class="form-control myinput mb_16" value="{{ old('primary_client_name', $lead->primary_client_name) }}">
                <div class="text_16_400 text_404248 mb_12">Property Address</div>
                <input type="text" id="property_address" class="form-control myinput mb_16" value="{{ old('property_address', $lead->property_address) }}">
                <div class="text_16_400 text_404248 mb_12">Telephone Number</div>
                <input type="text" id="telephone_number" class="form-control myinput mb_16" value="{{ old('telephone_number', $lead->telephone_number) }}">
                <div class="text_16_400 text_404248 mb_12">Alt. Phone</div>
                <input type="text" id="alt_phone" class="form-control myinput mb_16" value="{{ old('alt_phone', $lead->alt_phone) }}">
                <div class="text_16_400 text_404248 mb_12">Email Address 1</div>
                <input type="text" id="email_address" class="form-control myinput mb_16" value="{{ old('email_address', $lead->email_address) }}">
                <div class="text_16_400 text_404248 mb_12">Drivers License No</div>
                <input type="text" id="drivers_license_no" class="form-control myinput mb_16" value="{{ old('drivers_license_no', $lead->drivers_license_no) }}">
                <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="text" id="ssn" class="form-control myinput mb_16" value="{{ old('ssn', $lead->ssn) }}">
                <div class="text_16_400 text_404248 mb_12">Date of Birth</div>
                <input type="text" id="date_of_birth" class="form-control myinput mb_16" value="{{ old('date_of_birth', $lead->date_of_birth) }}">
                <div class="text_16_400 text_404248 mb_12">Marital Status</div>
                <input type="text" id="marital_status" class="form-control myinput mb_16" value="{{ old('marital_status', $lead->marital_status) }}">
                <div class="text_16_400 text_404248 mb_12">Other Notes</div>
                <input type="text" id="other_notes" class="form-control myinput mb_16" value="{{ old('other_notes', $lead->other_notes) }}">
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Personal Information for Client 2</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Client Name</div>
                <input type="text" id="secondary_client_name" class="form-control myinput mb_16" value="{{ old('secondary_client_name', $lead->secondary_client_name) }}">
                <div class="text_16_400 text_404248 mb_12">Telephone Number</div>
                <input type="text" id="secondary_telephone_number" class="form-control myinput mb_16" value="{{ old('secondary_telephone_number', $lead->secondary_telephone_number) }}">
                <div class="text_16_400 text_404248 mb_12">Email Address</div>
                <input type="text" id="secondary_email_address" class="form-control myinput mb_16" value="{{ old('secondary_email_address', $lead->secondary_email_address) }}">
                <div class="text_16_400 text_404248 mb_12">Drivers License No</div>
                <input type="text" id="secondary_drivers_license_no" class="form-control myinput mb_16" value="{{ old('secondary_drivers_license_no', $lead->secondary_drivers_license_no) }}">
                <div class="text_16_400 text_404248 mb_12">SSN</div>
                <input type="text" id="secondary_ssn" class="form-control myinput mb_16" value="{{ old('secondary_ssn', $lead->secondary_ssn) }}">
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Case Type</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Case Type</div>
                <input type="text" id="case_type" class="form-control myinput mb_16" value="{{ old('case_type', $lead->case_type) }}">
                <div class="text_16_400 text_404248 mb_12">How did you hear about us</div>
                <input type="text" id="hear_about_us" class="form-control myinput mb_16" value="{{ old('hear_about_us', $lead->hear_about_us) }}">
                <div class="text_16_400 text_404248 mb_12">Where do you live (City)</div>
                <input type="text" id="city" class="form-control myinput mb_16" value="{{ old('city', $lead->city) }}">
                <div class="text_16_400 text_404248 mb_12">Area</div>
                <input type="text" id="area" class="form-control myinput mb_16" value="{{ old('area', $lead->area) }}">
            </div>
        </div>
    </div>

    <div class="bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Case Notes</div>
        <div class="row">
            <div class="col-lg-7">
                <div class="text_16_400 text_404248 mb_12">Notes</div>
                <textarea class="form-control myinput mb_16" id="primary_case_notes" rows="5">{{ old('primary_case_notes', $lead->primary_case_notes) }}</textarea>
            </div>
        </div>
    </div>

    <button class="btn text_14_400 text-white br_6 bg_126C9B cp_3 update-info-btn" data-lead-id="{{ $lead->id }}">Update Information</button>
</form>

@include('admin.'.$controller.'.modals')
@include('admin.leads.add_script')
@endsection('content')