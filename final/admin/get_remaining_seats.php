<?php
// Include the database configuration file
include "config.php";

// Check if both theater and movie_id parameters are provided
if(isset($_GET['theater']) && isset($_GET['movie_id'])) {
    $theater = $_GET['theater'];
    $movieID = $_GET['movie_id'];

    // Determine which column to use based on the selected theater
    switch($theater) {
        case 'main-hall':
            $column = 'mainhall';
            break;
        case 'vip-hall':
            $column = 'viphall';
            break;
        case 'private-hall':
            $column = 'privatehall';
            break;
        default:
            // Handle the case where an invalid theater is selected
            echo "Error: Invalid theater selected.";
            exit;
    }

    // Perform a database query to fetch the remaining seats for the selected theater and movie ID
    $query = "SELECT $column FROM movietable WHERE movieID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $movieID);
    $stmt->execute();
    $stmt->store_result();

    // Check if the query was successful
    if($stmt->num_rows > 0) {
        // Bind the result variable
        $stmt->bind_result($remainingSeats);
        $stmt->fetch();

        // Display the remaining seats value
        echo "Remaining Seats: " . $remainingSeats;
    } else {
        // If the query returned no rows, display an error message
        echo "Error: No rows found.";
    }

    // Close the statement and database connection
    $stmt->close();
    $con->close();
} else {
    // If theater or movie ID parameter is not provided, display an error message
    echo "Error: Theater or movie ID parameter is missing.";
}
?>