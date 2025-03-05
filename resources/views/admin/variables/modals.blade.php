<div class="modal fade" id="addNewVariable" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?= url('') ?>/assets/images/cross-grey.svg" alt="Close" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <div id="modalTitle" class="text_20_700 text_404248 mb_24">Add New Variable</div>
                <p id="modalDescription" class="visually-hidden">Use this form to add or edit a variable.</p>

                <div class="text_14_500 text_404248 mb_6">Variable <span class="text-danger">*</span></div>
                <input type="text" id="variable" name="variable" class="form-control myinput bg_F1F2F2 mb_18" placeholder="" required>

                <div class="text_14_500 text_404248 mb_6">Label <span class="text-danger">*</span></div>
                <input type="text" name="label" id="label" class="form-control myinput bg_F1F2F2 mb_18" placeholder="" required>

                <div class="text_14_500 text_404248 mb_22">Variable Category</div>
                <div class="mb_24 d-flex">
                    <label class="radio_container">Document
                        <input type="radio" id="radio_document" name="category" value="document" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio_container ml_24">Email
                        <input type="radio" id="radio_email" name="category" value="email">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio_container ml_24">Both
                        <input type="radio" id="radio_both" name="category" value="both">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 save-variable" data-id="">Save Variable</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
