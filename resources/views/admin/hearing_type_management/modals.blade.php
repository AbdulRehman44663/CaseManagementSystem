

<div class="modal fade" id="addHearingTypes" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <form id="hearingtype-form" method="POST">
                    <input type="hidden" id="hearingTypeId" name="hearingTypeId" value="">
                    <input type="hidden" id="caseTypeId" name="caseTypeId" value="{{isset($case_type)?$case_type->id:''}}">
                    <div class="text_20_700 text_404248 mb_12"><span class="main-title">Add a new</span> Hearing Type for {{$controller_name}}</div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Name/ Description <span class="text_B4173A">*</span></div>
                        <input type="text" id="name_desc" name="name_desc" class="form-control myinput bg_F1F2F2 name_desc">
                        <div class="invalid-feedback" id="error_name_desc"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248">Color <span class="text_B4173A">*</span></div>
                        <div class="mb_24 colorPickerDiv position-relative">
                            <div class="color_icon btnColorPicker" style="background: #000;"  id="color_bg"></div>
                            <input type="color" class="inputColorPicker color_name" id="color_name" name="color_name" value="#000">
                            
                        </div>
                        <div class="invalid-feedback" id="error_color_name"></div>
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