@push('scripts')
<script>
    $(document).ready(function() {
        console.log("here");
        var table = $('.dashboard_tasks').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getDashboardTask') }}',
                type: 'GET',
            },
            columns: [
                {data: 'created_by'},
                {data: 'assigned_to'},
                { 
                    data: 'client_name',
                    render: function(data, type, row) {
                        return `<a href="/admin/clientInfo/${row.client_id}/${row.client_case_information_id}" target="_blank" style="color: #0291d4 !important;">${data}</a>`;
                    }
                },
                { data: 'date_time' },
                { data: 'details' },
                {
                    data: 'clock',
                    render: function(data, type, row) {
                        let clockImage = data === 'yes' 
                            ? '<img src="<?= url('') ?>/assets/images/clock-grey.svg" alt="On Time" width="24px">' 
                            : '';
                        return clockImage;
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
 
 

    
 
</script>
    
@endpush