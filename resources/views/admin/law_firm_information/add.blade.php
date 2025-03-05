

@extends('admin.layout.dashboard')
@section('content')
    <form id="update-lawfirmInforamtion-form" method="POST">
        <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
        <div class="br_6 bg_F1F2F2 cp_6 mb_24">
            <div class="text_16_700 text_404248 mb_24">Edit Company Info</div>
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="cp_17">
                        <div class="text_16_400 text_404248 mb_12">Company Name <span class="text_B4173A">*</span></div>
                        <input type="text" name="company_name" class="form-control myinput mb_16" placeholder="Company Name" value="{{isset($data)?$data->company_name:''}}">
                        <div class="invalid-feedback" id="error_company_name"></div>
                        <div class="text_16_400 text_404248 mb_12">Attorney 1</div>
                        <input type="text" name="attorney_1" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->attorney_1:''}}">
                        <div class="text_16_400 text_404248 mb_12">Attorney 2</div>
                        <input type="text" name="attorney_2" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->attorney_2:''}}">
                        <div class="text_16_400 text_404248 mb_12">Attorney 3</div>
                        <input type="text" name="attorney_3" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->attorney_3:''}}">
                        <div class="text_16_400 text_404248 mb_12">Address</div>
                        <input type="text" name="address" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->address:''}}">
                        <div class="text_16_400 text_404248 mb_12">Suite</div>
                        <input type="text" name="suite" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->suite:''}}">
                        
                        <div class="text_16_400 text_404248 mb_12">City, State, Zip</div>
                        <input type="text" id="city_state_zip" name="city_state_zip" class="form-control myinput mb_16" placeholder="City, ST ZIP"  value="{{isset($data)?$data->city_state_zip:''}}">
                        <div class="invalid-feedback" id="error_city_state_zip"></div>
                        
                        <div class="text_16_400 text_404248 mb_12">Telephone No.</div>
                        <input type="text" name="telephone_no" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->telephone_no:''}}">
                        <div class="invalid-feedback" id="error_telephone_no"></div>


                        <div class="text_16_400 text_404248 mb_12">Fax No.</div>
                        <input type="text" name="fax_no" id="fax_no" class="form-control myinput mb_16" 
                            placeholder="" value="{{ isset($data) ? $data->fax_no : '' }}">
                        <div class="invalid-feedback" id="error_fax_no"></div>

                        {{-- <div class="text_16_400 text_404248 mb_12">Fax No.</div>
                        <input type="text" name="fax_no" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->fax_no:''}}">
                        <div class="invalid-feedback" id="error_fax_no"></div> --}}

                        <div class="text_16_400 text_404248 mb_12">Email Address</div>
                        <input type="text" name="email_address" class="form-control myinput mb_16" placeholder="" value="{{isset($data)?$data->email_address:''}}">
                        <div class="text_16_400 text_404248 mb_12">Email Signature</div>
                        <textarea name="email_signature" id="email_signature" class="form-control myinput mb_16" placeholder="" rows="5">{{isset($data)?$data->email_signature:''}}</textarea>

                        <div class="text_16_400 text_404248 mb_12">Show Email signature</div>
                        <div class="mb_24 d-flex">
                            <label class="radio_container">Yes
                                <input type="radio" {{ isset($data) && $data->show_email_signature=='1'?'checked="checked"':''}} name="show_email_signature" value="1">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio_container ml_24">No
                                <input type="radio" {{ isset($data) && $data->show_email_signature=='0'?'checked="checked"':''}}  name="show_email_signature" value="0">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Save Information</button>
                {{-- <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button> --}}
            </div>
        </div>
        <div class="br_6 bg_F1F2F2 cp_6 mb_24">
            <div class="text_16_700 text_404248 mb_10">Logo Image</div>
            <div class="text_16_400 text_404248 mb_12"><span class="text_16_400">Note:</span>Acceptable formats: .jpeg .png & .gif. For better results please upload your logo with a size of 350px by 125px. You can still upload a logo smaller or bigger than the recommended size, however,
                the system will automatically re-size it to 350px * 125px.</div>
            <div class="text_14_500 text_6A6A6A mb_8">Upload logo Image <span class="text_B4173A">*</span></div>
            <div class="d-flex align-items-end">
                <div class="position-relative w_fit_content img_container">
                    <img src="{{isset($data)?url('uploads/'.$data->logo_image):url('assets/images/user-pic.png')}} " alt="" width="93px" class="logoPlaceholder">
                    {{-- <img src="<?=url('')?>/assets/images/trash-red.svg" alt="" class="icon_top_right2 delImage" width="9px"> --}}
                    <input type="hidden" name="logo_image" class="logoDataImg">
                </div>
                <div class="text_14_700 text_126C9B ml_9" data-bs-toggle="modal" id="choose_another_logo" role="button"><u>Choose another logo</u></div>
            </div>
            <div class="invalid-feedback" id="error_logo_image"></div>
        </div>
        <div class="br_6 bg_F1F2F2 cp_6 mb_24">
            <div class="text_16_700 text_404248 mb_10">Upload Signatures</div>
            <div class="text_16_400 text_404248 mb_12"><span class="text_16_400">Note:</span> Please be sure to write your signature using your cell phone for better results. If using an Iphone please be sure to use the Safari browser and if using Android please be sure to use Chrome browser.</div>
            <div class="text_14_500 text_6A6A6A mb_8">Add Signature <span class="text_B4173A">*</span></div>
            <div class="d-flex align-items-end">
                <div class="position-relative w_fit_content">

                    <img src="{{isset($data)?url('uploads/'.$data->signature):url('assets/images/signature.png')}}" alt="" width="93px" class="signaturePlaceholder">

                    <input type="hidden" name="signature" class="signatureValue">
                </div>
                <div class="text_14_700 text_126C9B ml_9" data-bs-toggle="modal" href="#enterSignature" role="button"><u>Change signature</u></div>
            </div>
            <div class="invalid-feedback" id="error_signature"></div>
        </div>
    </form>
    @include('admin.'.$controller.'.modals')
@endsection('content')
@include('admin.law_firm_information.scripts')
