@push('scripts')

<script>
    $('#convert-lead-into-client-btn').on('click', function() {
        const leadId = this.getAttribute('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to convert this lead into a client.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Make the AJAX request
                $.ajax({
                    url: '{{ route('admin.convert-lead-to-client')}}',
                    method: 'POST',
                    data: {
                        id: leadId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        //window.location.href = '/admin/leads';
                        document.getElementById('lead_or_client').innerText = 'NO';
                        document.getElementById("convert-lead-into-client-btn").style.display = "none";
                        toastr.success(data.message);
                    },
                    error: function(error) {
                        console.log("Error -->", error);

                    }
                });
            }
        });
    });


    $('#client-info').on('submit', function(e) {
        e.preventDefault();

        var clientId = $('#client_id').val();
        var client_case_information_id = $('#client_case_information_id').val();
        var url = '/admin/update-client-info/' + clientId +'/'+client_case_information_id;

        var intakeFields = [];

        var processedGroups = new Set();

        $('input[name="radio_groups[]"]').each(function() {
            var groupName = $(this).val();
            if (processedGroups.has(groupName)) {
                return;
            }
            processedGroups.add(groupName);
            var radioGroupName = `intake_fields-${groupName}`;
            var selectedRadio = $(`input[name="${radioGroupName}"]:checked`);
            var selectedValue = selectedRadio.val();
            intakeFields.push({
                id: groupName,
                value: selectedValue || null,
                dataId: $(this).data('id'),
                type: 'radio',
            });
        });


        //// other fields
        var processedFields = new Set();

        $('input[name^="intake_fields["], textarea[name^="intake_fields["], select[name^="intake_fields["]').each(function() {
            var fieldName = $(this).attr('name');
            if (processedFields.has(fieldName)) {
                return;
            }
            processedFields.add(fieldName);
            var matches = fieldName.match(/intake_fields\[(\d+)\]\[value\]/);
            if (matches) {
                var fieldId = matches[1];
                intakeFields.push({
                    id: fieldId,
                    value: $(this).val(),
                    dataId: $(this).data('id') || null,
                    type: 'other',
                });
            }
        });

        // Transform intakeFields to use dataId as the index
        var transformedIntakeFields = {};
        intakeFields.forEach(function (field) {
            if (field.dataId) {
                transformedIntakeFields[field.dataId] = field;
            }
        })

        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            case_analyst: $('#case_analyst').val(),
            attorney_assigned: $('#attorney_assigned').val(),
            case_number: $('#case_number').val(),
            case_title: $('#case_title').val(),
            case_filed: $('#case_filed').val(),
            complaint_filed: $('#complaint_filed').val(),
            complaint_served: $('#complaint_served').val(),
            court_address: $('#court_address').val(),
            department: $('#department').val(),
            judge: $('#judge').val(),
            answer_filed: $('#answer_filed').val(),
            answer_served: $('#answer_served').val(),
            opposing_party_name: $('#opposing_party_name').val(),
            opposing_party_address: $('#opposing_party_address').val(),
            opposing_party_phone_number: $('#opposing_party_phone_number').val(),
            attorney_name: $('#attorney_name').val(),
            attorney_firm: $('#attorney_firm').val(),
            attorney_phone_number: $('#attorney_phone_number').val(),
            attorney_fax: $('#attorney_fax').val(),
            attorney_email: $('#attorney_email').val(),
            intake_fields: transformedIntakeFields,
            tab:"false",
        };

        $.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            success: function(data) {

                if (!data.success || data.errors) {
                    console.log(data.errors);
                    displayErrors(data.errors);
                } else {
                    //window.location.href = '/admin/leadSources';
                    // Populate the form with the updated data
                    for (const key in data.updatedData) {
                        if ($(`[name="${key}"]`).length) {
                            $(`[name="${key}"]`).val(data.updatedData[key]);
                        }
                    }
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });


    /// client intake lead notes tab ///

    $('#client-intake-lead-notes-tab').on('submit', function(e) {
        e.preventDefault();

        var clientId = $('#client_id').val();
        var client_case_information_id = $('#client_case_information_id').val();
        var url = '/admin/update-client-info/' + clientId +'/'+client_case_information_id;

        var intakeFields = [];

        var processedGroups = new Set();

        $('input[name="radio_groups[]"]').each(function() {
            var groupName = $(this).val();
            if (processedGroups.has(groupName)) {
                return;
            }
            processedGroups.add(groupName);
            var radioGroupName = `intake_fields-${groupName}`;
            var selectedRadio = $(`input[name="${radioGroupName}"]:checked`);
            var selectedValue = selectedRadio.val();
            intakeFields.push({
                id: groupName,
                value: selectedValue || null,
                dataId: $(this).data('id'),
                type: 'radio',
            });
        });


        //// other fields
        var processedFields = new Set();

        $('input[name^="intake_fields["], textarea[name^="intake_fields["], select[name^="intake_fields["]').each(function() {
            var fieldName = $(this).attr('name');
            if (processedFields.has(fieldName)) {
                return;
            }
            processedFields.add(fieldName);
            var matches = fieldName.match(/intake_fields\[(\d+)\]\[value\]/);
            if (matches) {
                var fieldId = matches[1];
                intakeFields.push({
                    id: fieldId,
                    value: $(this).val(),
                    dataId: $(this).data('id') || null,
                    type: 'other',
                });
            }
        });


        // Transform intakeFields to use dataId as the index
        var transformedIntakeFields = {};
        intakeFields.forEach(function (field) {
            if (field.dataId) {
                transformedIntakeFields[field.dataId] = field;
            }
        })

        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            hear_about_us: $('#hear_about_us').val(),
            city: $('#city').val(),
            area: $('#area').val(),
            lead_status_id: $('#lead_status_id').val(),
            lead_assigned_to: $('#lead_assigned_to').val(),
            attorney_percentage: $('#attorney_percentage').val(),
            lead_notes: $('#lead_notes').val(),

            intake_fields: transformedIntakeFields,
            tab: "true",
        };

        $.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            success: function(data) {

                if (!data.success || data.errors) {
                    console.log(data.errors);
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
                    let dataerrors = data.errors;

                    for (let field in dataerrors) {
                        if (dataerrors.hasOwnProperty(field)) {
                            // console.log(field);
                            const errorElement = document.getElementById(`error_tab_${field}`);

                            console.log(errorElement);
                            if (errorElement) {
                                console.log("here 221");
                                errorElement.style.display = 'block';
                                errorElement.textContent = dataerrors[field][0]; // Display the first error message
                            }
                        }
                    }

                } else {
                    //window.location.href = '/admin/leadSources';
                    // Populate the form with the updated data
                    for (const key in data.updatedData) {
                        if ($(`[name="${key}"]`).length) {
                            $(`[name="${key}"]`).val(data.updatedData[key]);
                        }
                    }
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    /// client appointment

    $('#client-appointment-form').on('submit', function(e) {
        e.preventDefault();

        var client_case_information_id = $('#client_case_information_id').val();
        var url = '/admin/client-appointment/' + client_case_information_id;

        var formData = $(this).serialize();
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token


        $.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors);
                    //toastr.error(data.message);
                } else {
                    //window.location.href = '/admin/leadSources';
                    // Populate the form with the updated data
                    $('#client-appointment-form')[0].reset();

                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });


    $('#client-filter').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: '{{ route('admin.clientsList')}}',
            method: 'GET',
            data: formData, // Send the form data
            success: function(response) {
                console.log(response);
                $('#client_list').html(response.client_list); // Update client list
            }
        });
    });


    function triggerFileInput() {
        document.getElementById('file-input').click();
    }

    $('#file-input').on('change', function() {
        var clientId = $('#client_id').val();
        var client_case_information_id = $('#client_case_information_id').val();
        const fileInput = this;
        const errorMessage = $('#error-message');
        const successMessage = $('#success-message');
        const files = fileInput.files;
        const maxFileSize = 7 * 1024 * 1024; // 7MB
        const allowedExtensions = ['tiff', 'tif', 'pdf', 'jpeg', 'gif', 'doc', 'xls', 'docx', 'xlsx'];

        // Clear error and success message
        errorMessage.text('');
        successMessage.text('');

        let valid = true;
        $.each(files, function(index, file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                valid = false;
                errorMessage.text(`Invalid file type: ${file.name}`);
                return false; // Break the loop
            } else if (file.size > maxFileSize) {
                valid = false;
                errorMessage.text(`File size exceeds limit: ${file.name}`);
                return false; // Break the loop
            }
        });

        if (valid) {
            const formData = new FormData($('#client-doc-upload-form')[0]);
            var url = '/admin/upload-document/' + client_case_information_id;

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (data.success) {
                        $('.client_doc').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        //successMessage.text('Files uploaded successfully!');
                    } else {
                        toastr.error(data.message);
                        //errorMessage.text(response.message || 'An error occurred while uploading.');
                    }
                },
                error: function() {
                    toastr.error(data.message);
                    //errorMessage.text('An error occurred. Please try again.');
                }
            });
        }
    });


    $(document).ready(function() {

        $('#saveClientStatus').click(function () {
            // Get the selected status value
            let selectedStatus = $('#status').val();

            // Get the record ID from the button's data attribute
            let recordId = $(this).data('record-id');

            // Check if a status is selected
            if (!selectedStatus) {
                alert('Please select a status!');
                return;
            }

            // AJAX request to save the status
            $.ajax({
                url: "{{ route('admin.client.saveStatus') }}", // Replace with your route name
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for security
                    status: selectedStatus,
                    record_id: recordId // Use the dynamic record ID
                },
                success: function (response) {
                    if (response.success) {

                        toastr.success('Status updated successfully!');
                    } else {
                        toastr.error(response.message || 'Failed to update status.');

                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('An error occurred while updating the status.');
                }
            });
        });

        $('#add_service_matter').click(function () {

            const button = document.getElementById('add_service_matter');
            const div = document.getElementById('add_new_service_matter');
            div.classList.remove('d-none');
            div.style.display = 'block';
        });


        //var clientId = $('#client_id').val();
        var client_case_information_id = $('#client_case_information_id').val();

        var url = '/admin/document-listing/' + client_case_information_id;
        // client document table
        var table = $('.client_doc').DataTable({
            "autoWidth": false,
            "responsive": true,
            processing: false,


            ajax: {
                url: url,
                type: 'GET',
            },
            ordering: false, // Disable sorting globally for all columns
            columns: [
                {
                    data: 'name',
                    render: function (data, type, row) {
                        // Create a clickable link with green text color
                        return `<a class="text_126C9B" href="${row.path}" download="${row.name}">${data}</a>`;
                    }
                },

                {
                    data: 'created_at',
                    render: function(data) {
                        if (data) {
                            const date = new Date(data); // Convert to a Date object
                            const formattedDate = (date.getMonth() + 1).toString().padStart(2, '0') + '/' +
                                date.getDate().toString().padStart(2, '0') + '/' +
                                date.getFullYear();
                            return formattedDate; // Return in MM/DD/YYYY format
                        }
                        return '';
                    }
                },
                {
                    data: 'file_size',
                    render: function(data) {
                        if (data) {
                            const formattedSize = parseFloat(data).toFixed(2);
                            return `${formattedSize} KB`;
                        }
                        return '0.00 KB';
                    }
                },

                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteDocument(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete</a>
                                    </li>
                                </ul>
                            </div>`;
                    }

                }
            ],
            pageLength: 10,

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
        //// end client document table

        /// logs
        getClientLogs();

        /// tasks


        var taskUrl = '/admin/client-task/' + client_case_information_id;


        var table = $('.client_tasks').DataTable({
            "autoWidth": false,
            "responsive": true,
            processing: false,


            ajax: {
                url: taskUrl,
                type: 'GET',
            },
            ordering: false, // Disable sorting globally for all columns
            columns: [{
                    data: 'details'
                },
                {
                    data: 'users', // This will contain the users data
                    render: function(data, type, row) {
                        if (data && data.length) {
                            // Join the user names into a comma-separated list
                            return data.map(user => user.name).join(', ');
                        }
                        return 'No user assigned';
                    }
                },
                { data: 'date' },
                { data: 'time' },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        let statusClass = data === 'completed' ? 'text-success' : 'text-danger';
                        let statusText = data.charAt(0).toUpperCase() + data.slice(1);
                        return `<span class="${statusClass}">${statusText}</span>`;
                    }
                },

                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editClientTask(${row.id})">
                                             <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteClientTask(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="markClientTask(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/mark-tick.svg" alt="" width="10px"> ${row.status === 'incomplete' ? 'Mark as Complete' : 'Mark as Incomplete'}
                                    </li>

                                </ul>
                            </div>`;
                    }

                }
            ],

            pageLength: 10,

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

        /// invoices


        var invoiceUrl = '/admin/client-invoices/' + client_case_information_id;

        var table = $('.client_invoices').DataTable({
            "autoWidth": false,
            "responsive": true,
            processing: false,


            ajax: {
                url: invoiceUrl,
                type: 'GET',
            },
            ordering: false, // Disable sorting globally for all columns
            columns: [{
                    data: null,
                    render: function(data, type, row) {
                        return `<span >${row.id}</span>`;
                    }
                },
                {
                    data: null, // This will contain the users data
                    render: function(data, type, row) {
                        return row.case_type.name;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (row.invoice_type === 'Contingency') {
                            return '$'+(row.total_fee ? parseFloat(row.total_fee).toFixed(2): '0.00');
                        } else {
                            return '$'+(row.attorney_fee ? parseFloat(row.attorney_fee).toFixed(2) : '0.00');
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {

                            return '$'+(row.filing_fee ? parseFloat(row.filing_fee).toFixed(2):'0.00');

                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {

                            return '$0';

                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return row.invoice_type;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return row.status;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editClientTask(${row.id})">
                                             <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteClientTask(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="markClientTask(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/mark-tick.svg" alt="" width="10px"> ${row.status === 'incomplete' ? 'Mark as Complete' : 'Mark as Incomplete'}
                                    </li>

                                </ul>
                            </div>`;
                    }

                }
            ],

            pageLength: 10,

        });

        /// client email
        var taskUrl = '/admin/client-email/'+ client_case_information_id;

        var table = $('.client_email').DataTable({
            "autoWidth": false,
            "responsive": true,
            processing: false,


            ajax: {
                url: taskUrl,
                type: 'GET',
            },
            ordering: false, // Disable sorting globally for all columns
            columns: [
                { data: 'subject' },
                { data: 'from' },
                { data: 'to' },
                { data: 'created_at' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="viewClientEmail(${row.id})">
                                            <img src="<?=url('')?>/assets/images/trash-grey.svg" alt="" width="10px"> View</a>
                                    </li>

                                </ul>
                            </div>`;
                    }

                }
            ],

            pageLength: 10,

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

    function deleteDocument(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-document/' + id;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.client_doc').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
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

    /// show a model for crration log

    $('#client-log-btn').on('click', function() {
        $('#addNewLog').modal('show');
        $('#log-form')[0].reset();
        $('#logId').val('');
        $('.main-title').text('Add New Log');
        $('.submit-btn').text('Submit');
    });


    // Create or Update an Ad Placement based on adPlacementId
    $('#log-form').on('submit', function(e) {
        e.preventDefault();

        var logId = $('#logId').val();
        var url = logId ? '/admin/logs-update/' + logId : '{{ route("admin.create-logs") }}';
        var method = logId ? 'PUT' : 'POST';

        var formData = $(this).serialize();
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content'); // Append CSRF token

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#addNewLog').modal('hide');
                    $('#log-form')[0].reset();
                    getClientLogs();
                    //$('.ad_placement').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);

                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });



    function editLog(logid) {
        $.ajax({
            url: '/admin/logs-edit/' + logid,
            method: 'GET',

            success: function(response) {

                // Populate the form fields with the user data
                $('#name').val(response.data.user.name);
                $('#title').val(response.data.title);
                $('#comment').val(response.data.comment);
                $('#logId').val(logid); // Set the case type ID in the hidden input
                $('.main-title').text('Update Log');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addNewLog').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteLog(logid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this log?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-client-logs/' + logid;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        logid: logid,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            getClientLogs();
                            toastr.success(data.message);
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

    function getClientLogs() {
        var clientId = $('#client_id').val();
        var client_case_information_id = $('#client_case_information_id').val();
        if (client_case_information_id) {
            var url = '/admin/logs/' + client_case_information_id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#client-logs-listing').html(response.client_logs);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    }

    /// client task operations

    /// show a modal for creation
    $('#client-task-btn').on('click', function() {
        $('#addNewTask').modal('show');
        $('#client-task-form')[0].reset();
        $('#taskId').val('');
        $('.main-title').text('Add New Task');
        $('.submit-btn').text('Submit');
    });

    /// add, update form

    $('#client-task-form').on('submit', function(e) {
        e.preventDefault();

        var taskId = $('#taskId').val();
        var url = taskId ? '/admin/client-tasks-update/' + taskId : '{{ route("admin.client-create-tasks") }}';
        var method = taskId ? 'PUT' : 'POST';

        var formData = $(this).serialize();
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content'); // Append CSRF token

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#addNewTask').modal('hide'); // Hide modal on success
                    $('#client-task-form')[0].reset();
                    $('.client_tasks').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/addPlacement'; // Redirect to the placements page
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });

    function editClientTask(taskId) {
        $.ajax({
            url: '/admin/client-tasks-edit/' + taskId,
            method: 'GET',

            success: function(response) {
                console.log(response);
                // Populate the form fields with the user data
                $('#details').val(response.data.details);
                $('#task_date').val(formatDateForInput(response.data.date));
                $('#task_time').val(formatTimeForInput(response.data.time));

                // Checkboxes for assigned users
                $('input[name="assign_task[]"]').each(function() {
                    const userId = $(this).val();
                    console.log(userId);
                    if (response.data.user_assigned && response.data.user_assigned.includes(parseInt(userId))) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });


                $('#taskId').val(taskId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Task');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addNewTask').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function formatDateForInput(date) {
        const [month, day, year] = date.split('/');
        console.log(`${month}/${day}/${year}`);
        return `${year}-${month}-${day}`;
    }

    function formatTimeForInput(time) {
        const [timePart, modifier] = time.split(' ');
        let [hours, minutes] = timePart.split(':');

        if (modifier === 'PM' && hours !== '12') {
            hours = parseInt(hours, 10) + 12;
        }
        if (modifier === 'AM' && hours === '12') {
            hours = '00';
        }

        return `${hours}:${minutes}`;
    }



    function deleteClientTask(taskId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this task?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-client-tasks/' + taskId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        taskId: taskId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.client_tasks').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
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

    function markClientTask(taskId)
    {
        $.ajax({
            url: '/admin/client-tasks-mark_status/' + taskId,
            method: 'GET',

            success: function(response) {
                $('.client_tasks').DataTable().ajax.reload(null, false);
                toastr.success(response.message);
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });

    }
    /// end client task operations

    //// client email operations

    /// show a modal for creation
    $('#client-email-btn').on('click', function() {
        $('#addNewEmail').modal('show');
        $('#client-email-form')[0].reset();
        $('#taskId').val('');
        $('.main-title').text('Create Email');
        $('.submit-btn').text('Send Email');
    });


    $(document).on("click", ".clientEmailTagList div", function() {
            var tag = $(this).html();
            insertQuillDataToCurserPosition(tag)
        });

    /// add, update form

    $('#client-email-form').on('submit', function(e) {
        e.preventDefault();

        var url = '{{ route("admin.client-create-emails") }}';
        var method = 'POST';

        var formData = new FormData(this);


        //formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Append CSRF token
            },
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#addNewEmail').modal('hide'); // Hide modal on success
                    $('#client-email-form')[0].reset();
                    $('.client_email').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/addPlacement'; // Redirect to the placements page
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });

    function viewClientEmail(emailid)
    {

        $.ajax({
            url: '/admin/client-emails-view/' + emailid,
            method: 'GET',

            success: function(response) {
                console.log(response.data.subject);
                // Populate the form fields with the user data

                $('#client_email_id').val(response.data.id);
                $('#client_email_subject').text(response.data.subject);
                $('#client_email_date_sent').text(convertDate(response.data.created_at));
                $('#client_email_last_resent').text(response.data.last_time_re_sent ? convertDate(response.data.last_time_re_sent)  : 'N/A');
                $('#client_email_times_resent').text(response.data.time_resent ? response.data.time_resent : 'N/A');
                $('#client_email_from').text(response.data.from);
                $('#client_email_sent_to').text(response.data.to);
                $('#client_email_body').text(response.data.body.replace(/<\/?[^>]+(>|$)/g, ""));

                let attachmentHTML = '';
                if (response.data.attachments && response.data.attachments.length > 0) {
                    response.data.attachments.forEach(function(attachment) {
                        attachmentHTML += `
                            <a href="${attachment.url}" download class="text_14_400 text_126C9B mb_6">
                                ${attachment.name}
                            </a><br>
                        `;
                    });
                } else {
                    attachmentHTML = '<p>No attachments found.</p>';
                }

            // Insert the attachments into the modal
            $('#client_email_attachments').html(attachmentHTML);


                $('#emailDetail').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    $('#resend-email-form').on('submit', function(e) {
        e.preventDefault();

        var url = '{{ route("admin.client-resend-emails") }}';
        var method = 'POST';

        var formData = new FormData(this);

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Append CSRF token
            },
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors); // Handle errors
                } else {
                    $('#emailDetail').modal('hide'); // Hide modal on success
                    // $('#client-email-form')[0].reset();
                    $('.client_email').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/addPlacement'; // Redirect to the placements page
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });

    function convertDate(created_at)
    {
        let createdAt = new Date(created_at);  // Convert to Date object
        return formattedDate = createdAt.getFullYear() + '-' +
        ('0' + (createdAt.getMonth() + 1)).slice(-2) + '-' +
        ('0' + createdAt.getDate()).slice(-2) + ' ' +
        ('0' + createdAt.getHours()).slice(-2) + ':' +
        ('0' + createdAt.getMinutes()).slice(-2) + ':' +
        ('0' + createdAt.getSeconds()).slice(-2);  // Format date
    }

    //// end client email operations






</script>


@endpush
