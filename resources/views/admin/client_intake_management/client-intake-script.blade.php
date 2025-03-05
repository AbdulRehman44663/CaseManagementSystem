@push('scripts')

<script>
$(document).ready(function() {
    $("#sortable-fields").sortable({
        update: function(event, ui) {
            // Get sorted IDs of the elements
            let sortedIDs = $(this).sortable("toArray");

            // Send sorted IDs to the server using AJAX
            $.ajax({
                url: '{{ route('admin.intakeFields.save.order') }}',
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
                        toastr.success('Order updated successfully!');
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
  $('#client-intake-fields').on('submit', function(e) {
    e.preventDefault();

    // Determine if we are updating or creating
    var caseTypeId = $('#caseTypeId').val();
    var caseFieldId = $('#fieldId').val();
    var url = caseFieldId ? '/admin/update-case-type-field/' + caseFieldId : '/admin/create-case-type-field/' + caseTypeId;
    var method = caseFieldId ? 'PUT' : 'POST';

    // Serialize form data and append CSRF token
    var formData = $(this).serialize();
    formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');

    // Clear previous error messages
    $('.text-danger').text('').hide();

    $.ajax({
        url: url,
        method: method,
        data: formData,
        success: function(data) {
            if (!data.success) {
                const errors = data.errors;
                for (const field in errors) {
                    if (field === 'possible_options') {
                        // Handle array errors specifically
                        const possibleOptionsError = errors[field][0];
                        $('#possible_options-error').text(possibleOptionsError).show();
                    } else {
                        $(`#${field}-error`).text(errors[field][0]).show(); // Show the first error for other fields
                    }
                }
            } else {
                console.log(data.message);
                $('#addaLegend').modal('hide');
                $('#client-intake-fields')[0].reset();
                window.location.reload();
            }
        },
        error: function(error) {
            const errors = error.responseJSON.errors; // Use responseJSON for failed requests
            for (const field in errors) {
                if (field === 'possible_options') {
                    // Handle array errors specifically
                    const possibleOptionsError = errors[field][0];
                    $('#possible_options-error').text(possibleOptionsError).show();
                } else {
                    $(`#${field}-error`).text(errors[field][0]).show(); // Show the first error for other fields
                }
            }
        }
    });
});



    $('#addaLegend').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var actionType = button.data('action-type');
    var caseId = button.data('case-id');
    var fieldId = button.data('field-id');

    // Set the hidden input values for caseId and fieldId
    $('#caseTypeId').val(caseId);
    $('#fieldId').val(fieldId);

    // Reset the modal for 'add' action
    if (actionType === 'add') {
        $('#label').val(''); // Clear input field for label
        $('#description').val(''); // Clear input field for description
        $('#field_type').val(''); // Clear field_type input
        $('#placeholder').val(''); // Clear placeholder input if any
        $("input[name='visible'][value='1']").prop('checked', true); // Default to visible
        $("input[name='required'][value='0']").prop('checked', true); // Default to not required
        $('#possible-options-container').empty(); // Clear any appended possible options
    } else if (actionType === 'edit') {
        $('#placeholder-container').show();
        // Fetch field data for 'edit' action
        $.ajax({
            url: '/admin/fetchFieldData/' + caseId + '/' + fieldId,
            method: 'GET',
            success: function(response) {
                // Populate fields with fetched data
                $('#label').val(response.label);
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
            },
            error: function(xhr) {
                console.error("Error fetching field data");
            }
        });
    }
});




// Handle deleting options
$('#possible-options-container').on('click', '.delete-option', function() {
    $(this).closest('.input-group').remove();
});



    $(document).on('click', '.delete-btn', function() {
        const fieldId = $(this).closest('.field').data('id');
        const fieldElement = $(this).closest('.field');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this field?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Make the AJAX request
                $.ajax({
                    url: '{{ route('admin.deleteClientIntakeFields') }}',
                    method: 'DELETE',
                    data: {
                        id: fieldId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        window.location.reload();
                        toastr.success(data.message);
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.responseJSON) {
                            console.log(error.responseJSON);
                            const errors = error.responseJSON.errors; // Get validation errors
                            for (const field in errors) {
                                $(`#${field}-error`).text(errors[field][0]); // Display first error for each field
                                $(`#${field}-error`).show(); // Make the error message visible
                            }
                        }
                    }

                });
            }
        });

    });

    // jQuery to handle the change event of the field_type dropdown
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

        var errorField = $('<span class="text-danger" id="possible_options-error"></span>');

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

</script>
@endpush