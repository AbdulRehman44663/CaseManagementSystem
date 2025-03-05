@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.user_table').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            ajax: {
                url: '{{ route('admin.getUser') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                { data: 'email' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.lawyer_user_type ? row.lawyer_user_type.name : 'N/A';
                    }
                },
                
                {data: 'hourly_rate'},
                {
                    data: 'status',
                    render: function(data, type, row) {
                        let color = ""; 
                        let displayText = data; // Default text
                        let isClickable = false; // Determine if status is clickable

                        if (data === "user_not_confirmed_yet") {
                            color = "#0291d4"; 
                            displayText = "User Not Confirmed Yet"; 
                        } else if (data === "active") {
                            color = "green"; 
                            displayText = "Active";

                            if(row.is_administrator == "yes")
                            {
                                isClickable = false; 
                            }
                            else
                            {
                                isClickable = true;
                            } 
                        } else if (data === "inactive") {
                            color = "red"; 
                            displayText = "Inactive"; 
                            isClickable = true; 
                        }

                        if (isClickable) {
                            return `<span class="status-toggle" style="color: ${color}; font-weight: 500; cursor: pointer;" onclick="toggleUserStatus(${row.id})">${displayText}</span>`;
                        } else {
                            return `<span style="color: ${color}; font-weight: 500;">${displayText}</span>`;
                        }
                    }
                },


                {
                    data: null,
                     
                    render: function(data, type, row) {
                        let deleteAction = '';
                        let accessAction = '';
                        let resetPassword = '';

                        if (row.is_administrator !== "yes") {
                            deleteAction = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteUser(${row.id})">
                                                <img src="<?=url('')?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete
                                            </a>`;
                        }
                        if (row.is_administrator !== "yes") {
                            accessAction = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editUserAccess(${row.id}, '${row.email}')">
                                            <img src="<?=url('')?>/assets/images/edit-access.svg" alt="" width="10px"> Edit Accesses</a>`;
                        }
                        if(row.status != "user_not_confirmed_yet")
                        {
                            resetPassword = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="userResetPassword(${row.id})">
                                <img src="<?=url('')?>/assets/images/reset-password.svg" alt="" width="10px">Reset Email/Password</a>`;
                        }

                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editUser(${row.id})">
                                        <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit User Information</a>

                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editUserEvents(${row.id}, '${row.email}')">
                                        <img src="<?=url('')?>/assets/images/edit-events.svg" alt="" width="10px">Edit Events</a>
                                        ${accessAction}
                                        
                                        ${deleteAction}
                                        ${resetPassword}
                                        
                                    </li>
                                </ul>
                            </div>`;
                    }
                }
                 
            ],
        });

        // Custom page length
        $('.select_list').on('change', function() {
            console.log($(this).val())
            table.page.len($(this).val()).draw();
        });

        // Custom pagination info
        table.on('draw', function() {
            var pageInfo = table.page.info();
            $('.results_count').text(
                `Showing ${pageInfo.start + 1} to ${pageInfo.end} of ${pageInfo.recordsTotal} results`
            );
        });
    });

    /// show a modal for creation
    $('#create-user-btn').on('click', function() {
        clearValidationError();
        $('#createUserInformation').modal('show'); 
        $('#add-user-form')[0].reset();
        $('#user_id').val('');
        $('.main-title').text('Create New User');
        $('.submit-btn').text('Add User');
        $('.on_add_user').removeClass('d-none');
        $('.on_edit_user').addClass('d-none');
    });

   
    // Create or Update an Ad Placement based on adPlacementId
    $('#add-user-form').on('submit', function(e) {
        e.preventDefault();

        var userId = $('#user_id').val(); 
        var url = userId ? '/admin/update-user/' + userId : '{{ route("admin.create.user") }}';   
        var method = userId ? 'PUT' : 'POST';   

        var formData = $(this).serialize(); 
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#createUserInformation').modal('hide'); // Hide modal on success
                    $('#add-user-form')[0].reset();
                    $('.user_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });
    
    // edit 
    function editUser(userId)
    {
        $.ajax({
            url: '/admin/edit-user/' + userId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#email').val(response.data.email);
                $('#hourly_rate').val(response.data.hourly_rate);
                $('#user_type').val(response.data.user_type);
                $('#user_id').val(userId); // Set the case type ID in the hidden input
                $('.main-title').text('Edit User Information');
                $('.submit-btn').text('Apply Changes');
                $('.on_add_user').addClass('d-none');
                $('.on_edit_user').removeClass('d-none');
                
                // Show the modal
                $('#createUserInformation').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteUser(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-user/' + userId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.user_table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        toastr.error('Unable to handle request! Please try again.', 'Error');
                    }
                });
            }
        });
    }

    function toggleUserStatus(userId)
    {
        token = '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token

        $.ajax({
            url: '/admin/update-user-status/' + userId,
            method: 'PUT',
            data: token,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('.user_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    }

    function editUserEvents(userId, userEmail)
    {
        $.ajax({
            url: '/admin/edit-user-event/' + userId,
            method: 'GET',
            
            success: function(response) {
                //console.log(response);
                
                clearValidationError();

                // unclear checkboxes.
                $('input[name="case_type_events[]"]').prop('checked', false);
                $('#accounting_event').prop('checked', false);

                $('#event_user_id').val(userId);
                $('#event_user_email').text(userEmail);
                

                 // Get selected case type events from response and parse JSON
                let selectedCaseTypes = response.data.case_type_events 
                    ? response.data.case_type_events.replace(/"/g, '').split(',')
                    : [];

                // Loop through and check matching checkboxes
                selectedCaseTypes.forEach(function (caseId) {
                    $('#casetype_' + caseId).prop('checked', true);
                });

                // Check the accounting event if it was set to "yes"
                if (response.data.account_event === "yes") {
                    $('#accounting_event').prop('checked', true);
                }
                            
                
                // Show the modal
                $('#selectEvents').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    
    $('#update-edit-event').on('submit', function(e) {
        e.preventDefault();

        var userId = $('#event_user_id').val();
       
        var url = '/admin/update-user-event/' + userId;   
        var method = 'PUT';
        
        let selectedCaseTypes = [];
        $('input[name="case_type_events[]"]:checked').each(function () {
            selectedCaseTypes.push($(this).data('case-id'));
        });

        let accountingEvent = null;
        if ($('#accounting_event').is(':checked')) {
            accountingEvent = $('#accounting_event').data('user-id');
        }

        if (selectedCaseTypes.length === 0) {
            selectedCaseTypes = null;
        }

        $.ajax({
            url: url,
            method: method,
            data: {
                selectedCaseTypes:selectedCaseTypes,
                accounting_event: accountingEvent,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#selectEvents').modal('hide'); // Hide modal on success
                    $('#update-edit-event')[0].reset();
                    $('.user_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });


    function editUserAccess(userId, email)
    {
        $.ajax({
            url: '/admin/edit-user-assess/' + userId,
            method: 'GET',
            
            success: function(response) {
                //console.log(response);
                
                clearValidationError();

                // unclear checkboxes.
                $('input[name="user_access[]"]').prop('checked', false);
               

                $('#assess_user_id').val(userId);
                $('#assess_user_email').text(email);
                

                //  // Get selected case type events from response and parse JSON
                let selectedUserAccess = response.data.access_modules 
                    ? response.data.access_modules.replace(/"/g, '').split(',')
                    : [];
                    console.log(selectedUserAccess);

                // Loop through and check matching checkboxes
                selectedUserAccess.forEach(function (access_name) {
                    console.log(access_name);
                    $('#access_' + access_name).prop('checked', true);
                });

                // // Check the accounting event if it was set to "yes"
                // if (response.data.account_event === "yes") {
                //     $('#accounting_event').prop('checked', true);
                // }
                            
                
                // Show the modal
                $('#assignAssess').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

      
    $('#update-user-assess').on('submit', function(e) {
        e.preventDefault();

        var userId = $('#assess_user_id').val();
        var url = '/admin/update-user-access/' + userId;   
        var method = 'PUT';
        
        let selectedUserAccess = [];
        $('input[name="user_access[]"]:checked').each(function () {
            selectedUserAccess.push($(this).data('access-id'));
        });
        
        if (selectedUserAccess.length === 0) {
            selectedUserAccess = null;
        }
        $.ajax({
            url: url,
            method: method,
            data: {
                selectedUserAccess:selectedUserAccess,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#assignAssess').modal('hide'); // Hide modal on success
                    $('#update-user-assess')[0].reset();
                    $('.user_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });

    function userResetPassword(userId)
    {
        $.ajax({
            url: '/admin/update-user-password/' + userId,
            method: 'PUT',
            data: {
                _token: "{{ csrf_token() }}"
            },
            
            success: function(data) {
                $('.user_table').DataTable().ajax.reload(null, false);
                toastr.success(data.message);
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }
    

    
 
</script>
    
@endpush