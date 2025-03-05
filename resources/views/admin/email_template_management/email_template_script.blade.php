@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.email_templates').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            ajax: {
                url: "{{ route('admin.getEmailTemplate', (isset($case_type)?$case_type->id:'')) }}",
                type: 'GET',
            },
            columns: [
                { data: 'name' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" href="javascript:void(0);" onclick="editEmailTemplate(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" href="javascript:void(0);" onclick="deleteEmailTemplate(${row.id})">
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
        
        $(document).on("click", ".emailTemplateTagList div", function() {
            var tag = $(this).html();
            insertQuillDataToCurserPosition(tag)
        });

    });

    var quill = new Quill('#quilleditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ font: [] }, { size: [] }],  // Font and size
                [{ align: [] }],  // Alignment
                ['bold', 'italic', 'underline', 'strike'],  // Text styling
                [{ color: [] }, { background: [] }],  // Text color & background
                [{ script: 'sub' }, { script: 'super' }],  // Subscript / Superscript
                [{ list: 'ordered' }, { list: 'bullet' }],  // Ordered & bullet lists
                [{ indent: '-1' }, { indent: '+1' }],  // Indentation
                ['blockquote', 'code-block'],  // Blockquote & code block
                ['link', 'image', 'video'],  // Media embedding
                ['clean']  // Remove formatting
            ]
        }
    });

    /// show a modal for creation
    $('#create-email-template-btn').on('click', function() {
        clearValidationError();
        $('#addEmailTemplate').modal('show'); 
        $('#email-template-form')[0].reset();
        clearEditorContent();
        $('#emailTempalteId').val('');
        $('.main-title').text('Create');
        $('.submit-btn').text('Submit');
    });

    /// create/update a Email Template from based on emailTempalteId
    $('#email-template-form').on('submit', function(e) {
        e.preventDefault();

        $('#email_body').val(quill.root.innerHTML);
        
        var emailTempalteId = $('#emailTempalteId').val(); // Check if we are updating or creating
        var url = emailTempalteId ? '/admin/updateEmailTemplate/' + emailTempalteId : '{{ route("admin.create.emailTemplate") }}';  // Create URL

        var method = emailTempalteId ? 'PUT' : 'POST';
        
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
                    $('#addEmailTemplate').modal('hide');
                    $('#email-template-form')[0].reset();
                    clearEditorContent();
                    $('.email_templates').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // edit 
    function editEmailTemplate(emailTempalteId)
    {
        $.ajax({
            url: base_url+'/admin/editEmailTemplate/' + emailTempalteId,
            method: 'GET',
            
            success: function(response) {
                clearValidationError();
                // Populate the form fields with the user data
                $('#name').val(response.data.name);
                $('#subject').val(response.data.subject);
                setQuillData(response.data.body);
                $('#emailTempalteId').val(emailTempalteId); // Set the Email Template ID in the hidden input
                $('.main-title').text('Update');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#addEmailTemplate').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }
    

    // Delete 
    function deleteEmailTemplate(emailTempalteId)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this email template?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url+'/admin/deleteEmailTemplate/' + emailTempalteId,
                    method: 'GET',
                    success: function(response) {
                        $('.email_templates').DataTable().ajax.reload(null, false);
                    },
                    error: function(error) {
                        console.log("error -->", error);
                    }
                });
            }
        });
    }
 
</script>
    
@endpush