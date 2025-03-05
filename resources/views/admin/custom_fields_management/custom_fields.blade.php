
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="d-flex flex-wrap justify-content-end">
        <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_24 mr_12"  id="create-custom-group-btn" role="button">+ Add a Group</button>
    </div>
    <div class="text_16_700 text_404248 mb_24">Custom Field Groups</div>
    <div id="sortable-fields">
        @foreach($custom_groups as $key => $custom_group)
            <div class="bg_F1F2F2 br_8 cp_6 mb_24 sortable-item" id="{{$custom_group->id}}">
                <div class="row">
                    <div class="col-md-9 order-2 order-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text_20_700 text_126C9B mb_24">{{$custom_group->label}}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="text_14_700 text_404248 mb_24">Order: <span class="text_14_400 order_field_{{$custom_group->id}}">{{$custom_group->order_number}}</span></div>
                            </div>
                            <div class="col-md-4">
                                <div class="text_14_700 text_404248 mb_24">Number of fields: <span class="text_14_400">{{$custom_group->custom_field_detail_count}}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 order-1 order-md-2">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex align-items-center"  onclick="editCustomGroup({{$custom_group->id}})"  role="button">
                                <div>
                                    <img src="<?=url('')?>/assets/images/pencile-blue.svg" alt="" width="14px">
                                </div>
                                <div class="text_14_500 text_126C9B ml_6">Edit</div>
                            </div>
                            <div class="d-flex align-items-center ml_24" onclick="deleteCustomGroup({{$custom_group->id}})" style="cursor: pointer;">
                               
                                    <img src="<?=url('')?>/assets/images/delete-red.svg" alt="" width="14px">
                                
                                <div class="text_14_500 text_FC3B3B ml_6">Delete</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('admin.customFieldsGroup', $custom_group->id)}}" class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">View Group Details</a>
            </div>
        @endforeach
    </div>
    
    @include('admin.'.$controller.'.modals')
    @include('admin.custom_fields_management.custom-management-script')  
@endsection('content')
 