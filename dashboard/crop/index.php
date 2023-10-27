<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Upload an Image</h2>
                    </div>
                    <div class="card-body">
                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image">Select image to upload:</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Upload Image</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery from CDN (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Image Search</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Search for Images</h2>
                    </div>
                    <div class="card-body">
                        <form action="display_image.php" method="POST">
                            <div class="form-group">
                                <label for="name">Enter Name:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <button type="submit" class="btn btn-primary" name="search">Search Images</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery from CDN (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
