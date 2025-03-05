
<div class="modal fade" id="attorneyManagementModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <form id="attorney-management-form">
                    <div class="text_20_700 text_404248 mb_12 main-title"></div>

                    <input type="hidden" name="attorneyId" id="attorneyId" value="">
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Attorney Name <span class="text_B4173A">*</span></div>
                        <input type="text" name="attorney_name" id="attorney_name" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_attorney_name"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Address <span class="text_B4173A">*</span></div>
                        <input type="text" name="address" id="address" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_address"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Suite <span class="text_B4173A">*</span></div>
                        <input type="text" name="suite" id="suite" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_suite"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">City, State Zip <span class="text_B4173A">*</span></div>
                        <input type="text" name="city_state_zip" id="city_state_zip" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_city_state_zip"></div>
                    </div>
                  
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Phone Number <span class="text_B4173A">*</span></div>
                        <input type="text" name="phone_number" id="phone_number" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_phone_number"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Email Address <span class="text_B4173A">*</span></div>
                        <input type="text" name="email" id="email" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_email"></div>
                    </div>
                    
                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"></button>
                        <button type ="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>