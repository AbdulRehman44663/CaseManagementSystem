

@extends('admin.layout.dashboard')
@section('content')
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}  </div>
        <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Manage all your users with this simple and easy to use tool.</div>
        <div class="text_14_600 ff_dm_sans text_404248 mb_24">Read More</div>
        <div class="d-flex flex-wrap justify-content-end">
            <button class="btn text_14_500 text-white br_6 bg_126C9B cp_13 mb_26 mr_12" id="create-user-btn"  role="button">+ Add New User</button>
        </div>
        <div class="my_table_div ">
            <div class="cp_2">
                <div class="text_20_700 ff_dm_sans text_404248">Users</div>
            </div>
            <div class="table-responsive">
                <table class="table my_table mb-0 user_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Hourly Rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    @include('admin.'.$controller.'.modals')
    @include('admin.user_management.user-management-script')
@endsection('content')
