@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$record->primary_client_name}} (WI: Work In-progress)</div>
<div class="d-flex justify-content-between mb_24">
    <ul class="nav nav-pills my-nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="client-info-tab" data-bs-toggle="pill" data-bs-target="#client-info" type="button" role="tab" aria-controls="client-info" aria-selected="true">Client Info </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="documents-tab" data-bs-toggle="pill" data-bs-target="#client-documents" type="button" role="tab" aria-controls="documents" aria-selected="false">Documents</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="accounting-tab" data-bs-toggle="pill" data-bs-target="#accounting" type="button" role="tab" aria-controls="accounting" aria-selected="false">Accounting</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="logs-tab" data-bs-toggle="pill" data-bs-target="#logs" type="button" role="tab" aria-controls="logs" aria-selected="false">Logs</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tasks-tab" data-bs-toggle="pill" data-bs-target="#tasks" type="button" role="tab" aria-controls="tasks" aria-selected="false">Tasks</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="intake-lead-notes-tab" data-bs-toggle="pill" data-bs-target="#intake-lead-notes" type="button" role="tab" aria-controls="intake-lead-notes" aria-selected="false">Intake/Lead Notes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="email-tab" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="false">Email</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="pill" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Messages</button>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-xxl-8 mb_24">
        <div class="tab-content" id="pills-tabContent">
            <!--- client info --->
            <div class="tab-pane fade show active" id="client-info" role="tabpanel" aria-labelledby="client-info-tab">
                {{-- <form action="{{ route('admin.update-clientInfo', $record->id) }}" method="POST"> --}}
                <form id="client-info">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <input type="hidden" name="client_id" id="client_id" value="{{$record->id}}">
                        <input type="hidden" name="client_case_information_id" id="client_case_information_id" value="{{$case_info_record->id}}">
                        <div class="br_6 bg_F1F2F2 cp_6 mb_32">
                            <div class="d-flex justify-content-between align-items-center mb_24">
                                <div class="text_16_700 text_404248">Personal Information</div>
                                @if($record->type == "lead")
                                <button type="button" id="convert-lead-into-client-btn" class="btn text-white bg_126C9B" data-id="{{ $record->id }}">
                                    Convert this lead into client
                                </button>
                                @endif
                            </div>

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Client Code:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->id}}</div>
                                </div>
                            </div>
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Client Name 1:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->primary_client_name}}</div>
                                </div>
                            </div>

                            @if($record->secondary_client_name)
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Client Name 2:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->secondary_client_name}}</div>
                                </div>
                            </div>
                            @endif

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Address:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->property_address}}</div>
                                </div>
                            </div>

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Tel. Number Client 1:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->telephone_number}}</div>
                                </div>
                            </div>

                            @if($record->secondary_telephone_number)
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Tel. Number Client 2:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->secondary_telephone_number}}</div>
                                </div>
                            </div>
                            @endif

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Email Address 1:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->email_address}}</div>
                                </div>
                            </div>
                            @if($record->secondary_email_address)
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Email Address 2:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->secondary_email_address}}</div>
                                </div>
                            </div>
                            @endif

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Drivers License No 1:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->drivers_license_no}}</div>
                                </div>
                            </div>

                            @if($record->secondary_drivers_license_no)
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Drivers License No 2:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->secondary_drivers_license_no}}</div>
                                </div>
                            </div>
                            @endif

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">SSN 1:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->ssn}}</div>
                                </div>
                            </div>

                            @if($record->secondary_ssn)
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">SSN 2:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->secondary_ssn}}</div>
                                </div>
                            </div>
                            @endif

                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Lead:</div>
                                </div>
                                <div class="col-4">
                                    <div id="lead_or_client" class="text_16_400 text_404248">{{$record->type == "lead" ? 'YES' : 'NO'}}</div>
                                </div>
                            </div>
                            <div class="row mb_16">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Entered By:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->user->name}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="text_16_500 text_404248">Date Client Entered:</div>
                                </div>
                                <div class="col-4">
                                    <div class="text_16_400 text_404248">{{$record->created_at->format('d/m/Y')}}</div>
                                </div>
                            </div>
                        </div>
                        <!--- case info start --->

                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Case Information</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">
                                <div class="mb_24"></div>
                                <div class="row mb_16">
                                    <div class="col-4">
                                        <div class="text_16_400 text_404248">Case Type</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text_16_600 text_404248">{{$case_info_record->caseType->name}}</div>
                                    </div>
                                </div>
                                <div class="text_16_400 text_404248 mb_12">Case Analyst</div>

                                <select name="case_analyst" id="case_analyst" class="form-control myinput mb_16">
                                    <option value="">Select</option>
                                    @foreach($users as $user)
                                    <option {{$case_info_record->case_analyst == $user->id ? 'Selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>

                                <div class="text_16_400 text_404248 mb_12">Attorney Assigned</div>
                                <select name="attorney_assigned" id="attorney_assigned" class="form-control myinput mb_16">
                                    <option value="">Select</option>
                                    @foreach($attorneys as $attorney)
                                    <option {{$case_info_record->attorney_assigned  == $attorney->id ? 'Selected' : ''}} value="{{$attorney->id}}">{{$attorney->attorney_name}}</option>
                                    @endforeach
                                </select>

                                <div class="text_16_400 text_404248 mb_12">Case Number</div>
                                <input type="text" name="case_number" id="case_number" class="form-control myinput mb_16" value="{{$case_info_record->case_number}}">

                                <div class="text_16_400 text_404248 mb_12">Case Title</div>
                                <input type="text" name="case_title" id="case_title" class="form-control myinput mb_16" value="{{$case_info_record->case_title}}">

                                <div class="text_16_400 text_404248 mb_12">Case Filed</div>
                                <input type="date" name="case_filed" id="case_filed" class="form-control myinput mb_16" value="{{$case_info_record->case_filed}}">

                                <div class="text_16_400 text_404248 mb_12">Complaint Filed</div>
                                <input type="date" name="complaint_filed" id="complaint_filed" class="form-control myinput mb_16" value="{{$case_info_record->complaint_filed}}">

                                <div class="text_16_400 text_404248 mb_12">Complaint Served</div>
                                <input type="date" name="complaint_served" id="complaint_served" class="form-control myinput mb_16" value="{{$case_info_record->complaint_served}}">

                                <div class="text_16_400 text_404248 mb_12">Court Address</div>
                                <input type="text" name="court_address" id="court_address" class="form-control myinput mb_16" value="{{$case_info_record->court_address }}">

                                <div class="text_16_400 text_404248 mb_12">Department</div>
                                <input type="text" name="department" id="department" class="form-control myinput mb_16" value="{{$case_info_record->department}}">


                                <div class="text_16_400 text_404248 mb_12">Judge</div>
                                <input type="text" name="judge" id="judge" class="form-control myinput mb_16" value="{{$case_info_record->judge}}">

                                <div class="text_16_400 text_404248 mb_12">Answer Filed</div>
                                <input type="date" name="answer_filed" id="answer_filed" class="form-control myinput mb_16" value="{{$case_info_record->answer_filed}}">

                                <div class="text_16_400 text_404248 mb_12">Answer Served</div>
                                <input type="date" name="answer_served" id="answer_served" class="form-control myinput" value="{{$case_info_record->answer_served}}">
                            </div>
                        </div>
                        <!---- client case info end --->

                        <!--- opposing party info start--->

                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Opposing Party Information</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">
                                <div class="mb_24"></div>
                                <div class="text_16_400 text_404248 mb_12">Opposing Party Name</div>
                                <input type="text" name="opposing_party_name" id="opposing_party_name" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->opposing_party_name}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Party Address</div>
                                <input type="text" name="opposing_party_address" id="opposing_party_address" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->opposing_party_address}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Party Phone Number</div>
                                <input type="text" name="opposing_party_phone_number" id="opposing_party_phone_number" class="form-control myinput" value="{{$case_info_record->opposingPartyInfo->opposing_party_phone_number}}">
                            </div>
                        </div>

                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Opposing Attorney</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">
                                <div class="mb_24"></div>

                                <div class="text_16_400 text_404248 mb_12">Opposing Attorney Name</div>
                                <input type="text" name="attorney_name" id="attorney_name" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->attorney_name}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Attorney Firm</div>
                                <input type="text" name="attorney_firm" id="attorney_firm" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->attorney_firm}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Attorney Phone</div>
                                <input type="text" name="attorney_phone_number" id="attorney_phone_number" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->attorney_phone_number}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Attorney Fax</div>
                                <input type="text" name="attorney_fax" id="attorney_fax" class="form-control myinput mb_16" value="{{$case_info_record->opposingPartyInfo->attorney_fax}}">

                                <div class="text_16_400 text_404248 mb_12">Opposing Attorney Email</div>
                                <input type="text" name="attorney_email" id="attorney_email" class="form-control myinput" value="{{$case_info_record->opposingPartyInfo->attorney_email}}">
                            </div>
                        </div>

                        <!--- end opposing party info --->
                        <!---- start client intake info --->
                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Client Intake Information</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">

                                <div class="mb_24"></div>
                                <?php
                                    $radio_name = 1;
                                ?>
                                @foreach($case_intake_fields as $case_intake_field)
                                    @php
                                        // Find the saved answer for this question
                                        $savedAnswer = $clientIntakeAnswer->firstWhere('case_intake_field_id', $case_intake_field->id);
                                        $required_star = $case_intake_field->required == 1 ? '<span class="text_B4173A">*</span>' : '';
                                    @endphp

                                    @if($case_intake_field->field_type == "TEXTFIELD")
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                        <input type="text" placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                            data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                            value="{{ $savedAnswer->answer ?? '' }}" class="form-control myinput mb_16">

                                        <div class="invalid-feedback mb-1" id="error_intake_fields.{{$case_intake_field->id}}.value"></div>

                                    @endif

                                    @if($case_intake_field->field_type == "DATEFIELD")
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                        <input type="date" placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                            data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                            value="{{ $savedAnswer->answer ?? '' }}" class="form-control myinput mb_16">
                                            <div class="invalid-feedback mb-1" id="error_intake_fields.{{$case_intake_field->id}}.value"></div>

                                    @endif

                                    @if($case_intake_field->field_type == "TEXTAREA")
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                        <textarea placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                            data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                            class="form-control myinput mb_16" rows="5"
                                        >{{ $savedAnswer->answer ?? '' }}</textarea>
                                        <div class="invalid-feedback mb-1" id="error_intake_fields.{{$case_intake_field->id}}.value"></div>

                                    @endif

                                    @if($case_intake_field->field_type == "DROP-DOWN-LIST")
                                        <?php
                                            $possible_options = unserialize($case_intake_field->possible_options);
                                        ?>
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}} {!! $required_star !!}</div>
                                        <select name="intake_fields[{{$case_intake_field->id}}][value]" data-id="{{$case_intake_field->id}}"
                                            class="form-control myinput mb_16">
                                            <option value="">Select</option>
                                            @foreach($possible_options as $possible_option)
                                                <option value="{{$possible_option}}"
                                                    {{ ($savedAnswer && $savedAnswer->answer == $possible_option) ? 'selected' : '' }}>
                                                    {{$possible_option}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback mb-1" id="error_intake_fields.{{$case_intake_field->id}}.value"></div>

                                    @endif

                                    @if($case_intake_field->field_type == "RADIO-BUTTON")

                                        <?php
                                            $possible_options = unserialize($case_intake_field->possible_options);
                                        ?>
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}} {!! $required_star !!}</div>
                                        @foreach($possible_options as $possible_option)
                                            <label>
                                                <input data-id="{{$case_intake_field->id}}" name="intake_fields-{{$radio_name}}" type="radio"
                                                    value="{{$possible_option}}" {{ ($savedAnswer && $savedAnswer->answer == $possible_option) ? 'checked' : '' }}
                                                    > {{$possible_option}}
                                            </label>
                                        @endforeach
                                        <div class="invalid-feedback mb-1" id="error_intake_fields.{{$case_intake_field->id}}.value"></div>



                                        <input type="hidden" data-id="{{$case_intake_field->id}}"  name="radio_groups[]" value="{{$radio_name}}">
                                        <?php $radio_name++; ?>
                                    @endif

                                    @if($case_intake_field->field_type == "HEADERTITLE")
                                        <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}</div>
                                    @endif

                                @endforeach

                            </div>
                        </div>
                        <!---- end client intake info --->
                        <!--- start custom-fileds--->
                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Custom Fields</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">
                                <div class="mb_24"></div>
                                <div class="text_16_400 text_404248">There are no custom fields assigned.</div>
                            </div>
                        </div>
                        <!--- end custom-fileds--->
                        <!--- start count date --->

                        <div class="br_6 bg_F1F2F2 cp_6 mb_32 collapsable_div">
                            <div class="d-flex justify-content-between collapsable_btn">
                                <div class="text_16_700 text_404248">Event/Court Date</div>
                                <div>
                                    <img src="<?= url('') ?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                                </div>
                            </div>
                            <div class="collapsable_content">
                                <div class="mb_24"></div>
                                <button class="btn text_14_400 text-white br_6 bg_126C9B cp_3 mb_16">Add Court Date</button>
                                <div class="text_16_400 text_404248 mb_12">Date</div>
                                <input type="text" class="form-control myinput mb_16" value="{{$record->primary_client_name}}">

                                <div class="text_16_400 text_404248 mb_12">Time</div>
                                <input type="text" class="form-control myinput mb_16" value="{{$record->primary_client_name}}">

                                <div class="text_16_400 text_404248 mb_12">Hearing Type</div>
                                <input type="text" class="form-control myinput mb_16" value="{{$record->primary_client_name}}">

                                <div class="text_16_400 text_404248 mb_12" value="{{$record->primary_client_name}}">Attorney</div>
                                <input type="text" class="form-control myinput">
                            </div>
                        </div>
                        <!--- end count date --->

                        <button type="submit" class="btn text_14_400 text-white br_6 bg_126C9B cp_3">Save Information</button>
                    </div>
                </form>
            </div>
            <!--- end client info --->
            <!--- start client document --->
            <div class="tab-pane fade" id="client-documents" role="tabpanel" aria-labelledby="documents-tab">
                <div class="br_6 bg_F1F2F2 cp_6 mb_24">
                    <div class="text_16_700 text_404248 mb_24">Client Documents/Upload</div>
                    <div class="text_16_400 text_404248 mb_24">
                        Click on the "Click here to Upload a File" button and select the file you wish to upload.
                        <br><br> File Size Limit: 7MB p/file
                        <br><br> Type of files allowed:<br> ".tiff", ".tif", ".pdf", ".jpeg", ".gif", ".doc", ".xls", ".docx", ".xlsx"
                    </div>
                    <form id="client-doc-upload-form" enctype="multipart/form-data">
                        <div class="bg-white cp_6 br_6 mb_24">
                            <div class="text_16_700 text_404248 mb_24">Upload Document</div>
                            <div class="bg_F1F2F2 br_8 cp_12" onclick="triggerFileInput()">
                                <input hidden="hidden" type="file" id="file-input" name="documents[]" class="form-control" multiple
                                    accept=".tiff,.tif,.pdf,.jpeg,.gif,.doc,.xls,.docx,.xlsx" />
                                <div class="text_14_400 text_404248 text-center">Drag & Drop your files or <u>Browse</u></div>
                            </div>
                            <small class="text-danger" id="error-message"></small>
                            <small class="text-success" id="success-message"></small>
                        </div>
                    </form>
                </div>

                <div class="my_table_div ">
                    <div class="cp_2">
                        <div class="text_20_700 ff_dm_sans text_404248">List of Documents Uploaded</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table my_table mb-0 client_doc">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Upload Date</th>
                                    <th>File Size</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
             <!--- end client document --->

            <!--- start client accounting --->
            <div class="tab-pane fade" id="accounting" role="tabpanel" aria-labelledby="accounting-tab">
                <div class="d-flex justify-content-between mb_24">
                    <ul class="nav nav-pills my-nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="client-invoices-tab" data-bs-toggle="pill" data-bs-target="#client-invoices" type="button" role="tab" aria-controls="client-invoices" aria-selected="true">Client Invoices </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hourlyrates-expenses-tab" data-bs-toggle="pill" data-bs-target="#hourlyrates-expenses" type="button" role="tab" aria-controls="hourlyrates-expenses" aria-selected="false">Hourly Rates & Expenses</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade  show active" id="client-invoices" role="tabpanel" aria-labelledby="client-invoices-tab">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="d-flex flex-wrap">
                                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" data-bs-toggle="modal" href="#addNewInvoice" role="button">+ Add New Invoice</button>
                            </div>
                            <div class="d-flex">
                                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26">
                                    <img src="<?= url('') ?>/assets/images/pdf-white.svg" alt="" width="14px">
                                    Export to PDF
                                </button>
                            </div>
                        </div>
                        <div class="my_table_div mb_36">
                            <div class="cp_2">
                                <div class="text_20_700 ff_dm_sans text_404248">Invoices</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table my_table mb-0 client_invoices">
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Service</th>
                                            <th>Attorney Fee</th>
                                            <th>Cost/Filing Fee</th>
                                            <th>Total Paid</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hourlyrates-expenses" role="tabpanel" aria-labelledby="hourlyrates-expenses-tab">
                        <div class="d-flex justify-content-between flex-wrap ">
                            <div class="d-flex flex-wrap">
                                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" data-bs-toggle="modal" href="#addHourlyRate" role="button">+ Add Hourly Rate</button>
                                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" data-bs-toggle="modal" href="#addExpenses" role="button">+ Add Expenses</button>
                            </div>
                            <div class="d-flex">
                                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26">
                                    <img src="<?= url('') ?>/assets/images/pdf-white.svg" alt="" width="14px">
                                    Export to PDF
                                </button>
                            </div>
                        </div>
                        <div class="my_table_div ">
                            <div class="cp_2">
                                <div class="text_20_700 ff_dm_sans text_404248">Hourly Rates & Expenses</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table my_table mb-0 client_hourly_rates_expenses">
                                    <thead>
                                        <tr>

                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Hourly Fee</th>
                                            <th>Rate</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Entered by</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  >

                                            <td>11/19/202</td>
                                            <td>01:00</td>
                                            <td>$350.00</td>
                                            <td>$350.00</td>
                                            <td>Description</td>
                                            <td>Senior Paralegal</td>
                                            <td>Dennis Peters</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                                                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                Invoice # 00010
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11/19/202</td>
                                            <td>01:00</td>
                                            <td>$350.00</td>
                                            <td>$350.00</td>
                                            <td>Description</td>
                                            <td>Senior Paralegal</td>
                                            <td>Dennis Peters</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                                                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11/19/202</td>
                                            <td>01:00</td>
                                            <td>$350.00</td>
                                            <td>$350.00</td>
                                            <td>Description</td>
                                            <td>Senior Paralegal</td>
                                            <td>Dennis Peters</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                                                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr class="bg_FCAF3B">
                                            <td>
                                                <div class="text_16_700 text_404248">Totals</div>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="text_16_700 text_404248">01:00</div>
                                            </td>
                                            <td>
                                                <div class="text_16_700 text_404248">$4000</div>
                                            </td>
                                            <td>
                                                <div class="text_16_700 text_404248">$4000</div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                Invoice # 00012
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11/19/202</td>
                                            <td>01:00</td>
                                            <td>$350.00</td>
                                            <td>$350.00</td>
                                            <td>Description</td>
                                            <td>Senior Paralegal</td>
                                            <td>Dennis Peters</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                                                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr class="bg_FCAF3B">
                                            <td>
                                                <div class="text_16_700 text_404248">Totals</div>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="text_16_700 text_404248">01:00</div>
                                            </td>
                                            <td>
                                                <div class="text_16_700 text_404248">$4000</div>
                                            </td>
                                            <td>
                                                <div class="text_16_700 text_404248">$4000</div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center justify-content-between cp_1">
                                    <div class="text_14_500 ff_dm_sans text_404248">Showing 1 to 10 of 50 results</div>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <select name="" id="" class="select_list">
                                                <option value="">5</option>
                                            </select>
                                        </div>
                                        <div class="text_14_500 ff_dm_sans text_404248 ml_8">per page</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                <div class="d-flex flex-wrap">
                    <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="client-log-btn" role="button">+ Add New Log</button>
                </div>

                <div id="client-logs-listing"></div>

            </div>

            <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                <div class="d-flex flex-wrap">
                    <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="client-task-btn" role="button">+ Add New Task</button>
                </div>
                <div class="my_table_div ">
                    <div class="cp_2">
                        <div class="text_20_700 ff_dm_sans text_404248">Tasks</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table my_table mb-0 client_tasks">
                            <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Users Assigned</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="intake-lead-notes" role="tabpanel" aria-labelledby="intake-lead-notes-tab">
                <div class="br_6 bg_F1F2F2 cp_6 mb_24">
                    <div class="bg-white cp_14 d-flex align-items-center mb_24">
                        <img src="<?=url('')?>/assets/images/pdf-blue.svg" alt="" width="24px">
                        <div class="text_16_500 text_404248 ml_8">If you want to send a link to the client's email with access to fill the intake/questionnaire, <span class="text_126C9B">click here</span></div>
                    </div>
                    <div class="row mb_16">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Client's Telephone No.:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_404248">{{$record->telephone_number}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="text_16_500 text_404248">Client's E-Mail:</div>
                        </div>
                        <div class="col-4">
                            <div class="text_16_400 text_404248">{{$record->email_address}}</div>
                        </div>
                    </div>
                </div>

                <form id="client-intake-lead-notes-tab">
                    <input type="hidden" name="client_id" id="client_id" value="{{$record->id}}">
                    <div class="br_6 bg_F1F2F2 cp_6 mb_24 collapsable_div">
                        <div class="d-flex justify-content-between collapsable_btn">
                            <div class="text_16_700 text_404248">Lead Source & Location </div>
                            <div>
                                <img src="<?=url('')?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                            </div>
                        </div>
                        <div class="collapsable_content">
                            <div class="mb_24"></div>
                            <div class="text_16_400 text_404248 mb_12">How did you hear about us</div>

                            <select name="hear_about_us" id="hear_about_us" class="form-control myinput mb_16">
                                <option value="">Select</option>
                                @foreach($lead_sources as $lead_source)
                                    <option value="{{$lead_source->id}}" {{($lead_source->id == $case_info_record->lead_source_id) ? 'selected' : '' }}>{{$lead_source->name}}</option>
                                @endforeach
                            </select>

                            <div class="text_16_400 text_404248 mb_12">Where do you live (City)</div>
                            <input type="text" name="city" id="city" value="{{!empty($case_info_record->city) ? $case_info_record->city: ''}}" class="form-control myinput mb_16">

                            <div class="text_16_400 text_404248 mb_12">Area</div>

                            <select name="area" id="area" class="form-control myinput mb_16">
                                <option value="">Select</option>
                                @foreach($ad_placements as $ad_placement)
                                    <option value="{{$ad_placement->id}}" {{($ad_placement->id == $case_info_record->a_d_placement_id) ? 'selected' : '' }}>{{$ad_placement->name}}</option>
                                @endforeach
                            </select>

                            <div class="mb_24"></div>
                            <?php
                                $radio_name = 1;
                            ?>
                            @foreach($case_intake_fields as $case_intake_field)
                                @php
                                    // Find the saved answer for this question
                                    $savedAnswer = $clientIntakeAnswer->firstWhere('case_intake_field_id', $case_intake_field->id);
                                    $required_star = $case_intake_field->required == 1 ? '<span class="text_B4173A">*</span>' : '';
                                @endphp

                                @if($case_intake_field->field_type == "TEXTFIELD")
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                    <input type="text" placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                        data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                        value="{{ $savedAnswer->answer ?? '' }}" class="form-control myinput mb_16">


                                    <div class="invalid-feedback mb-1" id="error_tab_intake_fields.{{$case_intake_field->id}}.value"></div>
                                @endif

                                @if($case_intake_field->field_type == "DATEFIELD")
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                    <input type="date" placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                        data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                        value="{{ $savedAnswer->answer ?? '' }}" class="form-control myinput mb_16">

                                        <div class="invalid-feedback mb-1" id="error_tab_intake_fields.{{$case_intake_field->id}}.value"></div>
                                @endif

                                @if($case_intake_field->field_type == "TEXTAREA")
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}  {!! $required_star !!}</div>
                                    <textarea placeholder="{{!empty($case_intake_field->placeholder) ? $case_intake_field->placeholder:''}}"
                                        data-id="{{$case_intake_field->id}}" name="intake_fields[{{$case_intake_field->id}}][value]"
                                        class="form-control myinput mb_16" rows="5"
                                    >{{ $savedAnswer->answer ?? '' }}</textarea>

                                    <div class="invalid-feedback mb-1" id="error_tab_intake_fields.{{$case_intake_field->id}}.value"></div>
                                @endif

                                @if($case_intake_field->field_type == "DROP-DOWN-LIST")
                                    <?php
                                        $possible_options = unserialize($case_intake_field->possible_options);
                                    ?>
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}} {!! $required_star !!}</div>
                                    <select name="intake_fields[{{$case_intake_field->id}}][value]" data-id="{{$case_intake_field->id}}"
                                        class="form-control myinput mb_16">
                                        <option value="">Select</option>
                                        @foreach($possible_options as $possible_option)
                                            <option value="{{$possible_option}}"
                                                {{ ($savedAnswer && $savedAnswer->answer == $possible_option) ? 'selected' : '' }}>
                                                {{$possible_option}}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback mb-1" id="error_tab_intake_fields.{{$case_intake_field->id}}.value"></div>
                                @endif

                                @if($case_intake_field->field_type == "RADIO-BUTTON")

                                    <?php
                                        $possible_options = unserialize($case_intake_field->possible_options);
                                    ?>
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}} {!! $required_star !!}</div>
                                    @foreach($possible_options as $possible_option)
                                        <label>
                                            <input data-id="{{$case_intake_field->id}}" name="intake_fields-{{$radio_name}}" type="radio"
                                                value="{{$possible_option}}" {{ ($savedAnswer && $savedAnswer->answer == $possible_option) ? 'checked' : '' }}
                                                > {{$possible_option}}
                                        </label>
                                    @endforeach

                                    <div class="invalid-feedback mb-1" id="error_tab_intake_fields.{{$case_intake_field->id}}.value"></div>


                                    <input type="hidden" data-id="{{$case_intake_field->id}}"  name="radio_groups[]" value="{{$radio_name}}">
                                    <?php $radio_name++; ?>
                                @endif

                                @if($case_intake_field->field_type == "HEADERTITLE")
                                    <div class="text_16_400 text_404248 mb_12">{{$case_intake_field->label}}</div>
                                @endif

                            @endforeach



                        </div>
                    </div>
                    <div class="br_6 bg_F1F2F2 cp_6 mb_24 collapsable_div">
                        <div class="d-flex justify-content-between collapsable_btn">
                            <div class="text_16_700 text_404248">Lead Details</div>
                            <div>
                                <img src="<?=url('')?>/assets/images/arrow-down-grey.svg" alt="" width="16px" class="collapsable_arrow">
                            </div>
                        </div>
                        <div class="collapsable_content">
                            <div class="mb_24"></div>
                            <div class="text_16_400 text_404248 mb_12">Lead Status</div>

                            <select name="lead_status_id" id="lead_status_id" class="form-control myinput mb_16">
                                <option value="">Select</option>
                                @foreach($lead_statuses as $lead_status)
                                    <option value="{{$lead_status->id}}" {{($lead_status->id == $record->lead_status_id ) ? 'selected' : '' }}>{{$lead_status->name}}</option>
                                @endforeach
                            </select>

                            <div class="text_16_400 text_404248 mb_12">Lead assigned to</div>

                            <select name="lead_assigned_to" id="lead_assigned_to" class="form-control myinput mb_16">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{($user->id == $record->lead_assigned_to	) ? 'selected' : '' }}>{{$user->name}}</option>
                                @endforeach
                            </select>

                            <div class="text_16_400 text_404248 mb_12">Invoice Type</div>
                            <input type="text" class="form-control myinput mb_16">

                            <div class="text_16_400 text_404248 mb_12">Attorney percentage</div>
                            <input type="number" name="attorney_percentage" id="attorney_percentage" value="{{$record->attorney_percentage}}" class="form-control myinput mb_16">

                            <div class="text_16_400 text_404248 mb_12">Other Lead Notes</div>
                            <textarea name="lead_notes"  id="lead_notes" class="form-control myinput" rows="5">{{$record->lead_notes}}</textarea>

                        </div>
                    </div>
                    <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white">Save Information</button>
                </form>
            </div>

            <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                <div class="d-flex flex-wrap">
                    <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="client-email-btn" role="button">+ Send New Email</button>
                </div>
                <div class="my_table_div ">
                    <div class="cp_2">
                        <div class="text_20_700 ff_dm_sans text_404248">Email History</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table my_table mb-0 client_email">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Date sent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                <div class="br_6 bg_F1F2F2 cp_6 mb_24">
                    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Chat</div>
                    <div class="bg-white cp_6 br_6 mb_24">
                        <div class="d-flex mb_16">
                            <div class="single_chat">
                                <div class="text_16_400 text_6a6a6a66 mb_6">You - 12/03/24 00:00AM</div>
                                <div class="bg_F1F2F2 br_6 cp_15">
                                    <div class="text_12_400 text_404248">Lorem ipsum dolor sit amet consectetur. Sed nisi amet et aliquam morbi id quisque rhoncus eget. Egestas scelerisque montes velit nibh vestibulum proin id augue a. Facilisi fermentum viverra dignissim
                                        sit id eget interdum lorem purus. Quam pretium arcu arcu pulvinar elementum a diam lorem varius. Eget tristique interdum erat nunc. Interdum molestie proin venenatis egestas elit tempus. Vivamus
                                        magna egestas aliquet diam neque sed volutpat eget.</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb_16">
                            <div class="single_chat">
                                <div class="text_16_400 text_6a6a6a66 mb_6 text-right">Client Name - 12/03/24 00:00AM</div>
                                <div class="bg_FCAF3B br_6 cp_15 ">
                                    <div class="text_12_400 text-white">Lorem ipsum dolor sit amet consectetur. Sed nisi amet et aliquam morbi id quisque rhoncus eget. Egestas scelerisque montes velit nibh vestibulum proin id augue a. Facilisi fermentum viverra dignissim
                                        sit id eget interdum lorem purus. Quam pretium arcu arcu pulvinar elementum a diam lorem varius. Eget tristique interdum erat nunc. Interdum molestie proin venenatis egestas elit tempus. Vivamus
                                        magna egestas aliquet diam neque sed volutpat eget.</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mb_16">
                            <div class="single_chat">
                                <div class="text_16_400 text_6a6a6a66 mb_6">You - 12/03/24 00:00AM</div>
                                <div class="bg_F1F2F2 br_6 cp_15">
                                    <div class="text_12_400 text_404248">Lorem ipsum dolor sit amet consectetur. Sed nisi amet et aliquam morbi id quisque rhoncus eget. Egestas scelerisque montes velit nibh vestibulum proin id augue a. Facilisi fermentum viverra dignissim
                                        sit id eget interdum lorem purus. Quam pretium arcu arcu pulvinar elementum a diam lorem varius. Eget tristique interdum erat nunc. Interdum molestie proin venenatis egestas elit tempus. Vivamus
                                        magna egestas aliquet diam neque sed volutpat eget.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="mr_16"><img src="<?=url('')?>/assets/images/gallery-grey.svg" alt="" width="42px"></div>
                        <div class="mr_16"><img src="<?=url('')?>/assets/images/clip-pin.svg" alt="" width="42px"></div>
                        <input type="text" class="form-control myinput mr_16" placeholder="Type you message">
                        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_5 text-white-space-nowrap ">Send Message</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="col-xxl-4">
        <div class="br_6 bg_F1F2F2 cp_6">
            <div class="bg-white cp_6 br_6 mb_24">
                <div class="text_16_700 text_404248 mb_24">Status</div>
                <!-- <input type="text" class="form-control myinput bg_F1F2F2"> -->
                <select name="status" id="status" class="form-control myinput bg_F1F2F2 mb_16">
                    <option value="">Select</option>
                    @foreach($client_statuses as $status)
                    <option value="{{ $status->id }}" {{ $record->client_status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
                <button type="button" data-record-id="{{ $record->id }}" id="saveClientStatus" class="btn text_14_500 text-white br_6 bg_126C9B cp_5 ">Save</button>
            </div>
            <div class="bg-white cp_6 br_6 mb_24">
                <div class="text_16_700 text_404248 mb_24">All Services/Matters</div>
                <button class="btn text_14_500 text-white br_6 bg_126C9B cp_5 mb_16" id="add_service_matter">+ Add A Service Matter</button>

                <div id="add_new_service_matter" class="d-none mb_24">
                    <form action="{{ route('admin.addLead') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$record->id}}" name="client_id" id="client_id">
                        <select name="case_type" id="case_type" class="form-control myinput bg_F1F2F2 mb_16">
                            <option value="">Select</option>
                            @foreach($case_types as $case_type)
                                <option value="{{$case_type->id}}">{{$case_type->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" data-record-id="{{ $record->id }}" id="saveClientStatus" class="btn text_14_500 text-white br_6 bg_126C9B cp_5 ">Add</button>
                    </form>
                </div>

                @foreach($client_case_types as $client_case_type)
                    <a href="{{ route('admin.clientInfo', [$record->id, $client_case_type->id]) }}">
                        <div class="bg_F1F2F2 cp_11 text_14_500 text_404248 br_6 mb_16">
                            {{ $client_case_type->caseType->name }}
                        </div>
                    </a>
                @endforeach


            </div>
            <div class="bg-white cp_6 br_6 mb_24">
                <form id="client-appointment-form">
                    <input type="hidden" name="client_case_information_id" id="client_case_information_id" value="{{$case_info_record->id}}">
                    <div class="text_16_700 text_404248 mb_16">Appointments</div>

                    <div class="text_16_400 text_404248 mb_12">Date<span class="text_B4173A">*</span></div>
                    <input type="date" name="date" id="date" class="form-control myinput bg_F1F2F2 mb_16">
                    <div class="invalid-feedback" id="error_date"></div>

                    <div class="text_16_400 text_404248 mb_12">Time<span class="text_B4173A">*</span></div>
                    <input type="time" name="time" id="time" class="form-control myinput bg_F1F2F2 mb_16">
                    <div class="invalid-feedback" id="error_time"></div>

                    <div class="text_16_400 text_404248 mb_12">Type<span class="text_B4173A">*</span></div>

                    <select name="type" id="type" class="form-control myinput bg_F1F2F2 mb_16">
                        <option value="">Select</option>
                        @foreach($appointment_color_legends as $appointment_color_legend)
                            <option value="{{$appointment_color_legend->id}}">{{$appointment_color_legend->name}}</option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback" id="error_type"></div>

                    <div class="text_16_400 text_404248 mb_12">Attorney/Rep<span class="text_B4173A">*</span></div>
                    <select name="attorney" id="attorney" class="form-control myinput bg_F1F2F2 mb_16">
                        <option value="">Select</option>
                        @foreach($attorneys as $attorney)
                        <option value="{{$attorney->id}}">{{$attorney->attorney_name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="error_attorney"></div>

                    <div class="text_16_400 text_404248 mb_12">Location<span class="text_B4173A">*</span></div>

                    <select name="location" id="location" class="form-control myinput bg_F1F2F2 mb_16">
                        <option value="">Select</option>
                        @foreach($appointment_locations as $appointment_location)
                        <option value="{{$appointment_location->id}}">{{$appointment_location->address}}</option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback" id="error_location"></div>

                    <div class="text_16_400 text_404248 mb_12">Status<span class="text_B4173A">*</span></div>

                    <select name="status" id="status" class="form-control myinput bg_F1F2F2 mb_16">
                        <option value="">Select</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="rescheduled">Rescheduled</option>
                        <option value="canceled">Canceled</option>
                        <option value="flaked">Flaked</option>
                    </select>
                    <div class="invalid-feedback" id="error_status"></div>

                    <button type="submit" class="btn text_14_500 text-white br_6 bg_126C9B cp_5 ">Save</button>
                </form>
            </div>
            <div class="bg-white cp_6 br_6 mb_24">
                <div class="text_16_700 text_404248 mb_16">Court Information</div>
                <div class="text_16_400 text_404248 mb_12">Court Address</div>
                <div class="text_16_700 text_404248 mb_16">1040 W. Avenue J<br> Lancaster, CA 93534</div>
                <div class="text_16_400 text_404248 mb_12">Phone Number</div>
                <div class="text_16_700 text_404248">(661) 483-5924</div>
            </div>
            <div class="bg-white cp_6 br_6 mb_24">
                <div class="text_16_700 text_404248 mb_24">Email Templates</div>
                <input type="text" class="form-control myinput bg_F1F2F2" placeholder="Test">
            </div>
            <div class="bg-white cp_6 br_6 mb_24">
                <div class="text_16_700 text_404248 mb_24">E-Documents</div>
                <div class="d-flex mb_16">
                    <button class="btn text_14_500 text-white br_6 bg_126C9B cp_5 ">Upload New Document</button>
                    <button class="btn text_14_500 text-white br_6 bg_FCAF3B cp_5 ml_12">Create Using Template</button>
                </div>
                <div class="text_16_400 text_404248 mb_12">Based on Template</div>
                <div class="d-flex mb_16">
                    <div>
                        <img src="<?= url('') ?>/assets/images/pdf.svg" alt="" width="24px">
                    </div>
                    <div class="text_16_700 text_126C9B ml_12">Document Name</div>
                </div>
                <div class="text_16_400 text_404248 mb_12">Based on PDF</div>
                <div class="d-flex mb_16">
                    <div>
                        <img src="<?= url('') ?>/assets/images/pdf.svg" alt="" width="24px">
                    </div>
                    <div class="text_16_700 text_126C9B ml_12">Document Name</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.'.$controller.'.modals')
@include('admin.clients_list.client_script')
@endsection('content')
