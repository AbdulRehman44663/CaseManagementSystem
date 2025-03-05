<style>
     .modal-xl {
        max-width: 1350px !important;
    }

</style>
<div class="modal fade" id="addEmailTemplate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                
                <form id="email-template-form" method="POST">
                    <input type="hidden" id="emailTempalteId" name="emailTempalteId" value="">
                    <input type="hidden" id="caseTypeId" name="caseTypeId" value="{{isset($case_type)?$case_type->id:''}}">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="text_20_700 text_404248 mb_24"><span class="main-title">Create</span> Email Template</div>

                            <div class="mb_18">
                                <div class="text_14_500 text_404248 mb_6">E-mail Template Name <span class="text_B4173A">*</span></div>
                                <input type="text" class="form-control myinput bg_F1F2F2" name="name" id="name">
                                <div class="invalid-feedback" id="error_name"></div>
                            </div>

                            <div class="mb_18">
                                <div class="text_14_500 text_404248 mb_6">E-mail Subject <span class="text_B4173A">*</span></div>
                                <input type="text" class="form-control myinput bg_F1F2F2" name="subject" id="subject">
                                <div class="invalid-feedback" id="error_subject"></div>
                            </div>

                            <div class="mb_18">
                                <div class="text_14_500 text_404248 mb_6">E-mail Body <span class="text_B4173A">*</span></div>
                                <div class="position-relative mb-30">
                                    <textarea name="email_body" id="email_body" style="display:none" placeholder="Type text here...."></textarea>
                                    <div class="form-control bg_F1F2F2" id="quilleditor" style="height: 320px;">
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="error_email_body"></div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                            <div class="text_14_500 text_404248 mb_6">Variables List</div>
                            <div class="bg_F1F2F2 br_8 cp_6 emailTemplateTagList emailTemplateTagCss">
                                @foreach ($email_variables as $email_variable)
                                    <div class="text_12_700 text_6A6A6A mb_16">{{ '{'.$email_variable->variable_name.'}' }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                            <div class="text_14_500 text_404248 mb_6">Variables List</div>
                            <div class="bg_F1F2F2 br_8 cp_6 emailTemplateTagList emailTemplateTagCss">
                                @foreach ($email_lawyer_variables as $email_lawyer_variable)
                                    <div class="text_12_700 text_6A6A6A mb_16">{{ '{'.$email_lawyer_variable->variable_name.'}' }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 submit-btn">Submit</button>
                        <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
