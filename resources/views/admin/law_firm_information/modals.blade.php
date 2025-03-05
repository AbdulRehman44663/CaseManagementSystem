
<div class="modal fade" id="enterSignature" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" class="icon_top_right closeSignature">
                <div class="text_20_700 text_404248 mb_24">Enter Signature</div>
                <canvas id="signatureSketchpad" class="signatureSketchpad"></canvas>
                <p class="text-danger signatureError" style="display: none;"></p>

                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 submitsignature">Submit Signature</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white clearSignature">Clear Signature</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="enterLogo" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px"   class="icon_top_right closelogo">
                <div class="text_20_700 text_404248 mb_24">Enter Logo</div>
                <div class="bg_F1F2F2 br_8 mb_29">
                    <div class="bg_F1F2F2 br_8 cp_12 position_relative text-center">
                        <div class="inputZoneDiv">
                            <img src="" alt="" id="logo_preview" class="logo_preview">
                            <div class="inputZone">
                                <div class="text_14_400 text_404248 text-center" id="logoDropZone">Drag & Drop your files or <u>Browse</u></div>
                                <input type="file" name="logo" class="inputFileDropZone">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16 uploadLogo">Upload Logo</button>
                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white closelogo">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>