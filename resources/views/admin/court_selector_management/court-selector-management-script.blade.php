@push('scripts')
<script> 
    $(document).ready(function () {
        
        if ($('#bankruptcy_checkbox').is(':checked')) {
            $('#bk_section').slideDown();
        }
        else
        {
            $('#bk_section').slideUp();
        }

        $(".bk_state_checkbox").each(function () {
            let stateCheckbox = $(this);
            let stateId = stateCheckbox.data("state_id");

            // Initially show/hide based on checkbox state
            if (stateCheckbox.is(":checked")) {
                $(".bk_district_section input[data-state_id='" + stateId + "']").closest(".bk_district_section").slideDown();
            } else {
                $(".bk_district_section input[data-state_id='" + stateId + "']").closest(".bk_district_section").slideUp();
            }
        });
        ////// 

        $('#bankruptcy_checkbox').on('change', function () {
            let caseType = $(this).data('case_type');  
            let isChecked = $(this).is(':checked') ? 1 : 0;  
            
            $.ajax({
                url: "{{ route('admin.update.selected.casetype') }}",  
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF Token for security
                    case_type: caseType,
                    checked: isChecked
                },
                success: function (response) {
                    if (response.success) {
                        console.log("Case type updated successfully");
                    } else {
                        console.log("Failed to update case type");
                    }
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });
        /////
        // Handle Bankruptcy Checkbox
        $('#bankruptcy_checkbox').change(function () {
            if ($(this).is(':checked')) {
                $('#bk_section').slideDown();
            } else {
                $('#bk_section').slideUp();
                //$('.bk_state_checkbox, .bk_state_district_checkbox').prop('checked', false); // Uncheck all checkboxes
            }
        });

        // Handle BK State Checkboxes
        $('.bk_state_checkbox').change(function () {
            let stateContainer = $(this).closest('.cp_10');  
            if ($(this).is(':checked')) {
                stateContainer.find('.bk_district_section').slideDown();  
            } else {
                stateContainer.find('.bk_district_section').slideUp();  
                stateContainer.find('.bk_state_district_checkbox').prop('checked', false);  
            }
        });



        // Handle State Checkbox Click
        $('.bk_state_checkbox').change(function () {
            let stateId = $(this).attr('data-state_id');
            let isChecked = $(this).is(':checked');
            sendAjaxRequest("state", stateId, null, isChecked);
        });

        // Handle District Checkbox Click
        $('.bk_state_district_checkbox').change(function () {
            let stateId = $(this).attr('data-state_id');
            let districtId = $(this).attr('data-district_id');
            let isChecked = $(this).is(':checked');
            sendAjaxRequest("district", stateId, districtId, isChecked);
        }); 

        function sendAjaxRequest(type, stateId, districtId, isChecked) {
            console.log(districtId);
            $.ajax({
                url: "{{ route('admin.bk.court.selection') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,  
                    state_id: stateId,
                    district_id: districtId,
                    checked: isChecked ? 1 : 0
                },
                success: function (response) {
                    console.log("Saved successfully:", response);
                },
                error: function (xhr, status, error) {
                    console.error("Error saving:", error);
                }
            });
        }


        //// immigration module

        if ($('#immigration_checkbox').is(':checked')) {
            $('#immigration_section').slideDown();
        }
        else
        {
            $('#immigration_section').slideUp();
        }
        //////
        $('#immigration_checkbox').on('change', function () {
            let caseType = $(this).data('case_type');  
            let isChecked = $(this).is(':checked') ? 1 : 0;  
            
            $.ajax({
                url: "{{ route('admin.update.selected.casetype') }}",  
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    case_type: caseType,
                    checked: isChecked
                },
                success: function (response) {
                    if (response.success) {
                        console.log("Case type updated successfully");
                    } else {
                        console.log("Failed to update case type");
                    }
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });
        //////

        // Handle Bankruptcy Checkbox
        $('#immigration_checkbox').change(function () {
            if ($(this).is(':checked')) {
                $('#immigration_section').slideDown();
            } else {
                $('#immigration_section').slideUp();
            }
        });

        /////
        $('.immigration_state_checkbox').change(function () {
            let stateId = $(this).attr('data-state_id');
            let isChecked = $(this).is(':checked');
            sendImmigrationAjaxRequest(stateId, isChecked);
        });

        function sendImmigrationAjaxRequest(stateId, isChecked) {
            $.ajax({
                url: "{{ route('admin.immigration.court.selection') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    state_id: stateId,
                    checked: isChecked ? 1 : 0
                },
                success: function (response) {
                    console.log("Saved successfully:", response);
                },
                error: function (xhr, status, error) {
                    console.error("Error saving:", error);
                }
            });
        }


        /// general section ////
        if ($('#general_checkbox').is(':checked')) 
        {
            $('#general_section').slideDown();
        }
        else
        {
            $('#general_section').slideUp();
        }
         /// 
        $(".general_state_checkbox").each(function () {
            let stateCheckbox = $(this);
            let stateId = stateCheckbox.data("state_id");

            // Initially show/hide based on checkbox state
            if (stateCheckbox.is(":checked")) {
                
                $(".general_country_section input[data-state_id='" + stateId + "']").closest(".general_country_section").slideDown();
            } else {
                
                $(".general_country_section input[data-state_id='" + stateId + "']").closest(".general_country_section").slideUp();
            }
        });

        $('#general_checkbox').on('change', function () {
            let caseType = $(this).data('case_type');  
            let isChecked = $(this).is(':checked') ? 1 : 0;  
            
            $.ajax({
                url: "{{ route('admin.update.selected.casetype') }}",  
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF Token for security
                    case_type: caseType,
                    checked: isChecked
                },
                success: function (response) {
                    if (response.success) {
                        console.log("Case type updated successfully");
                    } else {
                        console.log("Failed to update case type");
                    }
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });

        // Handle Bankruptcy Checkbox
        $('#general_checkbox').change(function () {
            if ($(this).is(':checked')) {
                $('#general_section').slideDown();
            } else {
                $('#general_section').slideUp();
            }
        });

        // Handle BK State Checkboxes
        $('.general_state_checkbox').change(function () {
            let stateContainer = $(this).closest('.cp_10');  
            if ($(this).is(':checked')) {
                stateContainer.find('.general_country_section').slideDown();  
            } else {
                stateContainer.find('.general_country_section').slideUp();  
                stateContainer.find('.general_state_country_checkbox').prop('checked', false);  
            }
        });



        // Handle State Checkbox Click
        $('.general_state_checkbox').change(function () {
           
            let stateId = $(this).attr('data-state_id');
            let isChecked = $(this).is(':checked');
            sendGeneralAjaxRequest("state", stateId, null, isChecked);
        });

        // Handle District Checkbox Click
        $('.general_state_country_checkbox').change(function () {
            let stateId = $(this).attr('data-state_id');
            let countryId = $(this).attr('data-country_id');
            let isChecked = $(this).is(':checked');
            sendGeneralAjaxRequest("country", stateId, countryId, isChecked);
        }); 

        function sendGeneralAjaxRequest(type, stateId, countryId, isChecked) {
            $.ajax({
                url: "{{ route('admin.general.court.selection') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,  
                    state_id: stateId,
                    country_id: countryId,
                    checked: isChecked ? 1 : 0
                },
                success: function (response) {
                    console.log("Saved successfully:", response);
                },
                error: function (xhr, status, error) {
                    console.error("Error saving:", error);
                }
            });
        }



         
    });

    
</script>
    
@endpush