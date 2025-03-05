
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="d-flex flex-wrap justify-content-end">
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="create-ad-placement-btn" role="button">+ Add New Area</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">AD Placement Area1</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table ad_placement mb-0">
                <thead>
                    <tr>
                        <th>Name/ Description</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    
    @include('admin.'.$controller.'.modals') 
    @include('admin.ad_placement.ad-placement-script')
@endsection('content')