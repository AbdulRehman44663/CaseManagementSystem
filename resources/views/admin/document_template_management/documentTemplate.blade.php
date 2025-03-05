@extends('admin.layout.dashboard')
@section('content')           

    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

<div class="d-flex flex-wrap justify-content-end">
    <a class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="document-template-management">+ Add  Document Templates</a>
</div>
<div class="my_table_div ">
    <div class="cp_2">
        <div class="text_20_700 ff_dm_sans text_404248">{{$case_type->name}} - Document Templates</div>
    </div>
    <div class="table-responsive">
        <table class="table my_table mb-0 e_document_table">
            <thead>
                <tr>
                    <th>Name/ Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
       
    </div>
</div>
@include('admin.document_template_management.document-template-script')
    @include('admin.'.$controller.'.modals') 
@endsection('content')