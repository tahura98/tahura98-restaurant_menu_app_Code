<?php
include 'db.php';

$edit_mode = false;
$edit_id = "";
$edit_name = "";
$edit_price = "";
$edit_origin = "";

if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];

    $sql = "SELECT * FROM food_menu WHERE id = $edit_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $edit_name = $row['name'];
    $edit_price = $row['price'];
    $edit_origin = $row['origin'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Menu Manager App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>🍔 Food Menu Manager 🍕</h2>

    <form method="POST" action="<?php echo $edit_mode ? 'update.php' : 'insert.php'; ?>">
        <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
        <input type="text" name="name" placeholder="Food Name" value="<?php echo $edit_name; ?>" required>
        <input type="number" step="0.01" name="price" placeholder="Price" value="<?php echo $edit_price; ?>" required>
        <input type="text" name="origin" placeholder="Country of Origin" value="<?php echo $edit_origin; ?>" required>
        <button type="submit"><?php echo $edit_mode ? 'Update' : 'Add'; ?></button>
    </form>

    

    <h3>📋 Current Abailable Menu</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Origin</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM food_menu ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['price']) . "</td>
                <td>" . htmlspecialchars($row['origin']) . "</td>
                <td>
                    <a href='index.php?edit=" . $row['id'] . "'>Update</a> |
                    <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Delete this item?');\">Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>

    <!-- One button for all charts -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="charts.php" class="view-charts-btn">📊 View All Charts</a>
    </div>


    
    <h2>📊 Food Menu Charts</h2>

    <!-- Buttons for each chart -->
    <a href="pie_chart.php" class="chart-btn">View Pie Chart</a>
    <a href="line_chart.php" class="chart-btn">View Line Chart</a>
    <a href="bar_chart.php" class="chart-btn">View Bar Chart</a>


</body>
</html>
