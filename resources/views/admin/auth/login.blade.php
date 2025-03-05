
@extends('admin.auth.layouts.layout')
@section('content')
<div class="row w-100">
    <div class="col-md-6">
        <div class="bg_law">
            <div class="bg_law_overlay">
                <div class="login_main_container">
                    <div class="text_48_700 text-white cp_19 max_width_550">Comprehensive Case Management Software for Law Firms of All Sizes</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form action="{{ route('admin.login.custom') }}" method="post">
            @csrf
            <div class="login_main_container">
                <div class="br12 align_center w-fit-content login_content bg-F5F5F5 ">
                    <center class="mb_70">
                        <img src="{{url('assets/images/logo.webp')}}" alt="" class="login_logo mb_34">
                        <div class="text_24_700 text_404248 mb_15">Log in</div>
                        <div class="text_14_400 mb_51">Please enter your credentials to login</div>
                    </center>
                    <!-- Display Login Errors -->

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" id="error-alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div>
                        <div class="text_14_500 text_404248 mb_6">Email</div>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control myinput bg_F1F2F2 mb_36" required>
                    </div>
                    <div class="">
                        <div class="text_14_500 text_404248 mb_6">Password</div>
                        <input type="password" name="password" class="form-control myinput bg_F1F2F2 mb_36" required>
                    </div>
                    <div class="">
                        <button type="submit" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_1 mybtn text-white">Log in</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#error-alert").fadeOut("slow");
        }, 2000);  // 2 seconds
    });
</script>
@endsection('content')
