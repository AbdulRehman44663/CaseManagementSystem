@push('scripts')
<script>
    /// custom group script ///
    

    $(document).ready(function() {
        $("#sortable-fields").sortable({
            update: function(event, ui) {
                // Get sorted IDs of the elements
                let sortedIDs = $(this).sortable("toArray");

                // Send sorted IDs to the server using AJAX
                $.ajax({
                    url: '{{ route('admin.custom.group.save.order') }}',
                    method: 'POST',
                    data: {
                        sortedIDs: sortedIDs,
                        _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update order numbers dynamically on the page
                            sortedIDs.forEach((id, index) => {
                                $(`.order_field_${id}`).text(index + 1);
                            });
                            toastr.success('Order number updated successfully!');
                        } else {
                            toastr.success('Failed to update order. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving order:', error);
                    }
                });
            }
        });

        ////

        $("#sortable-fields-detail").sortable({
            update: function(event, ui) {
                // Get sorted IDs of the elements
                let sortedDetailFieldIDs = $(this).sortable("toArray");

                // Send sorted IDs to the server using AJAX
                $.ajax({
                    url: '{{ route('admin.custom.group.detail.save.order') }}',
                    method: 'POST',
                    data: {
                        sortedIDs: sortedDetailFieldIDs,
                        _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update order numbers dynamically on the page
                            sortedDetailFieldIDs.forEach((id, index) => {
                                $(`.order_field_${id}`).text(index + 1);
                            });
                            toastr.success('Order number updated successfully!');
                        } else {
                            toastr.success('Failed to update order. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving order:', error);
                    }
                });
            }
        });
    });

    
    /// show a modal for creation
    $('#create-custom-group-btn').on('click', function() {
        clearValidationError();
        $('#addaGroup').modal('show'); 
        $('#custom-group-form')[0].reset();
        $('#group_id').val('');
        $('.main-title').text('Add Custom Field Group');
        $('.submit-btn').text('Submit');
    });

    /// create/update a casetype group from based on attorneyId
   
    $('#custom-group-form').on('submit', function(e) {
        e.preventDefault();
        
        var groupId = $('#group_id').val(); // Check if we are updating or creating
        var url = groupId ? '/admin/update-custom-group/' + groupId : '{{ route("admin.create.customgroup") }}';  // Create URL

        var method = groupId ? 'PUT' : 'POST';
        
        var formData = $(this).serialize(); 
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors);
                } else {
                    $('#addaGroup').modal('hide');
                    $('#custom-group-form')[0].reset();
                    setSessionMessage("custom_group_success", groupId ? "Group updated successfully!" : "Group created successfully!");
                    window.location.reload();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    
    // edit 
    function editCustomGroup(groupId)
    {
        $.ajax({
            url: '/admin/edit-custom-group/' + groupId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#label').val(response.data.label);
                $('#group_id').val(response.data.id);
                $('.main-title').text('Edit Custom Field Group');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addaGroup').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteCustomGroup(groupId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this group?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-custom-group/' + groupId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            setSessionMessage("custom_group_success", "Group deleted successfully!");
                            window.location.reload();
                             
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        //errorMessage.text('An error occurred. Please try again.');
                    }
                });
            }
        });
    }


    /// session storage with toaster message ////

    function setSessionMessage(key, message) {
        sessionStorage.setItem(key, message);
    }

    // Function to show messages after reload
    function showSessionMessages() {
        setTimeout(() => {  
            const sessionKeys = ["custom_group_success"];  

            sessionKeys.forEach((key) => {
                let message = sessionStorage.getItem(key);
                if (message) {
                    toastr.success(message, '', { timeOut: 1500 }); 
                    sessionStorage.removeItem(key); 
                }
            });
        }, 100);  
    }

    // Run function on page load
    document.addEventListener("DOMContentLoaded", function() {
        showSessionMessages();
    });

    /// end custom group fields script ///

    ////start custom group details fields script

    

    /// show a modal for creation
    $('#create-custom-group-fileds-btn').on('click', function() {
        clearValidationError();
        $('#addaGroupFields').modal('show'); 
        $('#custom-group-fields-form')[0].reset();
        $('#group_field_id').val('');
        $('.main-title').text('Add Custom Field');
        $('.submit-btn').text('Submit');
    });

    /// create/update a group fields from based on attorneyId

    $('#custom-group-fields-form').on('submit', function(e) {
        e.preventDefault();

        // Determine if we are updating or creating
        var groupFieldId = $('#group_field_id').val();

        var url = groupFieldId ? '/admin/update-custom-group-detail/' + groupFieldId :  '{{ route("admin.create.customGroupDetail") }}';
        var method = groupFieldId ? 'PUT' : 'POST';

        // Serialize form data and append CSRF token
        var formData = $(this).serialize();
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    
                    displayErrors(data.errors);
                } else {
                    $('#addaGroupFields').modal('hide');
                    $('#custom-group-form')[0].reset();
                    setSessionMessage("custom_group_success", groupFieldId ? "Group field updated successfully!" : "Group field created successfully!");
                    window.location.reload();
                }
            },
            error: function(error) {
                console.log("227");
                return false;
                console.log(error);
            }
             
        });
    });
   
     

    $('#field_type').change(function() {
        var fieldType = $(this).val();
        
        if (fieldType === 'DROP-DOWN-LIST' || fieldType === 'RADIO-BUTTON') {
            $('#possible-option-container').show();
            $('#possible-options-container').show();
            $('#add-options-text').show();
        } else {
            $('#possible-option-container').hide();
            $('#possible-options-container').hide();
            $('#add-options-text').hide();
        }
    });

    $('#add-options-text').click(function(e) {
        e.preventDefault();  // Prevent default link behavior

        // Create a container div for the new option field and delete button
        var newOptionField = $('<div class="d-flex align-items-center mb-2"></div>');

        // Create the input field for possible options
        var inputField = $('<input>', {
            type: 'text',
            name: 'possible_options[]',
            class: 'form-control myinput bg_F1F2F2 mr-2',
            placeholder: 'Enter possible option'
        });

        var errorField = $('<span class="text-danger" id="error_possible_options"></span>');

        // Create the delete button for the new input field
        var deleteButton = $('<button>', {
            type: 'button',
            text: 'Delete',
            class: 'btn btn-danger btn-sm delete-option',
        });

        // Append the input field and delete button to the container
        newOptionField.append(inputField);
        newOptionField.append(errorField);

        newOptionField.append(deleteButton);
        
        console.log(newOptionField);
        // Append the container to the parent container
        $('#possible-options-container').append(newOptionField);
    });

    // Event delegation to handle dynamically added delete buttons
    $(document).on('click', '.delete-option', function() {
        // Remove the entire container (input field + delete button) when the delete button is clicked
        $(this).parent().remove();
    });


    // Event delegation to handle dynamically added delete buttons
    $(document).on('click', '.delete-option', function() {
        // Remove the entire container (input field + delete button) when the delete button is clicked
        $(this).parent().remove();
    });
    

    // edit 
    function editCustomGroupDetail(groupDetailId)
    {
        $.ajax({
            url: '/admin/edit-custom-group-detail/' + groupDetailId,
            method: 'GET',
            
            success: function(response) {
                
                clearValidationError();

                $('#detail_label').val(response.label);
                $('#description').val(response.description);
                $('#field_type').val(response.field_type);
                $('#placeholder').val(response.placeholder);

                // Check and set the visibility and required values
                if (response.visible == 1) {
                    $("input[name='visible'][value='1']").prop('checked', true);
                    $("input[name='visible'][value='0']").prop('checked', false);
                } else {
                    $("input[name='visible'][value='0']").prop('checked', true);
                    $("input[name='visible'][value='1']").prop('checked', false);
                }

                if (response.required == 1) {
                    $("input[name='required'][value='1']").prop('checked', true);
                    $("input[name='required'][value='0']").prop('checked', false);
                } else {
                    $("input[name='required'][value='0']").prop('checked', true);
                    $("input[name='required'][value='1']").prop('checked', false);
                }
                // Populate dynamic options for 'DROP-DOWN-LIST'
                if ((response.field_type === 'DROP-DOWN-LIST' || response.field_type === 'RADIO-BUTTON') && Array.isArray(response.possible_options)) {
                    $('#possible-options-container').empty(); // Clear any existing options
                    $('#possible-option-container').show();
                    response.possible_options.forEach(function(option) {
                        var optionField = '<div class="input-group mb-2">' +
                                              '<input type="text" name="possible_options[]" class="form-control" value="' + option + '">' +
                                              '<button type="button" class="btn btn-danger delete-option">Delete</button>' +
                                          '</div>';
                        $('#possible-options-container').append(optionField); // Append options
                        $('#possible-options-container').show(); // Append options
                        $('#possible-options-container').show();
                        $('#add-options-text').show();
                    });
                }
                $('#group_field_id').val(response.id);
                $('.main-title').text('Edit Custom Field');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addaGroupFields').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }
    
    //delete 
    function deleteCustomGroupDetail(groupDetailId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this group?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-custom-group-detail/' + groupDetailId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            setSessionMessage("custom_group_success", "Group field deleted successfully!");
                            window.location.reload();
                             
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        //errorMessage.text('An error occurred. Please try again.');
                    }
                });
            }
        });
    }
     
    
 
</script>
    
@endpush