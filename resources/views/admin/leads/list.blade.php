@extends('admin.layout.dashboard')
@section('content')
{{-- @push('styles')
@include('admin.leads.css.style')
@endpush --}}

<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
<div class="d-flex justify-content-between flex-wrap">
    <div class="d-flex mb_24">
        <input type="text" class="form-control search_input text_16_500 dateRange" placeholder="">
        <button class="btn search_input_date ml_13 text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
    </div>
    <div class="mb_24">
        <a class="btn text_14_400 text-white br_6 bg_126C9B cp_3" href="{{route('admin.addLead')}}">+ Add New Lead</a>
    </div>
</div>
<div class="my_table_div mb_26">
    <div class="cp_2">
        <div class="text_20_700 ff_dm_sans text_404248">All Leads</div>
    </div>
    <div class="table-responsive">
        <table class="table my_table mb-0">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xxl-3 col-xl-4 col-lg-6">
        <a href="{{route('admin.clientsRetained')}}">
            <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                <div class="d-flex justify-content-between mb_12">
                    <div>
                        <img src="<?= url('') ?>/assets/images/client-retained.svg" alt="" width="24px">
                    </div>
                    <div class="text_36_600 text_6A6A6A ff_bahnschrift">0</div>
                </div>
                <div class="text_16_500 text_6A6A6A">Clients Retained</div>
            </div>
        </a>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-6">
        <a href="{{route('admin.totalOfLeadsNotRetained')}}">
            <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                <div class="d-flex justify-content-between mb_12">
                    <div>
                        <img src="<?= url('') ?>/assets/images/client-not-retained.svg" alt="" width="24px">
                    </div>
                    <div class="text_36_600 text_6A6A6A ff_bahnschrift">0</div>
                </div>
                <div class="text_16_500 text_6A6A6A">Total Leads Not Retained</div>
            </div>
        </a>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-6">
        <div class="bg_F1F2F2 br_6 cp_7 mb_24">
            <div class="d-flex justify-content-between mb_12">
                <div>
                    <img src="<?= url('') ?>/assets/images/amount-coins.svg" alt="" width="24px">
                </div>
                <div class="text_36_600 text_6A6A6A ff_bahnschrift">0</div>
            </div>
            <div class="text_16_500 text_6A6A6A">Amount to be Collected from Retained Clients</div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-6">
        <a href="{{route('admin.totalOfDeadLeads')}}">
            <div class="bg_F1F2F2 br_6 cp_7 mb_24">
                <div class="d-flex justify-content-between mb_12">
                    <div>
                        <img src="<?= url('') ?>/assets/images/dead-deals.svg" alt="" width="24px">
                    </div>
                    <div class="text_36_600 text_6A6A6A ff_bahnschrift">0</div>
                </div>
                <div class="text_16_500 text_6A6A6A">Dead Deals</div>
            </div>
        </a>
    </div>
</div>
<div class="d-flex leads_card_div">
    <div class="leads_card">
        <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
            <div class="text_16_500 text-white">New Lead</div>
            <div>
                <img src="<?= url('') ?>/assets/images/xls-yellow.svg" alt="" width="24px">
            </div>
        </div>
    </div>
    <div class="leads_card">
        <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
            <div class="text_16_500 text-white">Contact Made</div>
            <div>
                <img src="<?= url('') ?>/assets/images/xls-yellow.svg" alt="" width="24px">
            </div>
        </div>
    </div>
    <div class="leads_card">
        <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
            <div class="text_16_500 text-white">Follow-up (1) $0.00</div>
            <div>
                <img src="<?= url('') ?>/assets/images/xls-yellow.svg" alt="" width="24px">
            </div>
        </div>
        <div class="br_6 bg_F1F2F2 cp_7">
            <div class="text_14_700 text_404248 mb_17">Esturado Test</div>
            <div class="row mb_14">
                <div class="col-md-5">
                    <div class="text_12_400 text_404248">Service:</div>
                </div>
                <div class="col-md-7">
                    <div class="text_12_400 text_404248">Service</div>
                </div>
            </div>
            <div class="row mb_14">
                <div class="col-md-5">
                    <div class="text_12_400 text_404248">Amount Quoted:</div>
                </div>
                <div class="col-md-7">
                    <div class="text_12_400 text_404248">Service</div>
                </div>
            </div>
            <div class="row mb_14">
                <div class="col-md-5">
                    <div class="text_12_400 text_404248">Follow-up:</div>
                </div>
                <div class="col-md-7">
                    <div class="text_12_400 text_404248">Service</div>
                </div>
            </div>
            <button class="btn text_14_400 text-white br_6 bg_126C9B cp_1">View/Change Status</button>
        </div>
    </div>
    <div class="leads_card">
        <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
            <div class="text_16_500 text-white">Consult Schedule</div>
            <div>
                <img src="<?= url('') ?>/assets/images/xls-yellow.svg" alt="" width="24px">
            </div>
        </div>
    </div>
    <div class="leads_card">
        <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
            <div class="text_16_500 text-white">No Show</div>
            <div>
                <img src="<?= url('') ?>/assets/images/xls-yellow.svg" alt="" width="24px">
            </div>
        </div>
    </div>
</div>

@include('admin.'.$controller.'.modals')

@include('admin.leads.lead-script')
@endsection('content')