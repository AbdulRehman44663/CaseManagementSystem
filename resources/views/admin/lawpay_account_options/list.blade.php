
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}  (Work In-progress)</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Please select the bank account where funds will be deposited for payments made through LawPay. You will need to choose at least one account for each option.</div>
    <div class="br_6 bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Choose your account</div>
        <div class="row">
            <div class="col-xxl-6 col-xl-7 col-lg-9">
                <div class="text_16_400 text_404248 mb_12">Debit/Credit Card Processing - <i>Select where funds will be deposited</i></div>
                <input type="text" class="form-control myinput mb_16" placeholder="None">
                <div class="text_16_400 text_404248 mb_12">ACH/Checks Processing - <i>Select where funds will be deposited</i></div>
                <input type="text" class="form-control myinput mb_24" placeholder="None">
            </div>
        </div>
        <div class="text_14_400 text_404248 mb_24">You can also disconnect from LawPay if you do not wish to keep using this service. Keep in mind that you will not be able to use LawPay once disconnected, however, any scheduled payments will run as normal through LawPay's portal.
            <br><br> If you wish to reconnect to LawPay, simply click on Sign In to LawPay in the Administration area.
            <br><br> Click the button below to disconnect.</div>
        <div>
            <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Disconnect from LawPay Account</button>
        </div>
    </div>

    @include('admin.'.$controller.'.modals') 
@endsection('content')