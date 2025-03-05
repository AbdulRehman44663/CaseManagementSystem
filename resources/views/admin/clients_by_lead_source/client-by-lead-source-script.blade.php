@push('scripts')
<script>
    $(document).ready(function() {
        console.log("DataTable Initialized Without API Call");

        var table = $('.report_payment_table').DataTable({
            "autoWidth": false,   
            "responsive": true,  
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,
            "data": [],  // No static data
            "columns": [ // Define columns even if empty
                { "title": "Client Name", "data": "name" },
                { "title": "Is Client Since", "data": "client_since" },
                { "title": "Service", "data": "service" },
               
            ]
             
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
</script>
@endpush
