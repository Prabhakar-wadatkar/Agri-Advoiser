<?php

include('../php/config.php');
session_start();

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

        <div class="dash-content">

            <!-- fertilizer_info section-->

            <div class="activity">
                <!-- Recommended Crops section -->
                <div class="activity">
                    <div class="title">
                        <i class="uil uil-pagelines"></i>
                        <span class="text">Recommended Crops</span>
                    </div>

                    <div class="activity-data">
                    <?php

// Check if the user is logged in and has a valid session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to fetch climate conditions from the farm_info table (replace with your actual query)
    $farmClimateQuery = "SELECT DISTINCT climate FROM farm_info WHERE username = '$username'";
    $farmClimateResult = $conn->query($farmClimateQuery);

    if ($farmClimateResult->num_rows > 0) {
        $matchingCropNames = [];
        $matchingCategories = [];
        $matchingClimateConditions = [];
        $matchingSoilMoisture = [];

        while ($farmRow = $farmClimateResult->fetch_assoc()) {
            $climate = $farmRow["climate"];

            // Query to fetch matching crop info from crop_info table
            $cropInfoQuery = "SELECT * FROM crop_info WHERE climate_conditions = '$climate'LIMIT 30";
            $result = $conn->query($cropInfoQuery);

            while ($row = $result->fetch_assoc()) {
                $matchingCropNames[] = $row["crop_name"];
                $matchingCategories[] = $row["category"];
                $matchingClimateConditions[] = $row["climate_conditions"];
                $matchingSoilMoisture[] = $row["soil_moisture"];
            }
        }

        if (!empty($matchingCropNames)) {
            echo '<div class="data names">';
            echo '<span class="data-title">Crop Name</span>';
            echo '<span class="data-list">' . implode('<br>', $matchingCropNames) . '</span>';
            echo '</div>';
            echo '<div class="data email">';
            echo '<span class="data-title">Category</span>';
            echo '<span class="data-list">' . implode('<br>', $matchingCategories) . '</span>';
            echo '</div>';
            echo '<div class="data joined">';
            echo '<span class="data-title">Climate conditions</span>';
            echo '<span class="data-list">' . implode('<br>', $matchingClimateConditions) . '</span>';
            echo '</div>';
            echo '<div class="data type">';
            echo '<span class="data-title">Moisture Level</span>';
            echo '<span class="data-list">' . implode('<br>', $matchingSoilMoisture) . '</span>';
            echo '</div>';
        } else {
            echo "No matching crops found";
        }
    } else {
        echo '<div class="container">';
        echo "No Recommended Crops  ";
        echo '</div>';

    }
} else {
    // If the user is not logged in, you can display an appropriate message or redirect to a login page.
    echo "You are not logged in.";
}
?>

                    </div>
                </div>
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