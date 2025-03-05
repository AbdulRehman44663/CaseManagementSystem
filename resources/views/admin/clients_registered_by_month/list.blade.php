
            
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
        toolTip: { shared: true },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        dataPointWidth: 38,
        axisY: {
            interval: 2,
            titleFontSize: 20
        },
        data: []
    });

    function fetchChartData(startMonthYear, endMonthYear) {
        console.log(startMonthYear);
        console.log(endMonthYear);
        $.ajax({
            url: "{{ route('admin.total.lead.client.month') }}", 
            type: "GET",
            data: { startMonthYear: startMonthYear, endMonthYear: endMonthYear },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    updateChart(response.data);
                } else {
                    //alert("No data found for the selected date.");
                    updateChart([]);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function updateChart(data) {
        var clientsData = [];
        var leadsData = [];
        var maxYValue = 0;

        // Define month order for sorting
        const monthOrder = {
            "Jan": 1, "Feb": 2, "Mar": 3, "Apr": 4, "May": 5, "Jun": 6,
            "Jul": 7, "Aug": 8, "Sep": 9, "Oct": 10, "Nov": 11, "Dec": 12
        };

        // Sort data by month-year order
        data.sort((a, b) => {
            let [monthA, yearA] = a.label.split(" ");
            let [monthB, yearB] = b.label.split(" ");
            return yearA - yearB || monthOrder[monthA] - monthOrder[monthB];
        });

        // Process data for chart
        data.forEach(item => {
            let clients = parseInt(item.clients) || 0;
            let leads = parseInt(item.leads) || 0;
            let total = clients + leads;

            // Append total to the label
            let formattedLabel = `${item.label} (Total: ${total})`;

            clientsData.push({ label: formattedLabel, y: clients });
            leadsData.push({ label: formattedLabel, y: leads });

            maxYValue = Math.max(maxYValue, clients, leads);
        });

        // Set a dynamic Y-axis interval
        let interval = Math.ceil(maxYValue / 5) || 1;

        // Ensure `chart` is properly initialized
        if (typeof chart === 'undefined') {
            console.error("Chart instance is not defined.");
            return;
        }

        chart.options.axisY = { 
            minimum: 0, 
            interval: interval, 
            titleFontSize: 20 
        };

        chart.options.data = [
            {
                color: "#126C9B",
                type: "column",
                name: "Clients",
                legendText: "Clients",
                showInLegend: true, 
                dataPoints: clientsData 
            },
            {
                color: "#FCAF3B",
                type: "column",
                name: "Leads",
                legendText: "Leads",
                showInLegend: true,
                dataPoints: leadsData
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