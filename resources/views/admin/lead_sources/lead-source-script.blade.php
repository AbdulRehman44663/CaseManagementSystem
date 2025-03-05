@push('scripts')
<script>

    $(document).ready(function() {
        var table = $('.lead_source').DataTable({
           "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
             
            ajax: {
                url: '{{ route('admin.getLeadSources') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                {data: 'client_leads_count'},
                 
                {
                    data: null,
                    render: function(data, type, row) {
                        // Build the Edit button (always shown)
                        var editBtn = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editLeadSources(${row.id})">
                                        <img src="<?= url('') ?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit
                                    </a>`;
                        
                        // Build the Delete button only if client_leads_count is not greater than 0
                        var deleteBtn = '';
                        if (row.client_leads_count <= 0) {
                            deleteBtn = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteLeadSources(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete
                                        </a>`;
                        }
                        
                        return `<div class="dropdown">
                                    <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            ${editBtn}
                                            ${deleteBtn}
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
    
    /// show a modal
    $('#create-lead-source-btn').on('click', function() {
        clearValidationError();
        $('#addLeadSource').modal('show'); 
        $('#lead-sources-form')[0].reset();
        $('.main-title').text('Add Lead Sources');
        $('.submit-btn').text('Submit');
    });

    /// create a case type form
    $('#lead-sources-form').on('submit', function(e) {
        e.preventDefault();

        var leadSourcesId = $('#leadSourcesId').val(); // Check if we are updating or creating
        var url = leadSourcesId ? '/admin/update-lead-sources/' + leadSourcesId : '{{ route("admin.create.leadSources") }}';  // Create URL

        var method = leadSourcesId ? 'PUT' : 'POST';
        
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
                    
                    $('#addLeadSource').modal('hide');
                    $('#lead-sources-form')[0].reset();
                    $('.lead_source').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/leadSources';
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit 
    function editLeadSources(leadSourcesId)
    {
        $.ajax({
            url: '/admin/edit-lead-sources/' + leadSourcesId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#leadSourcesId').val(leadSourcesId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Lead Sources');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addLeadSource').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteLeadSources(leadSourcesId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you want to delete this lead source",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-lead-sources/' + leadSourcesId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.lead_source').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        toastr.error('Unable to handle request! Please try again.', 'Error');
                        //errorMessage.text('An error occurred. Please try again.');
                    }
                });
            }
        });
    }

</script>
@endpush