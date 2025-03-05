
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
        <form action="{{ route('admin.set.password') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
            <div class="login_main_container">
                <div class="br12 align_center w-fit-content login_content bg-F5F5F5 ">
                    <center class="mb_70">
                        <img src="{{url('assets/images/logo.webp')}}" alt="" class="login_logo mb_34">
                        <div class="text_24_700 text_404248 mb_15">Set Your Password</div>
                        <div class="text_14_400 mb_51">Please enter your password</div>
                    </center>
                    <div>
                        <div class="text_14_500 text_404248 mb_6">Email</div>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control myinput bg_F1F2F2 mb_36" disabled>
                    </div>
                    <div class="mb_36">
                        <div class="text_14_500 text_404248 mb_6">Password <span class="text_B4173A">*</span></div>
                        <input type="password" name="password" class="form-control myinput bg_F1F2F2" required>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <div class="text_14_500 text_404248 mb_6">Confirm Password <span class="text_B4173A">*</span></div>
                        <input type="password" name="password_confirmation" class="form-control myinput bg_F1F2F2 mb_36" required>
                    </div>
                    <div class="">
                        <button type="submit" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_1 mybtn text-white">Set Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection('content')