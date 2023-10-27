<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agri_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if (isset($_POST['search'])) {
    $search_name = $_POST['name'];

    // Retrieve image data from the database based on the provided name
    $sql = "SELECT * FROM crop_img WHERE image_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $image_id = $row['id'];
            $image_name = $row['image_name'];
            $image_data = $row['image_data'];
            $image_type = $row['image_type']; // If you have an 'image_type' column

            // Display the image with Bootstrap styling or in any desired format
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<div class="card">';
            echo '<img class="card-img-top" src="data:' . $image_type . ';base64,' . base64_encode($image_data) . '" />';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $image_name . '</h5>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No images found for the provided name.";
    }

    $stmt->close();
}

$conn->close();
?>
