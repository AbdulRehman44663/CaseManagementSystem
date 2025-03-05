

@extends('admin.layout.dashboard')
@section('content')
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_12">Welcome {{auth()->user()->name}}</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">This Client Management System will allow you to add, edit, delete clients and add/edit/delete important case information. The system comes with an event calendar to help you keep track of important court dates. Should you have any questions
        or concerns in regards to this system, please contact the website administrator. <a href="https://www.CaseManagementSystem.com/contact-us/" target="_blank" class="text_14_600 text_126C9B">Please click here.</a></div>

    <div class="row mb_10">
        <div class="col-xxl-2 col-xl-3 col-lg-6 mb_16">
            <a href="{{route('admin.addLead')}}">
                <div class="br_6 bg_F1F2F2 my_card">
                    <img src="<?=url('')?>/assets/images/lead.svg" alt="" class="mb_12">
                    <div class="ff_dm_sans text_16_500 text_6A6A6A">New Lead/ Client</div>
                </div>
            </a>
        </div>
        <div class="col-xxl-2 col-xl-3 col-lg-6 mb_16">
            <a href="{{route('admin.clientsList')}}">
                <div class="br_6 bg_F1F2F2 my_card">
                    <img src="<?=url('')?>/assets/images/client.svg" alt="" class="mb_12">
                    <div class="ff_dm_sans text_16_500 text_6A6A6A">Client List</div>
                </div>
            </a>
        </div>
       
    </div>
    <div class="my_table_div">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Tasks</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 dashboard_tasks">
                <thead>
                    <tr>
                        <th>Created By</th>
                        <th>Assigned to</th>
                        <th>Client Name</th>
                        <th>Date/Time</th>
                        <th>Details</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>

    @include('admin.dashboard.dashboard-script')
@endsection('content')
