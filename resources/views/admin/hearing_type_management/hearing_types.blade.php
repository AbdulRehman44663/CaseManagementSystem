
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}} - Hearing Types</div>
    <div class="d-flex flex-wrap justify-content-end">
        <button id="create-hearing-type-btn" class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12">+ Add Hearing Types</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">{{$controller_name}} - Hearing Types</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 hearing_type">
                <thead>
                    <tr>
                        <th>Name/ Description</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
    @include('admin.'.$controller.'.modals') 
    @include('admin.hearing_type_management.hearing_type_script') 
@endsection('content')