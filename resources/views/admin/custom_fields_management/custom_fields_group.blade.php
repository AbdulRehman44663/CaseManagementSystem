
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

    <div class="d-flex flex-wrap justify-content-end">
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_24 mr_12" id="create-custom-group-fileds-btn" role="button">+ Add a Fields</button>
    </div>
    <div class="text_16_700 text_404248 mb_24">{{$custom_group->label}} Custom Fields</div>
    <div id="sortable-fields-detail">
        @foreach ($custom_group_details as $key => $custom_group_detail)
            <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative sortable-item" id="{{$custom_group_detail->id}}">
                <div class="icon_top_right">
                    <div class="d-flex">
                        <div class="d-flex align-items-center" onclick="editCustomGroupDetail({{$custom_group_detail->id}})" role="button">
                            <div>
                                <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                            </div>
                            <div class="text_14_500 text_126C9B ml_6">Edit</div>
                        </div>
                        <div class="d-flex align-items-center ml_24" onclick="deleteCustomGroupDetail({{$custom_group_detail->id}})">
                            <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                            <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Label:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A">{{$custom_group_detail->label}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Desription:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A">{{$custom_group_detail->description}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Order:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A order_field_{{$custom_group_detail->id}}">{{$custom_group_detail->order_number}}</div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Field Type:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A">{{$custom_group_detail->field_type}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Palceholder:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A">{{$custom_group_detail->placeholder}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Is Required?:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A"> {{ $custom_group_detail->required == 1 ? 'YES' : 'NO' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb_16">
                    <div class="col-sm-2">
                        <div class="text_20_700 txet_404248">Is Visible?:</div>
                    </div>
                    <div class="col-sm-5 display_table">
                        <div class="vertical_center">
                            <div class="text_20_400 txet_6A6A6A">{{ $custom_group_detail->visible == 1 ? 'YES' : 'NO' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
   
    
    @include('admin.'.$controller.'.modals')
    @include('admin.custom_fields_management.custom-management-script')  
@endsection('content')