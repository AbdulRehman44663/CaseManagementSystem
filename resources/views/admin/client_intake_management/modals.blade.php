<div class="modal fade" id="addaLegend" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?= url('') ?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <form id="client-intake-fields">
                    <input type="hidden" id="caseTypeId" name="caseTypeId" value="{{ request()->route('case_id') }}">
                    <input type="hidden" id="fieldId" name="fieldId" value="">
                    
                    <div class="mb_18">
                        <div class="text_20_700 text_404248 mb_24">Add Custom Field</div>
                        <div class="text_14_500 text_404248 mb_6">Label <span class="text_B4173A">*</span></div>
                        <input type="text" name="label" id="label" class="form-control myinput bg_F1F2F2">
                        <span class="text-danger" id="label-error"></span>
                    </div>
                    
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Description <span class="text_B4173A">*</span></div>
                        <textarea class="form-control myinput bg_F1F2F2" name="description" id="description" rows="4"></textarea>
                        <span class="text-danger" id="description-error"></span>
                    </div>
                    <div class="mb_18">
                        <div class="text_14_500 text_404248 mb_6">Field Type <span class="text_B4173A">*</span></div>
                        <select id="field_type" name="field_type" class="form-control myinput bg_F1F2F2 select_list_icon">
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
                        <span class="text-danger" id="field_type-error"></span>
                    </div>
                    <div class="mb_18">    
                        <div id="placeholder-container">
                            <div class="text_14_500 text_404248 mb_6">Placeholder</div>
                            <input type="text" name="placeholder" id="placeholder" class="form-control myinput bg_F1F2F2">
                            <span class="text-danger" id="placeholder-error"></span>
                        </div>
                    </div>

                    <div class="text_14_500 text_404248 mb_6" id="possible-option-container" style="display: none;">
                        Possible Option <span class="text_B4173A">*</span>
                        <span class="text-danger" id="possible_options-error"></span>
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
                        <button type="submit" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>