<div class="container mt-5">
    <h1>Welcome to King Coffee Shop</h1>
    <p>Manage your business with ease. Explore orders, products, and customer reviews.</p>

    <!-- Stats Section -->
    <div class="row">
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

    <!-- Sales Chart -->
    <div id="sales-chart" style="width: 100%; height: 400px;"></div>
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
</div>
