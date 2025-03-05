@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.attorney_management').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            
            ajax: {
                url: '{{ route('admin.getAttorneyManagement') }}',
                type: 'GET',
            },
            columns: [
                { data: 'attorney_name' },
                { data: 'address' },
                {
                    data: null,
                     
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editAttorneyManagement(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteAttorneyManagement(${row.id})">
                                            <img src="<?=url('')?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete</a>
                                    </li>
                                </ul>
                            </div>`;
                    }
                }
            ],
        });

        // Custom page length
        $('.select_list').on('change', function() {
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
    $('#create-attorney-management-btn').on('click', function() {
        clearValidationError();
        $('#attorneyManagementModal').modal('show'); 
        $('#attorney-management-form')[0].reset();
        $('#attorneyId').val('');
        $('.main-title').text('Add Attorney');
        $('.submit-btn').text('Submit');
    });

    /// create/update a casetype from based on attorneyId
    $('#attorney-management-form').on('submit', function(e) {
        e.preventDefault();
        
        var attorneyId = $('#attorneyId').val(); // Check if we are updating or creating
        var url = attorneyId ? '/admin/update-attorney-management/' + attorneyId : '{{ route("admin.create.attorneyManagement") }}';  // Create URL

        var method = attorneyId ? 'PUT' : 'POST';
        
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
                    $('#attorneyManagementModal').modal('hide');
                    $('#attorney-management-form')[0].reset();
                    $('.attorney_management').DataTable().ajax.reload(null, false);
                    //window.location.href = '/admin/caseTypeManagement';
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit 
    function editAttorneyManagement(attorneyId)
    {
        $.ajax({
            url: '/admin/edit-attorney-management/' + attorneyId,
            method: 'GET',
            
            success: function(response) {

                clearValidationError();
               
                // Populate the form fields with the user data
                $('#attorney_name').val(response.data.attorney_name);
                $('#address').val(response.data.address);
                $('#suite').val(response.data.suite);
                $('#state').val(response.data.state);
                $('#zip_code').val(response.data.zip_code);
                $('#phone_number').val(response.data.phone_number);
                $('#email').val(response.data.email);

                $('#attorneyId').val(attorneyId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Attorney');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#attorneyManagementModal').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteAttorneyManagement(attorneyId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this attorney?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-attorney-management/' + attorneyId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        attorneyId: attorneyId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.attorney_management').DataTable().ajax.reload(null, false);
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
    
 
</script>
    
@endpush