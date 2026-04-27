<?php
include 'db.php';

// Fetch food data
$sql = "SELECT * FROM food_menu";
$result = $conn->query($sql);

$names = [];
$prices = [];
$origins = [];

while ($row = $result->fetch_assoc()) {
    $names[] = $row['name'];
    $prices[] = $row['price'];
    $origins[] = $row['origin'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2 style="text-align:center;">📊 Food Menu Visualizations</h2>
    <div style="text-align:center;">
        <a href="index.php">← Back to Food Menu</a>
    </div>

    <!-- Pie Chart -->
    <h3>Pie Chart: Food Origin Distribution</h3>
    <canvas id="pieChart"></canvas>

    <!-- Bar Chart -->
    <h3>Bar Chart: Food Name vs Price</h3>
    <canvas id="barChart" style="margin-top: 40px;"></canvas>

    <!-- Line Chart -->
    <h3>Line Chart: Price Range of Food</h3>
    <canvas id="lineChart" style="margin-top: 40px;"></canvas>

    <script>
        const names = <?php echo json_encode($names); ?>;
        const prices = <?php echo json_encode($prices); ?>;
        const origins = <?php echo json_encode($origins); ?>;

        // Generate dynamic colors for pie chart
        const generateColor = () => {
            return 'hsl(' + Math.random() * 360 + ', 100%, 50%)'; // Random HSL color
        };

        // Pie Chart (Origin distribution)
        const originCounts = {};
        origins.forEach(origin => {
            originCounts[origin] = (originCounts[origin] || 0) + 1;
        });

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(originCounts),
                datasets: [{
                    label: 'Number of Items per Country',
                    data: Object.values(originCounts),
                    backgroundColor: Object.keys(originCounts).map(() => generateColor())
                }]
            }
        });

        // Bar Chart (Prices of food items)
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: names,
                datasets: [{
                    label: 'Price in $',
                    data: prices,
                    backgroundColor: '#36a2eb'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Line Chart (Prices trend across items)
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: names,
                datasets: [{
                    label: 'Price Trend',
                    data: prices,
                    borderColor: '#ff6384',
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
