<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit(); // Terminate further execution
}

// Logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
    exit(); // Terminate further execution
}


$mainhall_price = 300.00; // Default price for main hall
$viphall_price = 750.00;   // Default price for VIP hall
$privatehall_price = 1350.00; // Default price for private hall

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add entry</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

</style>

    <?php
    $link = mysqli_connect("localhost", "root", "", "cinema_db");
    $sql = "SELECT * FROM bookingTable";
    $bookingsNo = mysqli_num_rows(mysqli_query($link, $sql));
    $messagesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM feedbackTable"));
    $moviesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM movieTable"));
    ?>

    <?php include('header.php'); ?>
    
    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">


                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Add booking</h2>
                        <i class="fas fa-film" style="background-color: #004AAD"></i>
                    </div>
                    <div class="booking-form-container">
                        <form action="spot.php" method="POST">

                        <select name="theatre" id="theatre" required>
    <option value="" disabled selected>THEATRE</option>
    <option value="main-hall">Main Hall</option>
    <option value="vip-hall">VIP Hall</option>
    <option value="private-hall">Private Hall</option>
</select>
                            <select name="type" required>
                                <option value="" disabled selected>CINEMA TYPE</option>
                                <option value="3d">3D</option>
                                <option value="2d">2D</option>
                                <option value="imax">IMAX</option>
                                <option value="7d">7D</option>
                            </select>

                            <select name="date" required>
                                <option value="" disabled selected>DATE</option>
                                <option value="12-3">March 12, 2024</option>
                                <option value="13-3">March 13, 2024</option>
                                <option value="14-3">March 14, 2024</option>
                                <option value="15-3">March 15, 2024</option>
                                <option value="16-3">March 16, 2024</option>
                            </select>

                            <select name="hour" required>
                                <option value="" disabled selected>TIME</option>
                                <option value="09-00">09:00 AM</option>
                                <option value="12-00">12:00 AM</option>
                                <option value="15-00">03:00 PM</option>
                                <option value="18-00">06:00 PM</option>
                                <option value="21-00">09:00 PM</option>
                                <option value="24-00">12:00 PM</option>
                            </select>

                            <input placeholder="First Name" type="text" name="fName" required>

                            <input placeholder="Last Name" type="text" name="lName">

                            <input placeholder="Phone Number" type="text" name="pNumber" required>
                            <input placeholder="E-mail" type="email" name="email" required>
                            <select name="movie_id" id = "movieID"required>
    <option value="" disabled selected>Select Movie ID</option>
    <?php
    // Assuming $mysqli is your database connection object
    $query = "SELECT movieID FROM movietable";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row['movieID'] . "\">" . $row['movieID'] . "</option>";
        }
    }
    ?>
</select>                            
                            <select name="price" id="price" required>
    <option value="" disabled selected>Price</option>
</select>

<script>
document.getElementById('theatre').addEventListener('change', function() {
    var priceSelect = document.getElementById('price');
    priceSelect.innerHTML = ''; // Clear previous options
    
    // Set prices based on selected theater
    switch(this.value) {
        case 'main-hall':
            addPriceOption(priceSelect, <?php echo $mainhall_price; ?>);
            break;
        case 'vip-hall':
            addPriceOption(priceSelect, <?php echo $viphall_price; ?>);
            break;
        case 'private-hall':
            addPriceOption(priceSelect, <?php echo $privatehall_price; ?>);
            break;
        default:
            // Default case
            break;
    }
});

function addPriceOption(selectElement, price) {
    var option = document.createElement('option');
    option.value = price;
    option.text = '₱' + price;
    selectElement.add(option);
}
</script>
<!-- Add a span to display remaining seats -->
<span id="remaining-seats">Remaining Seats: </span>
<script>
document.getElementById('movieID').addEventListener('change', function() {
    var movieID = this.value;
    var theater = document.getElementById('theatre').value;
    if (theater && movieID) {
        // Send AJAX request to fetch remaining seats
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the remaining seats value in the span
                    document.getElementById('remaining-seats').textContent = xhr.responseText;
                } else {
                    console.error('Error fetching remaining seats');
                }
            }
        };
        xhr.open('GET', 'get_remaining_seats.php?theater=' + theater + '&movie_id=' + movieID, true);
        xhr.send();
    }
});
</script>

<script>
document.getElementById('theatre').addEventListener('change', function() {
    var theater = this.value;
    if (theater) {
        // Send AJAX request to fetch remaining seats
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the remaining seats value in the span
                    document.getElementById('remaining-seats').textContent = xhr.responseText;
                } else {
                    console.error('Error fetching remaining seats');
                }
            }
        };
        xhr.open('GET', 'get_remaining_seats.php?theater=' + theater, true);
        xhr.send();
    }
});
</script>

</body>

</html>
                            <button type="submit" value="submit" name="submit" class="form-btn" style="background-color: #004AAD;">+ Add booking</button>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>