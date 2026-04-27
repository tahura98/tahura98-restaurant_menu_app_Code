<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart</title>
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

    <h2>📊 Line Chart - Price Range</h2>

    <div class="chart-container">
        <canvas id="lineChart"></canvas>
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

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['name'];
        $data[] = $row['price'];
    }
    ?>

    <script>
        const lineData = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: "Price Range",
                data: <?php echo json_encode($data); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        };

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: lineData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

</body>
</html>
