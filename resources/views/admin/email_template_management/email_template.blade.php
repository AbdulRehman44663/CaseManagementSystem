
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="d-flex flex-wrap justify-content-end">
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="create-email-template-btn">+ Add Email Templates</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">{{$case_type->name}} - Email Template</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 email_templates">
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
    
    @include('admin.'.$controller.'.modals') 
    @include('admin.email_template_management.email_template_script') 
@endsection('content')