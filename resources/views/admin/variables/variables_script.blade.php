<script>
    $(document).ready(function() {
        // Email table pagination and per page handling


        $('#showEmailTable').on('click', function() {
            $('#emailTable').removeClass('d-none'); // Show email table
            $('#documentTable').addClass('d-none'); // Hide document table

            // Update button styles
            $(this).removeClass('bg_F1F2F2 text_6A6A6A').addClass('bg_FCAF3B text-white');
            $('#showDocumentTable').removeClass('bg_FCAF3B text-white').addClass('bg_F1F2F2 text_6A6A6A');
        });

        // Show Document Table on click
        $('#showDocumentTable').on('click', function() {
            $('#documentTable').removeClass('d-none'); // Show document table
            $('#emailTable').addClass('d-none'); // Hide email table

            // Update button styles
            $(this).removeClass('bg_F1F2F2 text_6A6A6A').addClass('bg_FCAF3B text-white');
            $('#showEmailTable').removeClass('bg_FCAF3B text-white').addClass('bg_F1F2F2 text_6A6A6A');
        });
        // Fetch variable data on page load
        $.ajax({
            url: '{{ route("admin.getEmailVariables") }}', // Adjust this to your route
            type: 'GET',
            success: function(response) {
                if (response.success && Array.isArray(response.data)) {
                    var variables = response.data;

                    // Clear any existing DataTable instance
                    if ($.fn.DataTable.isDataTable('.email_table')) {
                        $('.email_table').DataTable().clear().destroy();
                    }

                    // Initialize DataTable
                    var table = $('.email_table').DataTable({
                        "autoWidth": false,
                        "responsive": true,
                        processing: false, // No server-side processing for this example
                        data: variables, // Use fetched variables as data source
                        columns: [{
                                data: 'variable',
                                title: 'Variable'
                            }, // Column for variable
                            {
                                data: 'label',
                                title: 'Label'
                            }, // Column for label
                            {
                                data: 'category',
                                title: 'Category'
                            }, // Column for category,  // Column for created_at
                            {
                                data: null,
                                title: 'Actions',
                                render: function(data, type, row) {
                                    return `
                            <div class="dropdown">
                                <button 
                                    class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" 
                                    type="button" 
                                    id="dropdownMenuButton1" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a 
                                            class="dropdown-item text_12_400 text_6A6A6A" 
                                            data-bs-toggle="modal" 
                                            href="#addNewVariable" 
                                            role="button"
                                            data-id="${row.id}"
                                            data-variable="${row.variable}"
                                            data-label="${row.label}"
                                            data-category="${row.category}">
                                            <img src="<?= url('') ?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            `;
                                }
                            } // Column for actions
                        ],
                        pageLength: 10,
                        initComplete: function() {
                            $('.dataTables_filter input').addClass('table_search_input');
                        }
                    });


                } else {
                    toastr.error("Failed to load variable data.");
                }
            },
            error: function(response) {
                toastr.error("Error fetching variable data.");
            }
        });
        $.ajax({
            url: '{{ route("admin.getDocVariables") }}', // Adjust this to your route
            type: 'GET',
            success: function(response) {
                if (response.success && Array.isArray(response.data)) {
                    var variables = response.data;

                    // Clear any existing DataTable instance
                    if ($.fn.DataTable.isDataTable('.document_table')) {
                        $('.document_table').DataTable().clear().destroy();
                    }

                    // Initialize DataTable
                    var table = $('.document_table').DataTable({
                        "autoWidth": false,
                        "responsive": true,
                        processing: false, 
                        data: variables, 
                        columns: [{
                                data: 'variable',
                                title: 'Variable'
                            }, // Column for variable
                            {
                                data: 'label',
                                title: 'Label'
                            }, // Column for label
                            {
                                data: 'category',
                                title: 'Category'
                            }, 
                            {
                                data: null,
                                title: 'Actions',
                                render: function(data, type, row) {
                                    return `
                            <div class="dropdown">
                                <button 
                                    class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" 
                                    type="button" 
                                    id="dropdownMenuButton1" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a 
                                            class="dropdown-item text_12_400 text_6A6A6A" 
                                            data-bs-toggle="modal" 
                                            href="#addNewVariable" 
                                            role="button"
                                            data-id="${row.id}"
                                            data-variable="${row.variable}"
                                            data-label="${row.label}"
                                            data-category="${row.category}">
                                            <img src="<?= url('') ?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            `;
                                }
                            } 
                        ],
                        pageLength: 10,
                        initComplete: function() {
                            $('.dataTables_filter input').addClass('table_search_input');
                        }
                    });

                    
                } else {
                    alert("Failed to load variable data.");
                }
            },
            error: function(response) {
                alert("Error fetching variable data.");
            }
        });




        // Datepicker setup
        $('#date_of_birth').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2025",
            showAnim: "slideDown"
        });
    });

    function updateTable(itemsPerPage) {
        $('.email_table').DataTable().page.len(itemsPerPage).draw();

        // Or if you're fetching data via AJAX:
        $.ajax({
            url: '/your-api-endpoint', // Replace with your endpoint
            type: 'GET',
            data: {
                per_page: itemsPerPage
            },
            success: function(response) {
                // Update your table with the new data
            },
            error: function() {
                alert('Failed to load data');
            }
        });
    }

    $(document).on('click', '.dropdown-item[data-bs-toggle="modal"]', function() {
        // Extract variable data from the button
        const id = $(this).data('id');
        const isEdit = $(this).data('id'); // Check if an ID is provided
        $('#modalTitle').text(isEdit ? 'Edit Variable' : 'Add New Variable');
        const variable = $(this).data('variable');
        const label = $(this).data('label');
        const category = $(this).data('category');

        // Populate modal fields
        $('#variable').val(variable);
        $('#label').val(label);

        $(`input[name="category"][value="${category.toLowerCase()}"]`).prop('checked', true);

        // Change modal title for editing
        $('.text_20_700').text('Edit Variable');
        // Attach the ID to a data attribute for saving
        $('.save-variable').attr('data-id', id);
    });

    $('#addNewVariable').on('hidden.bs.modal', function() {
        $('#variable').val('');
        $('#label').val('');
        $('input[name="category"]').prop('checked', false).first().prop('checked', true);
        $('.save-variable').data('id', ''); // Clear ID for new entry
        $('#modalTitle').text('Add New Variable'); // Reset title
    });

    $(document).on('click', '.save-variable', function() {
        const id = $(this).data('id'); // Get the ID (if editing)
        const variable = $('#variable').val();
        const label = $('#label').val();
        const category = $('input[name="category"]:checked').val();

        // Get the CSRF token from the meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (id) {
            // Update existing variable
            $.ajax({
                url: `{{ url('admin/variables') }}/${id}`,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Add CSRF token in headers
                },
                data: {
                    variable,
                    label,
                    category
                },
                success: function(response) {
                    $('#addNewVariable').modal('hide');
                    window.location.reload();
                },
                error: function() {
                    toastr.error('Failed to update variable.');
                }
            });
        } else {
            // Add a new variable
            $('.error').remove();
            $.ajax({
                url: '{{ url('admin/variables') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Add CSRF token in headers
                },
                data: {
                    variable,
                    label,
                    category
                },
                success: function(response) {
                    $('#addNewVariable').modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                    // Display validation errors
                    let errors = xhr.responseJSON.errors;
                    if (errors.variable) {
                        $('#variable').after(`<div class="error text-danger mt-1">${errors.variable[0]}</div>`);
                    }
                    if (errors.label) {
                        $('#label').after(`<div class="error text-danger mt-1">${errors.label[0]}</div>`);
                    }
                    if (errors.category) {
                        $('input[name="category"]:last').after(`<div class="error text-danger mt-1">${errors.category[0]}</div>`);
                    }
                } else {
                    toastr.error('An unexpected error occurred.');
                }
                }
            });
        }
    });
</script>