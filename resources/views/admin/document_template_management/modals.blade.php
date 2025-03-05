<style>
    .modal-xl {
       max-width: 1350px !important;
   }

</style>
<div class="modal fade" id="documentTemplateModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="<?=url('')?>/assets/images/cross-grey.svg" alt="" width="16px" data-bs-dismiss="modal" aria-label="Close" class="icon_top_right">
                <form id="e-document-template-form">

                    <input type="hidden" id="caseTypeId" name="caseTypeId" value="{{isset($case_type)?$case_type->id:''}}">
                    <input type="hidden" id="document_template_id" name="document_template_id" value="">
                    
                    <div class="main-title text_20_700 text_404248 mb_12"></div>

                    <div class="row mb_16">
                        <div class="col-xl-8">
                            <div class="mb_18">
                                <div class="text_14_500 text_404248 mb_6">Document Template Name <span class="text_B4173A">*</span></div>
                                <input type="text" name="template_name" id="template_name" class="form-control bg_F1F2F2 myinput">
                                <div class="invalid-feedback" id="error_template_name"></div>
                            </div>
                            
                            <div class="mb_18">
                                <div class="text_14_500 text_404248 mb_6">Body <span class="text_B4173A">*</span></div>
                                <div class="position-relative mb-30">
                                    <textarea name="document_body" id="document_body" style="display:none" placeholder="Type text here...."></textarea>
                                    <div class="form-control bg_F1F2F2" id="document_template_quill_editor" style="height: 420px;">
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="error_document_body"></div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                            <div class="text_14_500 text_404248 mb_6">Variables List</div>
                            <div class="bg_F1F2F2 br_8 cp_6 documentTemplateTagList emailTemplateTagCss">
                                @foreach ($doc_variables as $doc_variable)
                                    <div class="text_12_700 text_6A6A6A mb_16">{{ '{'.$doc_variable->variable_name.'}' }}</div>
                                @endforeach
                                 
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="text_20_700 text_404248 mb_24">Insert Variables</div>
                            <div class="text_14_500 text_404248 mb_6">Variables List</div>
                            <div class="bg_F1F2F2 br_8 cp_6 documentTemplateTagList emailTemplateTagCss">
                                @foreach ($doc_lawyer_variables as $doc_lawyer_variable)
                                    <div class="text_12_700 text_6A6A6A mb_16">{{ '{'.$doc_lawyer_variable->variable_name.'}' }}</div>
                                @endforeach
                                 
                            </div>
                        </div>

                        {{-- <div class="col-xl-3">
                            <div class="text_20_700 text_404248 mb_24">Variables List</div>
                            <div class="text_14_500 text_404248  mb_6">(Click to copy placeholder)</div>
                            <div class="bg_F1F2F2 br_8 cp_6 doc-tem-variable-container">
                                
                                <div class="text_16_400 text_404248 mb_16 variable-item" data-variable = "{{$document_variable->variable}}" value="{{$document_variable->id}}">{{$document_variable->variable}}</div>
                                
                            </div>
                        </div> --}}
                    </div>

                    <div>
                        <button type="submit" class="submit-btn text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16"></button>
                        <button type="button" data-bs-dismiss="modal" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_13 mybtn text-white">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>