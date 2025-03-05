@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('.delete_client').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getClients') }}',
                type: 'GET',
                data: function(d) {
                    d.search_client = $('.search_client').val();
                }
            },
            columns: [
                { data: 'primary_client_name'},
                {data: 'email_address'},
                {data: 'telephone_number'},
                 
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="dropdown">
                                <button class="text_14_500 ff_dm_sans bg_FCAF3B br_6 cp_8 mybtn text-white mybtndropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item text_12_400 text_6A6A6A" data-bs-toggle="modal" href="javascript:void(0);" role="button" onclick="deleteClient(${row.id})">
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

        $('.search_client_btn').on('click', function() {
            table.ajax.reload();
        });

        $('.search_client').on('keyup', function() {
            if ($(this).val() === '') {
                table.ajax.reload();
            }
        });


        // Custom pagination info
        table.on('draw', function() {
            var pageInfo = table.page.info();
            $('.results_count').text(
                `Showing ${pageInfo.start + 1} to ${pageInfo.end} of ${pageInfo.recordsTotal} results`
            );
        });
    });

    function deleteClient(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to delete this client?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '/admin/delete-client/' + id;
                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data) {
                        if (data.success) {
                            $('.delete_client').DataTable().ajax.reload(null, false);
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