<?php

// Database connection code (include your config here)
include('../php/config.php');

// Create Farm
if (isset($_POST['create'])) {
    $farm_name = $_POST['farm_name'];
    $location = $_POST['location'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];

    $sql = "INSERT INTO farms (farm_name, location, area, soil_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $farm_name, $location, $area, $soil_type);

    if ($stmt->execute()) {
        echo "Farm created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Read Farms (Display in a table)
if (isset($_GET['read'])) {
    $sql = "SELECT * FROM farms";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate HTML table to display farms
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Farm Name</th><th>Location</th><th>Area</th><th>Soil Type</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['farm_name'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['area'] . "</td>";
            echo "<td>" . $row['soil_type'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No farms found.";
    }
}

// Update Farm (You can add this part)

// Close the database connection
$conn->close();
?>