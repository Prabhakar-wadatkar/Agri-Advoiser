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

// Check if a file was uploaded
if (isset($_FILES["image"])) {
    $image_name = $_FILES["image"]["name"];
    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    $image_type = $_FILES["image"]["type"];

    // Insert the image into the database
    $sql = "INSERT INTO crop_img (image_name, image_data, image_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $image_name, $image_data, $image_type);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
