@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
<div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Manage and define the labels for all yout labels.</div>
<div class="d-flex justify-content-between">
    <div class="d-flex mb_24">
        <button id="showEmailTable" class="btn text_14_400 text-white br_6 bg_FCAF3B cp_3 d-flex align-items-center">
            Email Variables
        </button>
        <button id="showDocumentTable" class="btn ml_24 text_14_400 text_6A6A6A br_6 bg_F1F2F2 cp_3 d-flex align-items-center">
            Document Variables
        </button>
    </div>
    <div class="mb_24">
        <button class="btn text_14_400 text-white br_6 bg_126C9B cp_3 d-flex align-items-center" data-bs-toggle="modal" href="#addNewVariable" role="button">
            + Add New Variable
        </button>
    </div>
</div>
<div class="my_table_div">
    <!-- Email Table -->
    <div id="emailTable" class="table-section">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Email Variables</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table email_table mb-0">
                <thead>
                    <tr>
                        <th>Variable</th>
                        <th>Label</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Email records go here -->
                </tbody>
            </table>


        </div>
    </div>

    <!-- Document Table -->
    <div id="documentTable" class="table-section d-none">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Document Variables</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table document_table mb-0">
                <thead>
                    <tr>
                        <th>Variable</th>
                        <th>Label</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Document records go here -->
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('admin.'.$controller.'.modals')
@include('admin.variables.variables_script')
@endsection('content')