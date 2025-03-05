
            
@extends('admin.layout.dashboard')
@section('content')  
         
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Manage all your case types with this simple and easy to use tool.
        <br><br> Our system comes pre-loaded with 14 different types of practice areas as detailed below,these practice areas cannot be modified and are locked to the system, however, you can add as many practice areas to fit your practice.</div>
    <div class="d-flex flex-wrap justify-content-end">
       
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="create-case-type-btn" role="button">+ Add Case Type</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Case Type</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table case_type mb-0">
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
    @include('admin.case_type_management.case_type_script') 
@endsection('content')