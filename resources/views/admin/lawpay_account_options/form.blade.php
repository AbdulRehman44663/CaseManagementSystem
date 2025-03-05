
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Please fill out all the required fields. Once you submit this information you will be redirected to LawPay's website where you will complete the application. Please keep in mind that it may take around 48 hours for you to be approved for
        using LawPay.
        <br><br> Once you have been approved please use the log in button in the administration panel to connect your system with LawPay.</div>
    <div class="br_6 bg_F1F2F2 cp_6 mb_24">
        <div class="text_16_700 text_404248 mb_24">Tell us about your business</div>
        <div class="row">
            <div class="col-xxl-6 col-xl-7 col-lg-9">
                <div class="text_16_400 text_404248 mb_10">Name</div>
                <input type="text" class="form-control myinput mb_16" placeholder="">
                <div class="text_16_400 text_404248 mb_10">Last Name</div>
                <input type="text" class="form-control myinput mb_16" placeholder="">
                <div class="text_16_400 text_404248 mb_10">Email</div>
                <input type="text" class="form-control myinput mb_16" placeholder="">
                <div class="text_16_400 text_404248 mb_10">Legal business name</div>
                <input type="text" class="form-control myinput mb_10" placeholder="">
                <div class="text_16_400 text_6a6a6a66 mb_16">As it appears on your tax return</div>

                <div class="text_16_400 text_404248 mb_10">Business Address</div>
                <input type="text" class="form-control myinput mb_16" placeholder="">

                <div class="row">
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">City</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">State</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">Zip code</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">Phone</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                </div>



                <div class="text_16_400 text_404248 mb_10">Federal Tax ID</div>
                <input type="text" class="form-control myinput mb_10" placeholder="">
                <div class="text_16_400 text_6a6a6a66 mb_16">As it appears on your tax return</div>

                <div class="row mb_8">
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">Business Structure</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <div class="text_16_400 text_404248 mb_10">Years in business</div>
                        <input type="text" class="form-control myinput mb_16" placeholder="">
                    </div>
                </div>

            </div>
        </div>
        <div>
            <button class="text_14_500 ff_dm_sans bg_126C9B br_6 cp_13 mybtn text-white mr_16">Submit</button>
        </div>
    </div>

    @include('admin.'.$controller.'.modals') 
@endsection('content')