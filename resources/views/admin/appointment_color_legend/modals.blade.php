
<div class="modal fade" id="addALengend" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="appointment-color-form">
                    <input type="hidden" name="appointmentId" id="appointmentId" value="">
                    <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                    <div class="text_20_700 text_404248 mb_12 main-title"></div>
                    
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Name/ Description <span class="text_B4173A">*</span></div>
                        <input type="text" name="name" id="name" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_name"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Color <span class="text_B4173A">*</span></div>
                        <div class="mb_24 colorPickerDiv position-relative">
                            <div class="color_icon btnColorPicker" style="background: #000;"  id="color_bg"></div>
                            <input type="color" name="color" id="color" class="inputColorPicker">
                            <div class="invalid-feedback" id="error_color"></div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"></button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>