@push('scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script>
    var startDate = '';
    var endDate = '';
    $(document).ready(function() {
        var dateRange = $('.payments_daterange').val();
        if (dateRange.includes(' - ')) {

            var dates = dateRange.split(' - ');
            startDate = dates[0];
            endDate = dates[1];

        }
        $("#download-pdf").hide();
        var table = $('.payments_collected').DataTable({
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "searching": true,
            "pageLength": 10,

            ajax: {
                url: '{{ route('admin.getPaymentCollected') }}',
                type: 'GET',
                data: function(d) {

                    var dateRange = $('.payments_daterange').val();
                    if (dateRange) {
                        var dates = dateRange.split(' - '); // Split the date range into start and end date
                        d.start_date = dates[0];
                        d.end_date = dates[1];
                    }
                }
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {

                        return row.invoice_payments && row.invoice_payments.length>0 ? row.invoice_payments[0].payment_date : '';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const clientName = row.client ? row.client.primary_client_name : '';
                        return clientName;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (row.invoice_type === 'Contingency') {
                            return '$'+(row.total_fee ? parseFloat(row.total_fee).toFixed(2): '0.00');
                        } else {
                            return '$'+(row.attorney_fee ? parseFloat(row.attorney_fee).toFixed(2) : '0.00');
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {

                        return '$'+(row.filing_fee ? parseFloat(row.filing_fee).toFixed(2):'0.00');

                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {

                        return row.invoice_payments && row.invoice_payments.length>0 ? row.invoice_payments[0].payment_method : '';

                    }
                }
            ],

            footerCallback: function(row, data, start, end, display) {
                // Initialize total variables for each column
                if(data.length>0){

                    $("#download-pdf").show();
                }
                setTimeout(() => {
                    if(data){
                        var totalAttorneyFee = 0;
                        var totalFilingFee = 0;
                        var totalColumn3 = 0; // Adjust if needed

                        // Loop through data and calculate totals
                        data.forEach(function (rowData) {
                            if (rowData.invoice_type === 'Contingency') {
                                totalColumn3 += rowData.total_fee ? parseFloat(rowData.total_fee) : 0;
                            } else {
                                totalColumn3 += rowData.attorney_fee ? parseFloat(rowData.attorney_fee) : 0;
                            }
                            totalFilingFee += rowData.filing_fee ? parseFloat(rowData.filing_fee) : 0;
                        });

                        // Add custom row for totals
                        var totalRow = `
                            <tr class="total-row" >
                                <td style="background-color: #126C9B !important;"></td>
                                <td style="text-align: right;background-color: #126C9B !important; font-weight: medium;color:white">Totals :</td>
                                <td style="font-weight: medium;background-color: #126C9B !important;color:white;">$${totalColumn3.toFixed(2)}</td>
                                <td style="font-weight: medium;background-color: #126C9B !important;color:white;">$${totalFilingFee.toFixed(2)}</td>
                                 <td style="background-color: #126C9B !important;"></td>
                            </tr>
                        `;

                        // Append the totals row to the table footer
                        $('.payments_collected tfoot').html(totalRow);
                    }

                }, 200);

            }
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

        $('.dateRange').on('input', function() {
            // Get the value of the input (e.g., "02/21/2025 - 02/25/2025")
            var dateRange = $(this).val();

            // Check if the input value contains ' - ' to separate the dates
            if (dateRange.includes(' - ')) {
                // Split the date range into start and end dates
                var dates = dateRange.split(' - ');

                // Extract the start and end dates
                 startDate = dates[0];
                 endDate = dates[1];
                 table.ajax.reload();
                console.log("Start Date:", startDate);
                console.log("End Date:", endDate);
            } else {
                console.log("Invalid date range format.");
            }
        });
        $('.search_input_date').on('click', function() {
            console.log($('.dateRange').val())
            table.ajax.reload();
        });
    });



    document.getElementById('download-pdf').addEventListener('click', function() {
        // Target the table element
        var element = document.querySelector('.payments_collected');
        var start_date = '';
        var end_date = '';
        var dateRange = $('.payments_daterange').val();
        if (dateRange) {
            var dates = dateRange.split(' - '); // Split the date range into start and end date
            start_date = dates[0];
            end_date = dates[1];
        }


        // Create HTML to append to the top and bottom of the table
        var topHtml = `
            <div style="text-align: center; font-size: 18px; font-weight: bold;margin-top:20px;">
                {{ $controller_name }} from `+start_date+` to `+end_date+`
            </div>
            <br/>
            <div style="text-align: center; font-size: 14px; font-weight: medium;">
                <hr />
            </div>
            <br/>`;

        var bottomHtml = '';

        // Apply left and right margin to the element
        var modifiedElement = document.createElement('div');
        modifiedElement.innerHTML = topHtml + `
            <div style="margin-left: 30px; margin-right: 30px;">
                ${element.outerHTML}
            </div>` + bottomHtml;

        // Set up options for html2pdf
        var options = {
            filename: 'payments_collected.pdf', // Set the filename of the PDF
            jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }, // PDF page settings
            html2canvas: {
                scale: 4, // Increase the scale for higher resolution
                backgroundColor: '#ffffff', // Set white background
                logging: true, // Optional: for debugging
                letterRendering: true, // Improves font rendering
                useCORS: true, // Ensures the use of CORS for images
                onrendered: function(canvas) {
                    // Apply grayscale to the canvas
                    var ctx = canvas.getContext('2d');
                    ctx.globalCompositeOperation = 'saturation';
                    ctx.fillStyle = 'rgb(128, 128, 128)'; // Gray color for all content
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                }
            },

        };

        // Call the html2pdf.js library and generate the PDF
        html2pdf().from(modifiedElement).set(options).save();


    });


</script>

@endpush
