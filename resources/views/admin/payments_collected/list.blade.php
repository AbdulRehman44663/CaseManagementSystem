

@extends('admin.layout.dashboard')
@section('content')
<style>
    .payments_collected .dt-type-date{
        text-align: left !important;
    }
</style>
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}  </div>
    <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex mb_24">
            <input type="text" class="form-control search_input payments_daterange text_16_500 dateRange" placeholder="">
            <button class="btn ml_13 text_14_400 text-white br_6 bg_126C9B search_input_date cp_3">Search</button>
        </div>
        <div class="mb_24">
            <button id = "download-pdf" class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3 d-flex align-items-center" style="display: none !important;">
                <img src="<?=url('')?>/assets/images/pdf-white.svg" alt="">
                <div class="ml_10">Export to PDF</div>
            </button>
        </div>
    </div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Payments Collected</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table payments_collected mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client Name</th>
                        <th>Attorney Amount</th>
                        <th>Filling Fee</th>
                        <th>Payed By</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- <tr>
                        <td>11-13-1998</td>
                        <td>Bryan Lawyer</td>
                        <td>$5,000.00</td>
                        <td>$0.00</td>
                        <td>Bryan Lawyer</td>
                    </tr>
                    <tr class="bg_FCAF3B">
                        <td>
                            <div class="text_16_700 text_404248">Totals</div>
                        </td>
                        <td></td>
                        <td>
                            <div class="text_16_700 text_404248">$51,732.00 </div>
                        </td>
                        <td>
                            <div class="text_16_700 text_404248">$2,002.20</div>
                        </td>
                        <td></td>
                    </tr> --}}
                </tbody>
            </table>

        </div>
    </div>

    @include('admin.'.$controller.'.modals')
    @include('admin.payments_collected.payments_collected_script')
@endsection('content')
