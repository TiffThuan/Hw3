<?php
$pageTitle = "Welcome to King Coffee Shop";
include "view-header.php"; // Navigation bar included here
?>
<div class="container mt-4">
    <!-- Introduction Section -->
    <div class="text-center">
        <h1>Welcome to Our King Coffee Shop!</h1>
        <p><em>One of the best Vietnamese coffee spots in Oklahoma</em></p>
        <p><em>Experience our signature coffee - Cafe Sua Da, coffee gourmet for everyone</em></p>
    </div>

    <!-- Stats Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title">$12,000</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Customers</div>
                <div class="card-body">
                    <h5 class="card-title">250</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Top Product</div>
                <div class="card-body">
                    <h5 class="card-title">Vietnamese Coffee</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Coffee Menu Section -->
<div class="mt-4">
    <h2 class="text-center" style="color: #6b3e26; font-weight: bold;">Our Coffee Menu</h2>
    <div class="table-responsive">
        <table class="table table-hover text-center" style="border: 2px solid #6b3e26; color: #333;">
            <thead style="background-color: #6b3e26; color: white;">
                <tr>
                    <th style="font-size: 1.2em;">Coffee</th>
                    <th style="font-size: 1.2em;">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 
                    <td>Cafe Sua Da (Iced Coffee with Condensed Milk)</td>
                    <td>$4.00</td>
                </tr>
                <tr>
                    
                    <td>Cafe Den Da (Iced Black Coffee)</td>
                    <td>$3.50</td>
                </tr>
                <tr>
                   
                    <td>Hot Coffee</td>
                    <td>$3.00</td>
                </tr>
                <tr>
                   
                    <td>Espresso</td>
                    <td>$2.50</td>
                </tr>
                <tr>
                  
                    <td>Cappuccino</td>
                    <td>$4.50</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Sales Chart Section -->
    <div class="mt-5">
        <h3 class="text-center">Monthly Sales Chart</h3>
        <div id="sales-chart" style="width: 100%; height: 300px;"></div>
    </div>
</div>

<!-- ECharts Script -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    var chart = echarts.init(document.getElementById('sales-chart'));
    chart.setOption({
        title: { text: 'Monthly Sales' },
        tooltip: {},
        xAxis: { data: ['Jan', 'Feb', 'Mar', 'Apr', 'May'] },
        yAxis: {},
        series: [{ type: 'bar', data: [1200, 1500, 1800, 2500, 3000] }]
    });
</script>

<?php
include "view-footer.php"; // Footer included here
?>
