<?php
    include('../php/config.php');
    session_start();

if (!isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}
           
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!----======== CSS ======== -->

        <link rel="stylesheet" href="style.css">

        <!----===== Iconscout CSS ===== -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <title>Agri Dashboard Panel</title>
    </head>
    <body>
        <nav>
            <div class="logo-name">
                <img
                    src="../img/logo.png"
                    alt="Agri Advisor Logo"
                    style="max-height: 60px; padding-bottam: 5px; ">
            </div>

            <div class="menu-items">
                <ul class="nav-links">
                    <li>
                        <a href="index.php">
                            <i class="uil uil-estate"></i>
                            <span class="link-name">Dahsboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="weather.php">
                            <i class="uil uil-cloud-sun"></i>
                            <span class="link-name">Weather</span>
                        </a>
                    </li>
                    <li>
                        <a href="farms.php">
                            <i class="uil uil-files-landscapes"></i>
                            <span class="link-name">Farms</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_farms.php">
                            <i class="uil uil-file-plus-alt"></i>
                            <span class="link-name">Add Farm</span>
                        </a>
                    </li>
                    <li>
                        <a href="crops.php">
                            <i class="uil uil-pagelines"></i>
                            <span class="link-name">Crops Rec</span>
                        </a>
                    </li>
                    <li>
                        <a href="fertilizer.php">
                            <i class="uil uil-chart"></i>
                            <span class="link-name">Fertilizer info</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_profile.php">
                            <i class="uil uil-user"></i>
                            <span class="link-name">User Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="submit_testimonial.php">
                            <i class="uil uil-feedback"></i>
                            <span class="link-name">Feedback US</span>
                        </a>
                    </li>
                </ul>

                <ul class="logout-mode">

                    <li>
                        <a href="../php/logout.php" class="link-name">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span></a>

                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <div></div>
            <!-- <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->
            <?php echo "<h6>Welcome " . $_SESSION['username'] . "</h6>"; ?>

            <!-- <img src="images/profile.jpg" alt=""> -->

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                <?php
// Check if the user is logged in and has a valid session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to fetch climate conditions from the farm_info table 
    $farmClimateQuery = "SELECT DISTINCT climate FROM farm_info WHERE username = '$username'";
    $farmClimateResult = $conn->query($farmClimateQuery);

    if ($farmClimateResult->num_rows > 0) {
        $count = 0;

        while ($farmRow = $farmClimateResult->fetch_assoc()) {
            $climate = $farmRow["climate"];

            // Query to count matching crop info from crop_info table
            $cropCountQuery = "SELECT COUNT(*) AS count FROM crop_info WHERE climate_conditions = '$climate'";
            $result = $conn->query($cropCountQuery);
            $row = $result->fetch_assoc();

            $count += $row["count"];
        }

        echo '<div class="box box-calendar">';
        echo '<i class="uil uil-pagelines"></i>';
        echo '<span class="text">Recommended Crops</span>';
        echo '<span class="number">' . $count . '+'.'</span>';
        echo '</div>';
    } else {
        echo '<div class="box box-calendar">';
        echo '<i class="uil uil-pagelines"></i>';
        echo '<span class="text">Recommended Crops</span>';
        echo '<span class="number">Crop data not Available.</span>';
        echo '</div>';
    }
} else {
    // If the user is not logged in, you can display an appropriate message or redirect to a login page.
    echo "You are not logged in.";
}
?>

                    <div class="box box2">
                        <i class="uil uil-chart"></i>
                        <span class="text">Fertilizer</span>
                        <span class="number">
                        <?php
// Check if the user is logged in and has a valid session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to fetch the soil_type from farm_info for the logged-in user
    $soilTypeQuery = "SELECT soil_type FROM farm_info WHERE username = '$username'";
    $soilTypeResult = $conn->query($soilTypeQuery);

    if ($soilTypeResult->num_rows > 0) {
        $row = $soilTypeResult->fetch_assoc();
        $soilType = $row["soil_type"];

        // Query to count the number of matching fertilizers based on soil_type
        $fertilizerCountQuery = "SELECT COUNT(*) as total FROM fertilizer_info WHERE soil_type = '$soilType'";
        $result = $conn->query($fertilizerCountQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row["total"].'+';
        } else {
            echo "0"; // Display 0 if there are no matching records
        }
    } else {
        echo "Fertilizer data not Available.";
    }
} 
?>

                        </span>
                    </div>

                <?php

// Check if the user is logged in
if(isset($_SESSION['username'])) {


    // Retrieve crop data for the logged-in user (replace with your actual SQL query)
    $username = $_SESSION['username']; // Assuming you have a 'username' stored in the session

    $sql = "SELECT farm_name, crop_sowing_date FROM farm_info WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cropName = $row["farm_name"];
            $sowingDate = new DateTime($row["crop_sowing_date"]); // Convert sowing date to DateTime object
            $currentDate = new DateTime();

            // Calculate the difference between sowing date and current date in days
            $age = $sowingDate->diff($currentDate)->days;

            // Display the crop name and age
            echo '<div class="box box-calendar">';
            echo '<i class="uil uil-pagelines"></i>';
            echo '<span class="text">' . '  Crop Age</span>';
            echo '<span class="number">' . $age . ' days</span>';
            echo '</div>';
        }
    } else {
            echo '<div class="box box-calendar">';
            echo '<i class="uil uil-pagelines"></i>';
            echo '<span class="text">' . '  Crop Age</span>';
            echo '<span class="number">Crop data not Available.</span>';
            echo '</div>';
    }

} else {
    echo "You must be logged in to view this data.";
}
?>
                </div>
            </div>

            <div class="dash-content">

                <!-- Display farm_info section -->

                <div class="activity">
                    <div class="title">
                        <i class="uil-files-landscapes"></i>
                        <span class="text">Farm's info
                        </span>
                    </div>
                    <div class="activity-data">

                    <?php
        // Get the session username
        $session_username = $_SESSION['username'];

        // Query to fetch farm information for the session username
        $sql = "SELECT * FROM farm_info WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $session_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $farmId = $row["id"];
                $farmName = $row["farm_name"];
                $location = $row["location"];
                $area = $row["area"];
                $soilType = $row["soil_type"];
                $climate = $row["climate"];
                $crop_sowing_date = $row["crop_sowing_date"];

                echo '<div class="data names">';
                echo '<span class="data-title">Farm Name</span>';
                echo '<span class="data-list">' . $farmName . '</span>';
                echo '</div>';
                echo '<div class="data email">';
                echo '<span class="data-title">Location</span>';
                echo '<span class="data-list">' . $location . '</span>';
                echo '</div>';
                echo '<div class="data joined">';
                echo '<span class="data-title">Area</span>';
                echo '<span class="data-list">' . $area . '</span>';
                echo '</div>';
                echo '<div class="data type">';
                echo '<span class="data-title">Soil Type</span>';
                echo '<span class="data-list">' . $soilType . '</span>';
                echo '</div>';
                echo '<div class="data type">';
                echo '<span class="data-title">Climate</span>';
                echo '<span class="data-list">' . $climate . '</span>';
                echo '</div>';
                echo '<div class="data type">';
                echo '<span class="data-title">Crop Sowing Date</span>';
                echo '<span class="data-list">' . $crop_sowing_date . '</span>';
                echo '</div>';

                // Add update and delete buttons
                echo '<div class="data actions">';
                echo '<a href="update_farm.php?id=' . $farmId . '" class="btn btn-primary btn-sm" style="margin: 2px;">Update</a>';
                echo '<a href="delete_farm.php?id=' . $farmId . '" class="btn btn-danger btn-sm" style="margin: 2px;">Delete</a>';
                echo '</div>';
                


                // Break the row and start a new row
                echo '<div class="clearfix"></div>';
            }
        } else {
            echo '<div class="container">';
            echo "No farm information found for $session_username ";
            echo '<br>';
            echo '<br>';
            echo '</div>';        
            echo '<a href="add_farms.php" class="btn btn-primary btn-sm"><i class="uil uil-file-plus-alt"></i> Add Farm</a>';
        }

        $stmt->close();
        ?>

                    </div>
                </div>

            </section>

            <!----======== icons ======== -->

            <script src="https://kit.fontawesome.com/a75cb9b5b7.js" crossorigin="anonymous"></script>
            <script
                src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="script.js"></script>
        </body>
    </html>