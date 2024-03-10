<?php
include "config.php";

// Initialize variables
$movieID = $movieTitle = $movieGenre = $movieDuration = $movieRelDate = $movieDirector = $movieActors = $mainhall = $viphall = $privatehall = "";

// Check if form is submitted
if (isset($_POST['update'])) {
    // Get form data
    $movieID = $_POST['movieID'];
    $movieTitle = $_POST['movieTitle'];
    $movieGenre = $_POST['movieGenre'];
    $movieDuration = $_POST['movieDuration'];
    $movieRelDate = $_POST['movieRelDate'];
    $movieDirector = $_POST['movieDirector'];
    $movieActors = $_POST['movieActors'];
    $mainhall = $_POST['mainhall'];
    $viphall = $_POST['viphall'];
    $privatehall = $_POST['privatehall'];
    
    // Update movie details in the database
    $update_query = "UPDATE movieTable SET 
                    movieTitle = '$movieTitle', 
                    movieGenre = '$movieGenre', 
                    movieDuration = '$movieDuration', 
                    movieRelDate = '$movieRelDate', 
                    movieDirector = '$movieDirector', 
                    movieActors = '$movieActors', 
                    mainhall = '$mainhall', 
                    viphall = '$viphall', 
                    privatehall = '$privatehall' 
                    WHERE movieID = '$movieID'";
    $result = mysqli_query($con, $update_query);
    if ($result) {
        // Redirect to addmovie.php with success message
        header('Location: addmovie.php?update=success');
        exit;
    } else {
        // Redirect to addmovie.php with error message and debug information
        header('Location: addmovie.php?update=error&error=' . urlencode(mysqli_error($con)));
        exit;
    }
}

// Fetch movie details based on the movie ID from the URL parameter
if (isset($_GET['id'])) {
    $movieID = $_GET['id'];
    // Fetch movie details from the database using $movieID
    // Your database query to fetch movie details here
    // Populate variables like $movieTitle, $movieGenre, etc.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>update</title>
</head>

<body>
<style>
    body {
        background-image: url('/movie_ticket_booking_system_php-main/img/admin-bg.png');
        background-size: cover; /* Scale the background image to cover the entire page */
        background-repeat: no-repeat; /* Prevent the image from repeating */
        background-position: center; /* Center the background image */
    }

    .booking-form-container {
        background-color: white; /* Change this color to the desired background color */
    }

    .form-btn {
        background-color: #FF70C2; /* Change this color to the desired background color */
        /* Additional styles */
        color: white; /* Text color */
        border-color: #FF70C2; /* Remove border */
        border-radius: 20px; /* Rounded corners */
        cursor: pointer; /* Cursor style */
    }
    
    /* Additional styles for hover effect */
    .form-btn:hover {
        background-color: white; /* Change this color to the desired hover background color */
        color: #FF70C2; /* Text color */
        border-color: #FF70C2;
    }

</style>

<?php include('header.php'); ?>

<div class="admin-container">
    <?php include('sidebar.php'); ?>
    <div class="admin-section admin-section2">
        <div class="admin-section-column">
            <div class="admin-section-panel admin-section-panel2">
                <div class="admin-panel-section-header">
                    <h2>UPDATE FILM</h2>
                    <i class="fas fa-film" style="background-color: #FF70C2"></i>
                </div>
                <div class="booking-form-container">
                    <form method="POST" action="updatemovie.php">
                        <input type="hidden" name="movieID" value="<?php echo htmlspecialchars($movieID); ?>">
                        <input type="text" name="movieTitle" value="<?php echo isset($_GET['title']) ? htmlspecialchars($_GET['title']) : ''; ?>" placeholder="Enter Movie Title" required>
                        <input type="text" name="movieGenre" value="<?php echo isset($_GET['genre']) ? htmlspecialchars($_GET['genre']) : ''; ?>" placeholder="Enter Movie Genre" required>
                        <input type="number" name="movieDuration" value="<?php echo isset($_GET['duration']) ? htmlspecialchars($_GET['duration']) : ''; ?>" placeholder="Enter Movie Duration" required>
                        <input type="date" name="movieRelDate" value="<?php echo isset($_GET['rel_date']) ? htmlspecialchars($_GET['rel_date']) : ''; ?>" placeholder="Enter Release Date" required>
                        <input type="text" name="movieDirector" value="<?php echo isset($_GET['director']) ? htmlspecialchars($_GET['director']) : ''; ?>" placeholder="Enter Movie Director" required>
                        <input type="text" name="movieActors" value="<?php echo isset($_GET['actors']) ? htmlspecialchars($_GET['actors']) : ''; ?>" placeholder="Enter Movie Actors" required>
                        <input type="text" name="mainhall" value="<?php echo isset($_GET['mainhall']) ? htmlspecialchars($_GET['mainhall']) : ''; ?>" placeholder="Enter Main Hall Price" required readonly>
<input type="text" name="viphall" value="<?php echo isset($_GET['viphall']) ? htmlspecialchars($_GET['viphall']) : ''; ?>" placeholder="Enter VIP Hall Price" required readonly>
<input type="text" name="privatehall" value="<?php echo isset($_GET['privatehall']) ? htmlspecialchars($_GET['privatehall']) : ''; ?>" placeholder="Enter Private Hall Price" required readonly>
                        <input type="submit" name="update" class="form-btn" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>