@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.appontment_location').DataTable({
           "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getAppontmentLocations') }}',
                type: 'GET',
            },
            columns: [
                { data: 'location' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editAppontmentLocation(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteAppontmentLocation(${row.id})">
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
    $('#create-appontment-locations-btn').on('click', function() {
        clearValidationError();
        $('#addAppontmentLocation').modal('show'); 
        $('#create-appontmentlocation-form')[0].reset();
        $('#appontmentLocationId').val('');
        $('.main-title').text('Add Appontment Location');
        $('.submit-btn').text('Submit');
    });

    /// create/update a AppontmentLocation from based on appontmentLocationId
    $('#create-appontmentlocation-form').on('submit', function(e) {
        e.preventDefault();
        
        var appontmentLocationId = $('#appontmentLocationId').val(); // Check if we are updating or creating
        var url = appontmentLocationId ? '/admin/update-appontment-locations/' + appontmentLocationId : '{{ route("admin.create.appontmentLocations") }}';  // Create URL

        var method = appontmentLocationId ? 'PUT' : 'POST';
        
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
                    $('#addAppontmentLocation').modal('hide');
                    $('#create-appontmentlocation-form')[0].reset();
                    window.location.href = '/admin/appontmentLocations';
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit 
    function editAppontmentLocation(appontmentLocationId)
    {
        $.ajax({
            url: '/admin/edit-appontment-locations/' + appontmentLocationId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#address').val(response.data.address);
                $('#suite').val(response.data.suite);
                $('#city').val(response.data.city);
                $('#state').val(response.data.state);
                $('#zip_code').val(response.data.zip_code);
                $('#appontmentLocationId').val(appontmentLocationId); // Set the Appontment Location ID in the hidden input
                $('.main-title').text('Update Appontment Location');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addAppontmentLocation').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }
    

    // Delete 
     
    function deleteAppontmentLocation(appontmentLocationId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this location?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-appontment-locations/' + appontmentLocationId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        appontmentLocationId: appontmentLocationId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.appontment_location').DataTable().ajax.reload(null, false);
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