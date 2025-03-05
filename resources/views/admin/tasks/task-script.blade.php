<script>
    const routes = {
        storeTask: "{{ route('admin.tasks.store') }}",
        deleteTask: "{{ route('admin.tasks.destroy', ['task' => ':task']) }}",
        updateTask: "{{ route('admin.tasks.update', ['taskId' => ':taskId']) }}", // Placeholder for taskId
        getTask: "{{ route('admin.get.task', ['taskId' => ':taskId']) }}", // Placeholder for taskId
    };
    
    $(document).ready(function() {
 

        const loadTabContent = (tab, search = '') => {
            $.ajax({
                url: "{{ route('admin.tasks') }}",
                type: "GET",
                data: {
                    tab,
                    search
                },
                success: function(response) {
                    $('#tab-content-container').html(response.html);
                    $('#search-input').val(search);

                },
                error: function() {
                    alert("Error loading data. Please try again.");
                }
            });
        };

        // Load initial tab
        loadTabContent('pending-assigned-to-me');

        // Tab click event
        $('.nav-link').on('click', function() {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            const tab = $(this).data('tab');
            loadTabContent(tab);
        });

        // Search functionality
        $(document).on('submit', '#search-form', function(e) {
            e.preventDefault();
            const tab = $('.nav-link.active').data('tab');
            const search = $('#search-input').val();
            loadTabContent(tab, search);
        });



        // Fetch tasks on tab change
        $('.nav-link').on('click', function() {
            console.log("54");
            const tab = $(this).data('bs-target').replace('#', '');
            console.log(tab);
            fetchTasks(tab);
        });
 
        // Initial fetch for the active tab
        const initialTab = $('.nav-link.active').data('bs-target').replace('#', '');
        fetchTasks(initialTab);
    });

    
    $(document).on('keyup', '.search_input', function() {
        const search = $(this).val().trim();
        const tab = $('.nav-link.active').data('tab');
        // If the search input is cleared, trigger the AJAX request
        if (search === '') {
            fetchTasks(tab, search);
        }
    });

    function fetchTasks(tab, search = '') {
        console.log("85");
        console.log(tab)
        console.log("87");
        console.log(search)
        $.ajax({
            url: "{{ route('admin.tasks') }}",
            method: "GET",
            data: {
                tab: tab,
                search: search
            },
            success: function(response) {
                let tasksHtml = '';
                if (response.tasks && Array.isArray(response.tasks)) {
                    // response.tasks.forEach(task => {

                } else {
                    tasksHtml = `<div class="col-12">No tasks available.</div>`;
                }
                console.log(response);
                // $('.nav-link').removeClass('active'); // Remove 'active' class from all buttons
                // $(`#${tab}`).addClass('active');
                // console.log(`#${tab}`)
                $(`#tab-content-container`).html(response.html);
            },
            error: function(error) {
                console.error("Error fetching tasks:", error);
            }
        });
    }

    function refreshTaskList() {
        console.log("117");
        const activeTab = $('.nav-link.active').data('tab'); // Get the active tab identifier
        const search = $('#search-input').val() || ''; // Get the current search input value

        // Refresh data for the active tab
        fetchTasks(activeTab, search);

        // Optionally, reload all tabs to ensure complete data sync
        $('.nav-link').each(function() {
            const tab = $(this).data('tab');
            if (tab !== activeTab) {
                fetchTasks(tab);
            }
        });
    }

    function deleteTask(taskId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you want to delete this task",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the AJAX request to delete the task
                $.ajax({
                    url: routes.deleteTask.replace(':task', taskId), // Replace placeholder with task ID
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Show success message after deletion
                        if (response.success) {
                            toastr.success('Task deleted Successfully');
                        } else {
                            toastr.error('Failed to delete task');
                        }

                        // Refresh tasks after successful deletion
                        const activeTab = $('.nav-link.active').data('tab');
                        fetchTasks(activeTab, null);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors during deletion
                        console.error('Error deleting task:', xhr.responseText);
                        toastr.error('Failed to delete the task. Please try again');
                    }
                });
            }
        });
    }


    $('#addTaskModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var taskId = button.data('task-id'); // Get task ID from data-task-id (if updating)
        clearValidationError();
        // Reset the form fields for a new task
        if (!taskId) {
            $('#modalTitle').text('Add New Task'); 
            $('#taskId').val(''); // Clear task ID
            $('#client_name').val(''); // Clear client name
            $('#details').val(''); // Clear details
            $('#date').val(''); // Clear date
            $('#time').val(''); // Clear time
            $('#client_id').val(''); // Clear time
            $('#client_info_id').val(''); // Clear time
            
            $('#userList input[type="checkbox"]').prop('checked', false); // Uncheck all users
            $('#submitTaskBtn').text('Submit'); // Change button text to "Submit"
        } else {
            $('#modalTitle').text('Edit Task'); // Change title to "Edit Task"
            $('#taskId').val(taskId); // Set task ID for updating
            $('#submitTaskBtn').text('Update'); // Change button text to "Update"

            // Fetch task data and fill the form (using AJAX or data passed from the button)
            $.ajax({
                url: routes.getTask.replace(':taskId', taskId), // Fetch task details by ID
                method: 'GET',
                success: function(response) {
                    $('#client_name').val(response.task.client.primary_client_name);
                    $('#client_id').val(response.task.client_id);
                    $('#client_info_id').val(response.task.client_case_information_id );
                    $('#details').val(response.task.details);
                    $('#date').val(response.task.date);
                    $('#time').val(response.task.time);

                    // Populate the users list
                    response.users.forEach(function(user) {
                        $('#userList input[data-user-id="' + user.id + '"]').prop('checked', true);
                    });
                }
            });
        }
    });

    $('#submitTaskBtn').on('click', function() {
        
    var taskId = $('#taskId').val();
    var url = taskId ? routes.updateTask.replace(':taskId', taskId) : routes.storeTask;

    // Collect selected user IDs for both user_ids and assigned_users
    var userIds = $('#userList input:checked').map(function() {
        return $(this).data('user-id');
    }).get();

    // Check if any user is selected
    // if (userIds.length === 0) {
    //     $('#user_list_error').text('Please select at least one user.');
    //     return;
    // } else {
    //     $('#user_list_error').text(''); // Clear any previous error
    // }

    var method = taskId ? 'PUT' : 'POST'; // Use PUT for update, POST for create

    var formData = {
        client_id: $('#client_id').val(),
        client_info_id: $('#client_info_id').val(),
        details: $('#details').val(),
        date: $('#date').val(),
        time: $('#time').val(),
        user_ids: userIds, // List of selected user IDs
        assigned_by: "{{ auth()->user()->id }}", // Pass the current user's ID as assigned_by
        assigned_users: userIds // Assigning the selected users to assigned_users
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // Clear previous errors
    $('.text-danger').text(''); // Remove any previous error messages

    $.ajax({
        url: url,
        method: method,
        data: formData,

        success: function(data) {
            if (!data.success) {
                if (data.errors) {
                    displayErrors(data.errors);
                }
                else {
                    toastr.error('Unable to handle request! Please try again.', 'Error');
                }
            } else {
                $('#addTaskModal').modal('hide'); // Close the modal
                const activeTab = $('.nav-link.active');
                const targetTab = activeTab.data('tab');
                if (targetTab) {
                    const initialTab = targetTab.replace('#', '');
                    fetchTasks(initialTab, '');
                }
                toastr.success(data.message);
            }
        },
        error: function(error) {
            toastr.error('Unable to handle request! Please try again.', 'Error');
            //displayCommonError(error)
        }
    });
});


    $('#viewTaskModal').on('show.bs.modal', function(event) {
        console.log("here");
        var button = $(event.relatedTarget); // Button that triggered the modal
        var taskId = button.data('task-id'); // Get task ID from data-task-id

        // Fetch task data and populate the modal
        $.ajax({
            url: routes.getTask.replace(':taskId', taskId), // Fetch task details by ID
            method: 'GET',
            success: function(response) {
                // Populate task details
                $('#viewClientName').val(response.task.client.primary_client_name);
                $('#viewDetails').val(response.task.details);
                $('#viewDate').val(response.task.date);
                $('#viewTime').val(response.task.time);

                // Populate users list
                var userHtml = '';
                response.users.forEach(function(user) {
                    userHtml += `<div class="mb_21"><span class="text_16_400 text_6A6A6A ml_10">${user.name}</span></div>`;
                });
                $('#viewUsersList').html(userHtml);
            },
            error: function(xhr) {
                console.error('Error fetching task details:', xhr.responseJSON);
            }
        });
    });

    //// new script
    $('#client_name').on('keyup', function() {
        let searchQuery = $(this).val().trim();

        if (searchQuery.length >= 2) { // Only search if at least 2 characters are entered
            $.ajax({
                url: '{{ route("admin.searchClients") }}', // Laravel route to fetch clients
                type: 'GET',
                data: { search: searchQuery },
                success: function(response) {
                    let clientList = response.clients;
                    console.log(clientList);
                    let dropdown = '';

                    if (clientList.length > 0) {
                        dropdown += '<ul class="dropdown-menu show" style="display:block; position:absolute; width:100%;">';
                        $.each(clientList, function(index, client) {
                            if (client.client_cases_info.length > 0) {
                                $.each(client.client_cases_info, function(caseIndex, caseInfo) {
                                    
                                    let caseDetails = `${client.primary_client_name} - Service: ${caseInfo.case_type.name} - Case Number: ${caseInfo.case_number}`;
                                    dropdown += `<li class="dropdown-item client-item" 
                                                    data-id="${client.id}" 
                                                    data-clientinfoid="${caseInfo.id}" 
                                                    data-name="${client.primary_client_name}" 
                                                    data-case="${caseInfo.case_number}">
                                                    ${caseDetails}
                                                 </li>`;
                                });
                            } else {
                                dropdown += `<li class="dropdown-item client-item" 
                                                data-id="${client.id}" 
                                                data-name="${client.primary_client_name}">
                                                ${client.primary_client_name} - No Cases Found
                                             </li>`;
                            }
                        });
                        dropdown += '</ul>';
                    } else {
                        //dropdown = '<ul class="dropdown-menu show" style="display:block; position:absolute; width:100%;"><li class="dropdown-item">No clients found</li></ul>';
                    }

                    console.log(dropdown);
                    $('.client-dropdown').html(dropdown); // Show dropdown suggestions
                }
            });
        } else {
            $('.client-dropdown').html(''); // Hide dropdown if input is cleared
        }
    });

    // Select a client from the dropdown
    $(document).on('click', '.client-item', function() {
        $('#client_name').val($(this).data('name'));
        $('#client_id').val($(this).data('id'));
        $('#client_info_id').val($(this).data('clientinfoid'));
        $('.client-dropdown').html(''); // Hide dropdown after selection

    });

</script>