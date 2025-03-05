
            
@extends('admin.layout.dashboard')
@section('content')           
    <div class="text_24_700 ff_dm_sans text_126C9B mb_24">{{$controller_name}}</div>
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center gap-3 mb-4">
            <label for="startMonth" class="text_16_500">Search from:</label>
            <input type="month" id="startMonth" class="form-control w-auto px-3 py-2">
        
            <label for="endMonth" class="text_16_500">To:</label>
            <input type="month" id="endMonth" class="form-control w-auto px-3 py-2">
        
            <button id="searchBtn" class="btn text-white bg_126C9B px-4 py-2 rounded">Search</button>
        </div>
    </div>
    <div id="chartContainer" style="height: 572px; width: 100%;" class="mb_24"></div>
    <div class="my_table_div ">
        <div class="cp_2">
            <div class="text_20_700 ff_dm_sans text_404248">Payments Collected</div>
        </div>
        <div class="table-responsive">
            <table class="table my_table mb-0 report_payment_table">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Is Client Since</th>
                        <th>Services</th>
                         
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>

$(document).ready(function () {
    // Initialize the chart
    var chart = new CanvasJS.Chart("chartContainer", {
        exportEnabled: true,
        animationEnabled: true,
        axisY: {
            interval: 5,
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries,
        },
        dataPointWidth: 35, // Adjust bar width for spacing
        toolTip: {
            shared: true,
        },
        data: [] // Placeholder for dynamic data
    });

    // Fetch chart data from the server based on the date range
    function fetchChartData(startMonthYear, endMonthYear) {
        $.ajax({
            url: "{{ route('admin.client.lead.source') }}",
            type: "GET",
            data: {
                startMonthYear: startMonthYear,
                endMonthYear: endMonthYear
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    updateChart(response.data);
                } else {
                    updateChart([]);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            },
        });
    }

    // Update the chart with the fetched data
     
    function updateChart(data) {
        let leadSources = {};  
        let months = new Set();
        let monthTotals = {};  // Stores total records per month
        let maxYValue = 0;

        // Process API response data
        data.forEach(item => {
            let sourceName = item.name; 
            leadSources[sourceName] = {};  

            item.dataPoints.forEach(point => {
                let monthYear = point.label;
                let count = point.y;

                leadSources[sourceName][monthYear] = count;
                months.add(monthYear);
                monthTotals[monthYear] = (monthTotals[monthYear] || 0) + count;  // Sum per month
                maxYValue = Math.max(maxYValue, count);
            });
        });

        // Sort months in ascending order
        let sortedMonths = Array.from(months).sort((a, b) => new Date(a) - new Date(b));
        let chartData = [];

        // Process each lead source
        Object.keys(leadSources).forEach(source => {
            let dataPoints = sortedMonths.map(month => {
                let count = leadSources[source][month] || 0;
                return {
                    label: `${month} (Total: ${monthTotals[month] || 0})`,  // Show total per month
                    y: count,
                };
            });

            // Ensure legends are always displayed even if no data
            chartData.push({
                type: "column",
                name: source,  // Keep only the source name in the legend
                showInLegend: true,
                dataPoints: dataPoints.length > 0 ? dataPoints : [{ label: "No Data", y: 0 }],
            });
        });


        // Set dynamic Y-axis interval (dividing max into 5 steps)
        let interval = Math.ceil(maxYValue / 5) || 1;

        chart.options.legend = {
            verticalAlign: "top",   // Moves legend to the top
            horizontalAlign: "center", // Centers legend horizontally
            fontSize: 14,
            itemclick: toggleDataSeries  // Enable clicking on legend items
        };

        // Update and render chart
        chart.options.axisY = { 
            minimum: 0, 
            interval: interval, 
            titleFontSize: 20
        };

        chart.options.data = chartData;
        chart.render();
    }
    
 


    // Toggle visibility of data series when clicked in legend
    
    
    function toggleDataSeries(e) {
        if (typeof e.dataSeries.visible === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }

    function getFormattedMonth(offset) {
        let date = new Date();
        date.setMonth(date.getMonth() + offset); 
        let year = date.getFullYear();
        let month = (date.getMonth() + 1).toString().padStart(2, '0');  
        return `${year}-${month}`;
    }

    // Set default values
    document.getElementById("startMonth").value = getFormattedMonth(-5);  
    document.getElementById("endMonth").value = getFormattedMonth(0);  

    var startMonthYear = $("#startMonth").val();  
    var endMonthYear = $("#endMonth").val();  
    fetchChartData(startMonthYear, endMonthYear);

    $("#searchBtn").on("click", function() {
        var startMonthYear = $("#startMonth").val();  
        var endMonthYear = $("#endMonth").val();  

        if (startMonthYear && endMonthYear) {
            fetchChartData(startMonthYear, endMonthYear);
        } else {
            alert("Please select both start and end month.");
        }
    });
});

</script>
    @include('admin.'.$controller.'.modals')
    @include('admin.clients_by_lead_source.client-by-lead-source-script') 
@endsection('content')