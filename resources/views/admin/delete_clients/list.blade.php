
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Deleting a client will cause all the information for that particular client to be deleted, this includes, payment plans, invoices, receipts, etc. Once deteled a client cannot be restored.</div>

    <div class="d-flex mb_26">
        <input type="text" class="search_client form-control search_input text_16_500" placeholder="Search by name, email or phone no.">
        <button class="btn ml_13 search_client_btn text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Clients</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 delete_client">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
             
        </div>
    </div>

    @include('admin.delete_clients.delete-client-script')
@endsection('content')