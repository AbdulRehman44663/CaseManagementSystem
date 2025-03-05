@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.appointment_color').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getAppointmentColor') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="color_icon" style="background: ${row.color};"></div>`;
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
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editAppointmentColor(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteAppointmentColor(${row.id})">
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
    $('#appoinment-color-legend-btn').on('click', function() {
        clearValidationError();
        $('#addALengend').modal('show'); 
        $('#appointment-color-form')[0].reset();
        $('#appointmentId').val('');
        $('.main-title').text('Add Appointment Type');
        $('.submit-btn').text('Submit');
    });

   
    // Create or Update an Ad Placement based on adPlacementId
    $('#appointment-color-form').on('submit', function(e) {
        e.preventDefault();

        var appointmentId = $('#appointmentId').val(); 
        var url = appointmentId ? '/admin/update-appointment-color/' + appointmentId : '{{ route("admin.create.appointmentColor") }}';   
        var method = appointmentId ? 'PUT' : 'POST';   

        var formData = $(this).serialize(); 
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token

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
                    $('#addALengend').modal('hide'); // Hide modal on success
                    $('#appointment-color-form')[0].reset();
                    $('.appointment_color').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                toastr.error('Unable to handle request! Please try again.', 'Error');
                //displayCommonError(error)
            }
        });
    });
    
    // edit 
    function editAppointmentColor(appointmentId)
    {
        $.ajax({
            url: '/admin/edit-appointment-color/' + appointmentId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#color').val(response.data.color);
                $('#color_bg').css('background',response.data.color);
                $('#appointmentId').val(appointmentId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Appointment Type');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addALengend').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteAppointmentColor(appointmentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Legend Color",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-appointment-color/' + appointmentId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.appointment_color').DataTable().ajax.reload(null, false);
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