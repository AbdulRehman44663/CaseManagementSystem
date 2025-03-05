
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>

    <div class="text_14_400 ff_dm_sans text_6A6A6A mb_24">Manage all your court locations with this simple and easy to use tool.</div>
    <div class="text_14_600 ff_dm_sans text_404248 mb_24">Read More</div>

    <!---- bk section--->

    <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative">
        <label class="checkbox_container text_20_700 ff_dm_sans text_126C9B mb_5">Bankruptcy
            <input type="checkbox" id="bankruptcy_checkbox" data-case_type = "bk" @if($selected_cases->contains('case_selection_name', 'bk')) checked @endif>
            <span class="checkmark" style="margin-top: 4px;"></span>
        </label>
    
        <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative" id="bk_section" style="padding-top: 0px !important; padding-left:10px !important;">
            @foreach ($court_states as $court_state)
                @php
                    // Check if the state is selected
                    $selectedState = $selected_court_states->firstWhere('bk_court_state_id', $court_state->id);
                    $isStateSelected = !is_null($selectedState);
                @endphp
                <div class="cp_10">
                    <label class="checkbox_container text_16_400 text_6A6A6A mb_5">
                        {{ $court_state->bk_state_name }}
                        <input type="checkbox" class="bk_checkbox bk_state_checkbox" data-state_id="{{ $court_state->id }}" {{ $isStateSelected ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    
                    @foreach ($court_state->courtDistricts as $court_district)
                        @php
                            // Check if the district is selected within the selected state
                            $isDistrictSelected = $selectedState 
                                ? $selectedState->selectedCourtDistricts->contains('bk_court_district_id', $court_district->id) 
                                : false;
                        @endphp
                        <div class="cp_17 bk_district_section">
                            <label class="checkbox_container text_16_400 text_6A6A6A mb_5">
                                {{ $court_district->bk_district_name }}
                                <input type="checkbox" data-state_id="{{ $court_state->id }}" data-district_id="{{ $court_district->id }}" class="bk_checkbox bk_state_district_checkbox" {{ $isDistrictSelected ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <!--- Immigration ---->

    <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative">
        <label class="checkbox_container text_20_700 ff_dm_sans text_126C9B mb_5">Immigration
            <input type="checkbox" id="immigration_checkbox" data-case_type = "immigration" @if($selected_cases->contains('case_selection_name', 'immigration')) checked @endif>
            <span class="checkmark" style="margin-top: 4px;"></span>
        </label>
    
        <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative" id="immigration_section" style="padding-top: 0px !important; padding-left:10px !important;">
            @foreach ($immigration_court_states as $immigration_court_state)
                @php
                    // Check if the state is selected
                    $selectedState = $immigration_selected_court_states->firstWhere('immigration_court_state_id', $immigration_court_state->id);
                    $isStateSelected = !is_null($selectedState);
                @endphp
                <div class="cp_10">
                    <label class="checkbox_container text_16_400 text_6A6A6A mb_5">
                        {{ $immigration_court_state->immigration_state_name }}
                        <input type="checkbox" class="immigration_checkbox immigration_state_checkbox" data-state_id="{{ $immigration_court_state->id }}" {{ $isStateSelected ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- other case types section --->

    <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative">
        <label class="checkbox_container text_20_700 ff_dm_sans text_126C9B mb_5"> Civil, Criminal, Traffic, Probate, Family, Juvenile, Small Claims
            <input type="checkbox" id="general_checkbox" data-case_type = "general" @if($selected_cases->contains('case_selection_name', 'general')) checked @endif>
            <span class="checkmark" style="margin-top: 4px;"></span>
        </label>
    
        <div class="bg_F1F2F2 br_8 cp_6 mb_24 position_relative" id="general_section" style="padding-top: 0px !important; padding-left:10px !important;">
            @foreach ($general_court_states as $court_state)
                @php
                    // Check if the state is selected
                    $selectedState = $general_selected_states->firstWhere('genaral_court_state_id', $court_state->id);
                    $isStateSelected = !is_null($selectedState);
                @endphp
                <div class="cp_10">
                    <label class="checkbox_container text_16_400 text_6A6A6A mb_5">
                        {{ $court_state->gen_state_name }}
                        <input type="checkbox" class="general_checkbox general_state_checkbox" data-state_id="{{ $court_state->id }}" {{ $isStateSelected ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    
                    @foreach ($court_state->generalCourtCountry as $court_country_other)
                        @php
                            // Check if the district is selected within the selected state
                            $isCountrySelected = $selectedState 
                                ? $selectedState->selectedCourtCountry->contains('genaral_court_country_other_id', $court_country_other->id) 
                                : false;
                        @endphp
                        <div class="cp_17 general_country_section">
                            <label class="checkbox_container text_16_400 text_6A6A6A mb_5">
                                {{ $court_country_other->general_country_name }}
                                <input type="checkbox" data-state_id="{{ $court_state->id }}" data-country_id="{{ $court_country_other->id }}" class="general_checkbox general_state_country_checkbox" {{ $isCountrySelected ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <!---- others case types end ---->
     
    

     
    
    @include('admin.'.$controller.'.modals')
    @include('admin.court_selector_management.court-selector-management-script') 
@endsection('content')