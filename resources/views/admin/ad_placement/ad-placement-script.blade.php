@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.ad_placement').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            ajax: {
                url: '{{ route('admin.getADPlacement') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                { data: 'client_ad_placement_count' },
                {
                    data: null,
                    render: function(data, type, row) {
                        // Always show the Edit button
                        var editBtn = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editADPlacement(${row.id})">
                                            <img src="<?= url('') ?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit
                                        </a>`;

                        // Only show the Delete button if client_ad_placement_count is 0 or less
                        var deleteBtn = '';
                        if (row.client_ad_placement_count <= 0) {
                            deleteBtn = `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteADPlacement(${row.id})">
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

    /// show a modal for creation
    $('#create-ad-placement-btn').on('click', function() {
        clearValidationError();
        $('#addNewArea').modal('show'); 
        $('#ad-placement-form')[0].reset();
        $('#adPlacementId').val('');
        $('.main-title').text('Add New Area to Catalogue');
        $('.submit-btn').text('Submit');
    });

   
    // Create or Update an Ad Placement based on adPlacementId
    $('#ad-placement-form').on('submit', function(e) {
        e.preventDefault();

        var adPlacementId = $('#adPlacementId').val(); 
        var url = adPlacementId ? '/admin/update-ad-placement/' + adPlacementId : '{{ route("admin.create.adPlacement") }}';   
        var method = adPlacementId ? 'PUT' : 'POST';   

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
                    $('#addNewArea').modal('hide'); // Hide modal on success
                    $('#ad-placement-form')[0].reset();
                    $('.ad_placement').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/addPlacement'; // Redirect to the placements page
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });
    
    // edit 
    function editADPlacement(adPlacementId)
    {
        $.ajax({
            url: '/admin/edit-ad-placement/' + adPlacementId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#adPlacementId').val(adPlacementId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Area to Catalogue');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addNewArea').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteADPlacement(adPlacementId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this ad placement?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, convert it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-ad-placement/' + adPlacementId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.ad_placement').DataTable().ajax.reload(null, false);
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