<?php

include('../php/config.php');
session_start();

// Check if the farm ID is provided in the query parameters
if (isset($_GET['id'])) {
    $farm_id = $_GET['id'];

    // Query to retrieve farm information based on the ID
    $sql = "SELECT * FROM farm_info WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $farm_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $farm_name = $row['farm_name'];
    } else {
        echo "Farm not found.";
        exit;
    }

    $stmt->close();
}

// Check if the user has confirmed the deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Delete the farm record from the database
    $sql = "DELETE FROM farm_info WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $farm_id);

    if ($stmt->execute()) {
        // Farm data deleted successfully
        echo "<script>
                alert('Farm data deleted successfully.');
                window.location.href = 'index.php'; // Redirect to your index page
              </script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete Farm Information</title>
        <!-- Include Bootstrap CSS from CDN -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center">Delete Farm Information</h2>
                        </div>
                        <div class="card-body">
                            <p>Are you sure you want to delete the farm record for "<?php echo $farm_name; ?>"?</p>
                            <form action="delete_farm.php?id=<?php echo $farm_id; ?>" method="POST">
                                <button type="submit" class="btn btn-danger" name="confirm_delete">Confirm Delete</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>