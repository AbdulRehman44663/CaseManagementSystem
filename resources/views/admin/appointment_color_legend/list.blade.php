
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="d-flex flex-wrap justify-content-end">
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="appoinment-color-legend-btn" role="button">+ Add a Legend</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Color Legend</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 appointment_color">
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
    @include('admin.appointment_color_legend.appointment-color-script')
    @include('admin.'.$controller.'.modals') 
@endsection('content')