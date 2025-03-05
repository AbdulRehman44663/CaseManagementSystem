
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="text_16_700 ff_dm_sans text_404248 mb_24">Select Case Type</div>
    <div class="row">
        @if(isset($case_types) && count($case_types)>0)
            @foreach($case_types as $single)
                <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
                    <a href="{{route('admin.emailTemplate', $single->id)}}">
                        <div class="bg_F1F2F2 cp_7 br_6 mb_24">
                            <div class="text_16_500 text_6A6A6A">{{$single->name}}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    
    @include('admin.'.$controller.'.modals') 
@endsection('content')