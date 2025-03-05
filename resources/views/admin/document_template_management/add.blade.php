
            
@extends('admin.layout.dashboard')
@section('content')           

    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="bg_F1F2F2 br_10 cp_6">
        <div class="row">
            <div class="col-xl-9">
                <div class="text_14_500 text_6A6A6A mb_6">Document Template Name <span class="text_B4173A">*</span></div>
                <input type="text" class="form-control myinput mb_24">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text_14_500 text_6A6A6A mb_6">Tools</div>
                    </div>
                    <div class="col-md-8">
                        <div class="text_14_500 text_6A6A6A mb_6">Document <span class="text_B4173A">*</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                <div class="text_14_500 text_6A6A6A mb_6">Variables List</div>
                <div class="bg-white br_8 cp_6">
                    <div class="text_16_400 text_6A6A6A mb_16">{CLIENT_SIGNATURE_1}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{CLIENT_NAME_2}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{ALT_PHONE_NUMBER_NAME}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_ATTORNEY_ADDRESS}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_ATTORNEY_FAX}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_OFFICE_LOGO}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_OFFICE_NAME}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_SIGNATURE_DATE}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_ATTORNEY_NAME}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{DRIVER_LICENSE_NO}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{ALT_PHONE_NUMBER_2}</div>
                    <div class="text_16_400 text_6A6A6A mb_16">{LAWYER_SIGNATURE_DATE}</div>
                </div>
            </div>
        </div>
        <div>
            <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Create Document</button>
            <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
        </div>
    </div>
    @include('admin.'.$controller.'.modals') 
@endsection('content')