@push('scripts')
<script>
    $(document).ready(function() {
        fetchLeads();
        $('#saveLeadStatus').on('click', function () {
            const leadId = $('#leadModal').data('lead-id'); // Get the lead ID from the modal's data attribute
            const selectedStatus = $('#statusDropdown').val(); // Get the selected status

            if (!leadId || !selectedStatus) {
                alert("Please select a status to update.");
                return;
            }

            // Make an AJAX request to update the lead status
            $.ajax({
                url: `/admin/lead/update-status/${leadId}`,
                type: 'POST',
                data: {
                    status: selectedStatus,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                },
                success: function (response) {
                    toastr.success('Status updated successfully!');
                    // Optionally refresh the modal or update the UI
                    $('#leadModal').modal('hide');
                    fetchLeads();
                },
                error: function (xhr) {
                    console.error('Error updating status:', xhr);
                    alert('Failed to update the status. Please try again.');
                }
            });
        });

        let previousModal = '';
        let leadId = '';
        $(document).on('click', '#addLogButton', function () {
        $('#leadModal').modal('hide');
        $('#addLogModal').modal('show');
    });
    $('#addLogModal').on('hidden.bs.modal', function () {
        if (previousModal) {
            $(previousModal).modal('show');
        }
    });
    $(document).on('click', '#saveLogButton', function () {
        const clientId = leadId; // Ensure this variable is accessible from the earlier context
        const logText = $('#logText').val();

        if (!logText.trim()) {
            toastr.error('Log text cannot be empty');
            return;
        }

        $.ajax({
            url: '/admin/api/conversation-logs', // Endpoint to save the log
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                client_id: clientId,
                conversation: logText,
            },
            success: function () {
                toastr.success('Log saved successfully');
                $('#addLogModal').modal('hide');
                $('#logText').val(''); // Clear the text area
            },
            error: function () {
                toastr.error('Error saving log');
            },
        });
    });

    $(document).on('click', '.viewChangeStatusBtn', function () {
    const leadId = $(this).data('id'); // Get the lead ID from the button
    $('#viewChangeStatusModal').modal('show'); // Open the modal
    const previousModal = '#leadModal';
    // Fetch and populate existing data for this lead
    $.ajax({
        url: `/admin/api/leads/${leadId}`, // Replace with your endpoint
        method: 'GET',
        success: function (response) {
            const { lead, statuses, conversationLogs } = response;

            // Format created date
            const createdDate = lead.created_at
                ? new Date(lead.created_at).toLocaleDateString('en-US', {
                    month: '2-digit',
                    day: '2-digit',
                    year: 'numeric',
                })
                : 'N/A';

            // Set modal header
            $('#modalHeader').text(`Lead Information for ${lead.primary_client_name}`);

            // Populate lead details
            $('#leadDetails').html(`
                <p><strong>Address:</strong> ${lead.property_address || 'N/A'}</p>
                <p><strong>Phone Number:</strong> ${lead.telephone_number || 'N/A'}</p>
                <p><strong>Email:</strong> ${lead.email_address || 'N/A'}</p>
                <p><strong>Lead Assigned to:</strong> ${lead.assigned_to || 'N/A'}</p>
                <p><strong>Service:</strong> ${lead.client_case_info.case_type?.name || 'N/A'}</p>
                <p><strong>Amount:</strong> ${lead.amount_quoted || '$0.00'}</p>
                <p><strong>Client Added on:</strong> ${createdDate}</p>
                <button id="addLogButton" class="btn btn-primary btn-sm bg_126C9B">Add Log</button>
            `);

            // Populate the status dropdown
            const statusDropdown = $('#statusDropdown');
            statusDropdown.empty();
            statuses.forEach(status => {
                const selected = status.id === lead.lead_status_id ? 'selected' : '';
                statusDropdown.append(`<option value="${status.id}" ${selected}>${status.name}</option>`);
            });

            // Populate the conversation logs
            const conversationLogsContainer = $('#conversationLogsContainer');
            conversationLogsContainer.empty();
            if (conversationLogs && conversationLogs.length > 0) {
                conversationLogs.forEach(log => {
                    conversationLogsContainer.append(`
                        <div class="log-entry">
                            <p>${log.conversation}</p>
                        </div>
                    `);
                });
            } else {
                conversationLogsContainer.append('<p>No conversation logs available.</p>');
            }

            // Show the modal
            $('#leadModal').modal('show');
            $('#leadModal').attr('data-lead-id', leadId);
        },
        error: function () {
            toastr.error('Error fetching lead details');
        },
    });
});




function fetchLeads() {
    $.ajax({
        url: "{{ route('admin.leads.getAjax') }}", // Your endpoint to fetch leads
        method: 'GET',
        success: function(response) {
            const container = $('.leads_card_div');
            container.empty(); // Clear the current list of leads

            // Populate with updated data
            $.each(response, function(status, leads) {
                let card = `
                <div class="leads_card">
                    <div class="br_6 bg_126C9B cp_7 mb_12 d-flex justify-content-between">
                        <div class="text_16_500 text-white">${status} (${leads.length})</div>
                        <div>
                            <img src="/assets/images/xls-yellow.svg" alt="" width="24px">
                        </div>
                    </div>
                `;
                if (leads.length > 0) {
                    leads.forEach(function(lead) {

                        card += `
                        <div class="br_6 bg_F1F2F2 cp_7 mb_12">
                            <div class="text_14_700 text_404248 mb_17">${lead.primary_client_name}</div>
                            <div class="row mb_14">
                                <div class="col-md-5">
                                    <div class="text_12_400 text_404248">Service:</div>
                                </div>
                                <div class="col-md-7">
                                    <div class="text_12_400 text_404248">${lead.client_case_info.case_type.name || 'N/A'}</div>
                                </div>
                            </div>
                            <div class="row mb_14">
                                <div class="col-md-5">
                                    <div class="text_12_400 text_404248">Amount Quoted:</div>
                                </div>
                                <div class="col-md-7">
                                    <div class="text_12_400 text_404248">${lead.amount_quoted || '$0.00'}</div>
                                </div>
                            </div>
                            <div class="row mb_14">
                                <div class="col-md-5">
                                    <div class="text_12_400 text_404248">Follow-up:</div>
                                </div>
                                <div class="col-md-7">
                                    <div class="text_12_400 text_404248">${lead.follow_up || 'N/A'}</div>
                                </div>
                            </div>
                            <button
                                class="btn text_14_400 text-white br_6 bg_126C9B cp_1 viewChangeStatusBtn"
                                data-id="${lead.id}">
                                View/Change Status
                            </button>
                        </div>
                        `;
                    });
                } else {
                    card += `<div class="text_12_400 text-muted text-center">No leads available</div>`;
                }

                card += `</div>`;
                container.append(card);
            });
        },
        error: function() {
            toastr.error('Error fetching leads');
        }
    });
}

        var table = $('.my_table').DataTable({
            "autoWidth": false,
            "responsive": true,
            processing: false,

            ajax: {
                url: '{{ route('admin.getLeadsData') }}',
                type: 'GET',
                data: function(d) {
                    d.search = $('.table_search_input').val(); // Custom search input
                    var dateRange = $('.dateRange').val();
                    if (dateRange) {
                        var dates = dateRange.split(' - '); // Split the date range into start and end date
                        d.start_date = dates[0];
                        d.end_date = dates[1];
                    }
                }
            },

            ordering: false, // Disable sorting globally for all columns
            columns: [{
                    data: 'primary_client_name'
                },
                {
                    data: 'property_address'
                },
                {
                    data: 'telephone_number'
                },
                {
                    data: null,

                    render: function(data, type, row) {

                        const caseInfoId = row.client_case_info ? row.client_case_info.id : 'null';

                        return `
                            <button type="button" class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white"
                                    onclick="viewDetails(${row.id}, ${caseInfoId})">
                                View Details
                            </button>`;
                    }
                }
            ],

            pageLength: 10,
            initComplete: function() {
                // Add custom class to the search input
                $('.dataTables_filter input').addClass('table_search_input');
            }
        });

        $('.search_input_date').on('click', function() {
            console.log($('.dateRange').val())
            table.ajax.reload();
        });

        $('.select_list').on('change', function() {
            table.page.len($(this).val()).draw();
        });

        table.on('draw', function() {
            var pageInfo = table.page.info();
            $('.results_count').text(
                `Showing ${pageInfo.start + 1} to ${pageInfo.end} of ${pageInfo.recordsTotal} results`
            );
        });
    });


    $('#leadForm').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            primary_client_name: $('#primary_client_name').val(),
            property_address: $('#property_address').val(),
            telephone_number: $('#telephone_number').val(),
            alt_phone: $('#alt_phone').val(),
            email_address: $('#email_address').val(),
            drivers_license_no: $('#drivers_license_no').val(),
            ssn: $('#ssn').val(),
            date_of_birth: $('#date_of_birth').val(),
            marital_status: $('#marital_status').val(),
            other_notes: $('#other_notes').val(),
            secondary_client_name: $('#secondary_client_name').val(),
            secondary_telephone_number: $('#secondary_telephone_number').val(),
            secondary_email_address: $('#secondary_email_address').val(),
            secondary_drivers_license_no: $('#secondary_drivers_license_no').val(),
            secondary_ssn: $('#secondary_ssn').val(),
            secondary_date_of_birth: $('#secondary_date_of_birth').val(),
            case_type: $('#case_type').val(),
            hear_about_us: $('#hear_about_us').val(),
            city: $('#city').val(),
            area: $('#area').val(),
            case_notes: $('#primary_case_notes').val(),
            client_id: $('#client_id').val(),
        };

        $.ajax({
            url: '{{ route("admin.saveLead") }}',
            method: 'POST',
            data: formData,
            success: function(data) {
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                if (!data.success) {
                    if (data.errors) {
                        displayErrors(data.errors);
                    }
                    else {
                        toastr.error('Unable to handle request! Please try again.', 'Error');
                    }
                } else {
                    if (data && data.data && data.data.case_info_id) {
                        var client_case_info_id = data.data.case_info_id;
                        var client_id = data.data.client_id;
                        window.location.href = `/admin/clientInfo/${client_id}/${client_case_info_id}`;
                    } else {
                        window.location.href = '/admin/leads';
                    }
                }
            },
            error: function(error) {
                toastr.error('Unable to handle request! Please try again.', 'Error');
                //displayCommonError(error)
            }
        });
    });



    function viewDetails(id, clientCaseInfoId) {

        // Redirect to the detail page with the ID
        window.location.href = `/admin/clientInfo/${id}/${clientCaseInfoId}`;
    }


    function validateSSN(input) {
        let value = input.value.replace(/\D/g, ''); // Remove all non-numeric characters
        let formattedValue = '';

        if (value.length > 3) {
            formattedValue += value.substring(0, 3) + '-';
        } else {
            formattedValue = value;
        }
        if (value.length > 5) {
            formattedValue += value.substring(3, 5) + '-';
        } else if (value.length > 3) {
            formattedValue += value.substring(3);
        }
        if (value.length > 9) {
            formattedValue += value.substring(5, 9);
        } else if (value.length > 5) {
            formattedValue += value.substring(5);
        }

        input.value = formattedValue; // Set formatted value

        let ssnPattern = /^\d{3}-\d{2}-\d{4}$/;
        let errorDiv = document.getElementById("error_ssn");

        if (formattedValue.length === 11 && !ssnPattern.test(formattedValue)) {
            errorDiv.textContent = "SSN must be in the format XXX-XX-XXXX.";
            input.classList.add("is-invalid");
        } else {
            errorDiv.textContent = "";
            input.classList.remove("is-invalid");
        }
    }

    function validateSecondarySSN(input) {
        let value = input.value.replace(/\D/g, ''); // Remove all non-numeric characters
        let formattedValue = '';

        if (value.length > 3) {
            formattedValue += value.substring(0, 3) + '-';
        } else {
            formattedValue = value;
        }
        if (value.length > 5) {
            formattedValue += value.substring(3, 5) + '-';
        } else if (value.length > 3) {
            formattedValue += value.substring(3);
        }
        if (value.length > 9) {
            formattedValue += value.substring(5, 9);
        } else if (value.length > 5) {
            formattedValue += value.substring(5);
        }

        input.value = formattedValue; // Set formatted value

        let ssnPattern = /^\d{3}-\d{2}-\d{4}$/;
        let errorDiv = document.getElementById("error_secondary_ssn");

        if (formattedValue.length === 11 && !ssnPattern.test(formattedValue)) {
            errorDiv.textContent = "SSN must be in the format XXX-XX-XXXX.";
            input.classList.add("is-invalid");
        } else {
            errorDiv.textContent = "";
            input.classList.remove("is-invalid");
        }
    }




</script>
@endpush
