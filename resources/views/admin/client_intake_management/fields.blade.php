@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

<div class="d-flex flex-wrap justify-content-end">
    <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_24 mr_12" data-bs-toggle="modal" data-case-id="{{ request()->route('case_id') }}" data-action-type="add" href="#addaLegend" role="button">+ Add a Field</button>
</div>
<div class="text_16_700 text_404248 mb_24">Group Name Custom Fields</div>

<!-- Wrap the fields div in a sortable container -->
<div id="sortable-fields">
    @foreach($fields as $key => $field)
    <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative sortable-item" id="{{$field->id}}">
        <div class="icon_top_right">
            <div class="d-flex">
                <div class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addaLegend" data-action-type="edit" data-case-id="{{ request()->route('case_id') }}" data-field-id="{{ $field->id }}" role="button">
                    <div>
                        <img src="{{ url('') }}/assets/images/pencile-blue.svg" alt="" width="14px">
                    </div>
                    <div class="text_14_500 text_126C9B ml_6">Edit</div>
                </div>
                <div class="d-flex align-items-center ml_24">
                    <div>
                        <img src="<?= url('') ?>/assets/images/delete-red.svg" alt="" width="14px">
                    </div>
                    <div class="field" data-id="{{$field->id}}">
                        <div class="text_14_500 text_FC3B3B ml_6 delete-btn" style="cursor: pointer;">Delete</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Label:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">{{$field->label}}</div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Desription:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">{{$field->description}}</div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Order:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A order_field_{{$field->id}}">{{$field->order_number}}</div>
                </div>
            </div>
        </div>

        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Field Type:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">{{$field->field_type}}</div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Palceholder:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">{{$field->placeholder}}</div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Is Required?:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">
                        {{ $field->required == 1 ? 'YES' : 'NO' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb_16">
            <div class="col-sm-2">
                <div class="text_20_700 txet_404248">Is Visible?:</div>
            </div>
            <div class="col-sm-5 display_table">
                <div class="vertical_center">
                    <div class="text_20_400 txet_6A6A6A">{{ $field->visible == 1 ? 'YES' : 'NO' }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('admin.'.$controller.'.modals')
@include('admin.client_intake_management.client-intake-script')

@endsection('content')

<script>
$(function() {
    // Enable sortable functionality
    $("#sortable-fields").sortable({
        update: function(event, ui) {
            // Handle sorting updates here (e.g., save the new order)
            let sortedIDs = $(this).sortable("toArray");
            console.log(sortedIDs); // Do something with the new order, like saving it to the database
        }
    });
});
</script>
