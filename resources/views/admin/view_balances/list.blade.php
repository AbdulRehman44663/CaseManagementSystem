

@extends('admin.layout.dashboard')
@section('content')
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Client balances for which you have marked as Uncollectible are not reflected in this list.</div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="d-flex align-items-center justify-content-between">

                <div class="text_20_700 ff_dm_sans text_404248">Client Balances</div>

                <button id = "download-pdf" class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3 d-flex align-items-center" style="display: none !important;">
                    <img src="<?=url('')?>/assets/images/pdf-white.svg" alt="">
                    <div class="ml_10">Export to PDF</div>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table my_table view_balances mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type of Services</th>
                        <th>Attorney Balance</th>
                        <th>Filling Fee</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- <tr class="bg_FCAF3B">
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
                    </tr> --}}
                </tbody>
            </table>

        </div>
    </div>

    @include('admin.'.$controller.'.modals')
    @include('admin.view_balances.view_balances_script')
@endsection('content')
