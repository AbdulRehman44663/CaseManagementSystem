
            
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
    <div id="chartContainer" style="height: 572px; width: 100%;"></div>
    
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>

    $(document).ready(function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        exportEnabled: true,
        animationEnabled: true,
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        dataPointWidth: 38,
        data: [],
        axisY: {
            interval: 2, 
            titleFontSize: 20
        }
    });

    function fetchChartData(startMonthYear, endMonthYear) {
        $.ajax({
            url: "{{ route('admin.total.client.month') }}",
            type: "GET",
            data: {
                startMonthYear: startMonthYear,
                endMonthYear: endMonthYear
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    updateChart(response.data);
                } else {
                    updateChart([]); // Call to hide the chart if no data is returned
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }
    
    // function updateChart(data) {
    //     var clientsData = [];
    //     var maxYValue = 0;

    //     // Check if no data exists
    //     if (data.length === 0) {
    //         chart.options.axisY = { 
    //             minimum: 0, 
    //             interval: 1, // Default interval when no data
    //             titleFontSize: 20
    //         };

    //         chart.options.data = [
    //             {
    //                 color: "#126C9B",
    //                 type: "column",
    //                 name: "New Clients",
    //                 showInLegend: true,
    //                 yValueFormatString: "#,##0.#",
    //                 dataPoints: clientsData
    //             }
    //         ];
    //         chart.render();
    //         return;  
    //     }

    //     // Process data if available
    //     data.forEach(item => {
    //         let clients = parseInt(item.new_clients) || 0;
    //         clientsData.push({ label: item.label, y: clients });

    //         // Track the maximum Y value
    //         maxYValue = Math.max(maxYValue, clients);
    //     });

    //     // Set a dynamic Y-axis interval (divide max value into 5 steps)
    //     let interval = Math.ceil(maxYValue / 5) || 1; // Ensure minimum interval is 1

    //     // Update chart with actual data
    //     chart.options.axisY = { 
    //         minimum: 0, 
    //         interval: interval, 
    //         titleFontSize: 20
    //     };

    //     chart.options.data = [
    //         {
    //             color: "#126C9B",
    //             type: "column",
    //             name: "New Clients",
    //             showInLegend: true,
    //             yValueFormatString: "#,##0.#",
    //             dataPoints: clientsData
    //         }
    //     ];

    //     chart.render();
    // }
    function updateChart(data) {
        var clientsData = [];
        var totalClients = 0; // Track total clients count
        var maxYValue = 0;

        // Check if no data exists
        if (data.length === 0) {
            chart.options.axisY = { 
                minimum: 0, 
                interval: 1, // Default interval when no data
                titleFontSize: 20
            };

            chart.options.data = [
                {
                    color: "#126C9B",
                    type: "column",
                    name: "New Clients",
                    showInLegend: true,
                    yValueFormatString: "#,##0.#",
                    dataPoints: clientsData
                }
            ];
            chart.render();
            return;  
        }

        // Process data if available
        data.forEach(item => {
            let clients = parseInt(item.new_clients) || 0;
            totalClients += clients; // Accumulate total clients count

            // Append total to the label
            let labelWithTotal = `${item.label} (Total: ${clients})`;
            clientsData.push({ label: labelWithTotal, y: clients });

            // Track the maximum Y value
            maxYValue = Math.max(maxYValue, clients);
        });

        // Set a dynamic Y-axis interval (divide max value into 5 steps)
        let interval = Math.ceil(maxYValue / 5) || 1; // Ensure minimum interval is 1

        // Update chart with actual data
        chart.options.axisY = { 
            minimum: 0, 
            interval: interval, 
            titleFontSize: 20
        };

        chart.options.data = [
            {
                color: "#126C9B",
                type: "column",
                name: `New Clients`, // Show total in legend
                showInLegend: true,
                yValueFormatString: "#,##0.#",
                dataPoints: clientsData
            }
        ];

        chart.render();
    }


    


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
@endsection('content')