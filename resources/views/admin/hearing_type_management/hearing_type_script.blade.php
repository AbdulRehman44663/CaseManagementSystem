@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.hearing_type').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            
            ajax: {
                url: "{{ route('admin.getHearingTypes', (isset($case_type)?$case_type->id:'')) }}",
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
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editHearingType(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteHearingType(${row.id})">
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
    $('#create-hearing-type-btn').on('click', function() {
        clearValidationError();
        $('#addHearingTypes').modal('show'); 
        $('#hearingtype-form')[0].reset();
        $('#hearingTypeId').val('');
        $('.main-title').text('Add a new');
        $('.submit-btn').text('Submit');
    });

    /// create/update a HearingType from based on hearingTypeId
    $('#hearingtype-form').on('submit', function(e) {
        e.preventDefault();
        
        var hearingTypeId = $('#hearingTypeId').val(); // Check if we are updating or creating
        var url = hearingTypeId ? '/admin/updateHearingTypes/' + hearingTypeId : '{{ route("admin.create.hearingTypes") }}';  // Create URL

        var method = hearingTypeId ? 'PUT' : 'POST';
        
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
                    $('#addHearingTypes').modal('hide');
                    $('#hearingtype-form')[0].reset();
                    $('.hearing_type').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit 
    function editHearingType(hearingTypeId)
    {
        $.ajax({
            url: base_url+'/admin/editHearingTypes/' + hearingTypeId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name_desc').val(response.data.name);
                $('#color_name').val(response.data.color);
                $('#color_bg').css('background',response.data.color);
                $('#hearingTypeId').val(hearingTypeId); // Set the hearing type ID in the hidden input
                $('.main-title').text('Update');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addHearingTypes').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }
    

    // Delete 
    
    function deleteHearingType(hearingTypeId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this hearing type?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/deleteHearingTypes/' + hearingTypeId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        hearingTypeId: hearingTypeId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.hearing_type').DataTable().ajax.reload(null, false);
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