@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.case_type').DataTable({
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getCaseType') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (row.custom === 'yes') {
                            return `<span class="text-muted">Non-Editable, Non-Deletable</span>`;
                        } else {
                            let deleteButton = row.client_cases_count > 0
                                ? `<span class="text-muted" style="padding:4px 9px;">N/A</span>`
                                : `<a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteCaseType(${row.id})">
                                    <img src="<?=url('')?>/assets/images/trash-grey.svg" alt="" width="10px"> Delete</a>`;

                            return `<div class="dropdown">
                                        <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editCaseType(${row.id})">
                                                    <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                                ${deleteButton}
                                            </li>
                                        </ul>
                                </div>`;
                        }
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
    $('#create-case-type-btn').on('click', function() {
        clearValidationError();
        $('#addCaseType').modal('show');
        $('#casetype-form')[0].reset();
        $('#caseTypeId').val('');
        $('.main-title').text('Add Case Type');
        $('.submit-btn').text('Submit');
    });

    /// create/update a casetype from based on caseTypeId
    $('#casetype-form').on('submit', function(e) {
        e.preventDefault();

        var caseTypeId = $('#caseTypeId').val(); // Check if we are updating or creating
        var url = caseTypeId ? '/admin/update-case-type/' + caseTypeId : '{{ route("admin.create.caseType") }}';  // Create URL

        var method = caseTypeId ? 'PUT' : 'POST';

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
                    $('#addCaseType').modal('hide');
                    $('#casetype-form')[0].reset();
                    $('.case_type').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                    //window.location.href = '/admin/caseTypeManagement';
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit
    function editCaseType(caseTypeId)
    {
        $.ajax({
            url: '/admin/edit-case-type/' + caseTypeId,
            method: 'GET',

            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#caseTypeId').val(caseTypeId); // Set the case type ID in the hidden input
                $('.main-title').text('Update Case Type');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addCaseType').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteCaseType(caseTypeId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this case type?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-case-type/' + caseTypeId;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        caseTypeId: caseTypeId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.case_type').DataTable().ajax.reload(null, false);
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
