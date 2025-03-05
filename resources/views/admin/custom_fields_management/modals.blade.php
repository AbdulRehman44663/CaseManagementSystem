

<div class="modal fade" id="addaGroup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="custom-group-form">
                    <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                    <input type="hidden" name="case_type_id" id="case_type_id" value="{{$case_type->id}}">
                    <input type="hidden" name="group_id" id="group_id" value="">
                    <div class="mb_24">
                        <div class="text_20_700 text_404248 mb_24 main-title"></div>
                        <div class="text_14_500 text_404248 mb_6">Label <span class="text_B4173A">*</span></div>
                        <input type="text" name="label" id="label" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_attorney_name"></div>
                    </div>
                    <div>
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 submit-btn"></button>
                        <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addaGroupFields" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="custom-group-fields-form">
                    <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">

                    <input type="hidden" name="custom_group_id" id="custom_group_id" value="{{isset($custom_group) && !empty($custom_group) ? $custom_group->id : ''}}">

                    <input type="hidden" name="group_field_id" id="group_field_id" value="">

                    <div class="text_20_700 text_404248 mb_24 main-title"></div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Label <span class="text_B4173A">*</span></div>
                        <input type="text" name="label" id="detail_label" class="form-control myinput bg_F1F2F2">
                        <div class="invalid-feedback" id="error_label"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Description <span class="text_B4173A">*</span></div>
                        <textarea class="form-control myinput bg_F1F2F2" name="description" id="description" rows="4"></textarea>
                        <div class="invalid-feedback" id="error_description"></div>
                    </div>

                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Field Type <span class="text_B4173A">*</span></div>
                        <select name="field_type" id="field_type" class="form-control myinput bg_F1F2F2 select_list_icon">
                            <option value="">Select a type field type</option>
                            <optgroup label="UI Component">
                                <option value="DATEFIELD">DATEFIELD</option>
                                <option value="TEXTFIELD">TEXTFIELD</option>
                                <option value="TEXTAREA">TEXTAREA</option>
                                <option value="DROP-DOWN-LIST">DROP-DOWN LIST</option>
                                <option value="RADIO-BUTTON">RADIO BUTTON</option>
                            </optgroup>

                            <optgroup label="Fixed Content">
                                <option value="HEADERTITLE">HEADERTITLE</option>
                            </optgroup>
                        </select>
                        <div class="invalid-feedback" id="error_field_type"></div>
                    </div>

                    <div class="mb_18">    
                        <div id="placeholder-container">
                            <div class="text_14_500 text_404248 mb_6">Placeholder</div>
                            <input type="text" name="placeholder" id="placeholder" class="form-control myinput bg_F1F2F2">
                            <div class="invalid-feedback" id="error_placeholder"></div>
                        </div>
                    </div>

                    <div class="text_14_500 text_404248 mb_6" id="possible-option-container" style="display: none;">
                        Possible Option <span class="text_B4173A">*</span>
                        <div class="invalid-feedback" id="error_possible_options"></div>
                        {{-- <span class="text-danger" id="possible_options-error"></span> --}}
                    </div>
                    <div id="possible-options-container" style="display: none;">
                        {{-- <input type="text" name="possible_options[]" class="form-control myinput bg_F1F2F2 mb_18">
                        <span class="text-danger" id="possible_options-error"></span> --}}
                        
                    </div>

                    <div id="add-options-text" style="display: none;" class="text_14_700 text_126C9B mb_18"><u>+ Add Possible Options</u></div>
                    
                    <div class="text_14_500 text_404248 mb_6">Visible? <span class="text_B4173A">*</span></div>

                    <div class="mb_24 d-flex">
                        <label class="radio_container">Yes
                            <input type="radio" id="visible_yes" name="visible" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio_container ml_24">No
                            <input type="radio" id="visible_no" name="visible" value="0" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="text_14_500 text_404248 mb_6">Required? <span class="text_B4173A">*</span></div>

                    <div class="mb_24 d-flex">
                        <label class="radio_container">Yes
                            <input type="radio" id="required_yes" name="required" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio_container ml_24">No
                            <input type="radio" id="required_no" name="required" value="0" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 submit-btn"></button>
                        <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>