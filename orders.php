<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Menu Contribution";
include 'view-header.php';

// Fetch menu data logic (replace these values with real data fetched from the database)
$menuData = [
    ['name' => 'Cafe Sua Da', 'value' => 35],
    ['name' => 'Cafe Den Da', 'value' => 30],
    ['name' => 'Hot Coffee', 'value' => 20],
    ['name' => 'Espresso', 'value' => 10],
    ['name' => 'Cappuccino', 'value' => 5],
];
?>

<div class="container mt-5">
    <h1 class="text-center">Menu Contribution</h1>

    <!-- Chart Section -->
    <div id="menu-chart" style="width: 100%; height: 400px;"></div>
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script>
        var chart = echarts.init(document.getElementById('menu-chart'));
        chart.setOption({
            title: { text: 'Menu Contribution', left: 'center' },
            tooltip: { trigger: 'item' },
            series: [
                {
                    name: 'Menu Items',
                    type: 'pie',
                    radius: '50%',
                    data: <?php echo json_encode($menuData); ?>,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)',
                        },
                    },
                },
            ],
        });
    </script>
</div>

<?php include 'view-footer.php'; ?>
