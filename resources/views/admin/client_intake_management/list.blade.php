@extends('admin.layout.dashboard')
@section('content')
<div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
<div class="text_16_700 ff_dm_sans text_404248 mb_24">Select Case Type</div>
<div class="row">
    @foreach($case_types as $case)
    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
        <a href="{{ route('admin.clientIntakeFields', ['case_id' => $case->id]) }}">
            <div class="bg_F1F2F2 cp_7 br_6 mb_24">
                <div class="text_16_500 text_6A6A6A">{{ $case->name }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@include('admin.'.$controller.'.modals')
@endsection('content')