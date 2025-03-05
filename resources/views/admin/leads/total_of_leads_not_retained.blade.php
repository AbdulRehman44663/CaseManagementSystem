@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}  (Work In-progress)</div>
    <div class="d-flex mb_24">
        <input type="text" class="form-control search_input text_16_500 dateRange" placeholder="">
        <button class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
    </div>
    <div class="my_table_div">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Total of Leads Not Retained</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dennis Peter</td>
                        <td>123 Test St, Anywhere CA 90270 </td>
                        <td>323 3456 432</td>
                        <td>Not Retained</td>
                        <td>$5,000.00</td>
                    </tr>
                    <tr>
                        <td>Dennis Peter</td>
                        <td>123 Test St, Anywhere CA 90270 </td>
                        <td>323 3456 432</td>
                        <td>Not Retained</td>
                        <td>$5,000.00</td>
                    </tr>
                    <tr>
                        <td>Dennis Peter</td>
                        <td>123 Test St, Anywhere CA 90270 </td>
                        <td>323 3456 432</td>
                        <td>Not Retained</td>
                        <td>$5,000.00</td>
                    </tr>
                    <tr>
                        <td>Dennis Peter</td>
                        <td>123 Test St, Anywhere CA 90270 </td>
                        <td>323 3456 432</td>
                        <td>Not Retained</td>
                        <td>$5,000.00</td>
                    </tr>
                    <tr>
                        <td>Dennis Peter</td>
                        <td>123 Test St, Anywhere CA 90270 </td>
                        <td>323 3456 432</td>
                        <td>Not Retained</td>
                        <td>$5,000.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between cp_1">
                <div class="text_14_500 ff_dm_sans text_404248">Showing 1 to 10 of 50 results</div>
                <div class="d-flex align-items-center">
                    <div>
                        <select name="" id="" class="select_list">
                    <option value="">5</option>
                </select>
                    </div>
                    <div class="text_14_500 ff_dm_sans text_404248 ml_8">per page</div>
                </div>
                <div></div>
            </div>
        </div>
    </div>
    
@include('admin.'.$controller.'.modals') 
@endsection('content')