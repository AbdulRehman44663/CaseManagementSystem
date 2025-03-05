@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.e_document_table').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            ajax: {
                url: "{{ route('admin.getDocumentTemplateDatatable', (isset($case_type)?$case_type->id:'')) }}",
                type: 'GET',
            },
            columns: [
                { data: 'title' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="editDocumentTemplate(${row.id})">
                                            <img src="<?=url('')?>/assets/images/edit-pencile-grey.svg" alt="" width="10px"> Edit</a>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteDocumentTemplate(${row.id})">
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

        $(document).on("click", ".documentTemplateTagList div", function() {
            var tag = $(this).html();
            insertQuillDataToCurserPosition(tag)
        });

    });

    var quill = new Quill('#document_template_quill_editor', {
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
    $('#document-template-management').on('click', function() {
        $('#documentTemplateModal').modal('show'); 
        $('#e-document-template-form')[0].reset();
        $('#document_template_id').val('');
        $('.main-title').text('Add A Document Template');
        $('.submit-btn').text('Submit');
    });

   
    // Create or Update an Ad Placement based on adPlacementId
    $('#e-document-template-form').on('submit', function(e) {
        e.preventDefault();

        $('#document_body').val(quill.root.innerHTML);

        var documentTemplateId = $('#document_template_id').val(); 
        var url = documentTemplateId ? '/admin/update-docuemnt-template/' + documentTemplateId : '{{ route("admin.create.document.template") }}';   
        var method = documentTemplateId ? 'PUT' : 'POST';   

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
                    $('#documentTemplateModal').modal('hide'); // Hide modal on success
                    $('#e-document-template-form')[0].reset();
                    $('.e_document_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
            },
            error: function(error) {
                console.log("Error: ", error);
            }
        });
    });
    
    // edit 
    function editDocumentTemplate(documentTemplateId)
    {
        $.ajax({
            url: '/admin/edit-document-template/' + documentTemplateId,
            method: 'GET',
            
            success: function(response) {
                
                // Populate the form fields with the user data
                $('#template_name').val(response.data.title);
                $('#document_template_id').val(documentTemplateId);  
                setQuillData(response.data.body);
                $('.main-title').text('Update A Document Template');
                $('.submit-btn').text('Update');
                // Show the modal
                $('#documentTemplateModal').modal('show');
            },
            error: function(error) {
                console.log("error -->", error);
            }
        });
    }

    function deleteDocumentTemplate(documentTemplateId)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this document template?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url+'/admin/deleteDocumentTemplate/' + documentTemplateId,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('.e_document_table').DataTable().ajax.reload(null, false);
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
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