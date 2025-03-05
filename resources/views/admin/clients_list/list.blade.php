
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

    <form id="client-filter">

        <div class="row mb_14">
            <div class="col-xxl-3 col-xl-6 mb_12">
                <div class="text_16_700 text_404248 mb_6">Status:</div>
                <select name ="client_status" class="form-control select_list2 text_16_500">
                    <option value="">All</option>
                    @foreach ($client_statuss as $client_status)
                        <option value="{{$client_status->id}}"> {{$client_status->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xxl-3 col-xl-6 mb_12">
                <div class="text_16_700 text_404248 mb_6">Case Analyst</div>
                <select name="case_analyst" class="form-control select_list2 text_16_500">
                    <option value="">All</option>
                    @foreach ($case_analysts as $case_analyst)
                    <option value="{{$case_analyst->id}}"> {{$case_analyst->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-xxl-3 col-xl-6 mb_12">
                <div class="text_16_700 text_404248 mb_6">Service:</div>
                <select name="case_service" class="form-control select_list2 text_16_500">
                    <option value="">All</option>
                    @foreach ($case_services as $case_service)
                    <option value="{{$case_service->id}}"> {{$case_service->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-xxl-3 col-xl-6 display_table mb_12">
                <div class="vertical_end">
                    <button type="submit" class="btn text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
                </div>
            </div>
        </div>
    </form>

    <form method="GET" action="{{ route('admin.clientsList') }}">
        <div class="d-flex mb_26">
            <input type="text" name="case_number" {{ request('case_number') }} class="form-control search_input text_16_500" placeholder="Search Case Number">
            <button class="btn ml_13 text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
        </div>
    </form>

    <div id="client_list">
         @include('admin.clients_list.client_list')
    </div>
    
    
    {{-- @include('admin.'.$controller.'.modals') --}}
    @include('admin.clients_list.client_script') 
@endsection('content')