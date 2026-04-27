<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        /* Make it more responsive on smaller screens */
        @media (max-width: 600px) {
            .chart-container {
                width: 95%;
            }
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .chart-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            margin: 10px;
        }

        .chart-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h2>📊 Bar Chart - Food Item Prices</h2>

    <div class="chart-container">
        <canvas id="barChart"></canvas>
    </div>

    <div class="btn-container">
        <a href="index.php">
            <button class="chart-btn">Back to Main Menu</button>
        </a>
    </div>

    <?php
    include 'db.php';
    $sql = "SELECT name, price FROM food_menu";
    $result = $conn->query($sql);

    $labels = [];
    $data = [];
    $colors = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['name'];
        $data[] = $row['price'];
        $colors[] = "#" . dechex(rand(0x000000, 0xFFFFFF));  // Random color for each bar
    }
    ?>

    <script>
        const barData = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: "Food Prices",
                data: <?php echo json_encode($data); ?>,
                backgroundColor: <?php echo json_encode($colors); ?>,
                borderColor: 'rgba(0, 0, 0, 0.1)',
                borderWidth: 1
            }]
        };

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

</body>
</html>
