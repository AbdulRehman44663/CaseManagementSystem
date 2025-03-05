
<div class="modal fade" id="addAppontmentLocation" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="create-appontmentlocation-form" method="POST">
                    <input type="hidden" id="appontmentLocationId" name="appontmentLocationId" value="">
                    <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                    <div class="text_20_700 text_404248 mb_12 main-title">Add Appointment Location</div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Address <span class="text_B4173A">*</span></div>
                        <input type="text" class="form-control myinput bg_F1F2F2" name="address" id="address">
                        <div class="invalid-feedback" id="error_address"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Suite <span class="text_B4173A">*</span></div>
                        <input type="text" class="form-control myinput bg_F1F2F2" name="suite" id="suite">
                        <div class="invalid-feedback" id="error_suite"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">City <span class="text_B4173A">*</span></div>
                        <input type="text" class="form-control myinput bg_F1F2F2" name="city" id="city">
                        <div class="invalid-feedback" id="error_city"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">State <span class="text_B4173A">*</span></div>
                        <input type="text" class="form-control myinput bg_F1F2F2" name="state" id="state">
                        <div class="invalid-feedback" id="error_state"></div>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Zip Code <span class="text_B4173A">*</span></div>
                        <input type="text" class="form-control myinput bg_F1F2F2" name="zip_code" id="zip_code">
                        <div class="invalid-feedback" id="error_zip_code"></div>
                    </div>

                    <div>
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
                        <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>