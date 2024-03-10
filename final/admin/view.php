<?php
include "config.php";


// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
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

        h3 {
            color: white; /* Change this color to the desired text color */
            padding-top:20px;            
        }

        table {
            width: 100%;
            border-radius: 10px; /* Adjust the value as needed */
            overflow: hidden; /* This ensures that the border-radius is applied to the corners */
            border-collapse: collapse;
        }

        td {
            background-color: #f0f0f0; /* Set the background color of table cells */
            border: 1px solid #dddddd; /* Optional: Add border to table cells */
            padding: 8px; /* Optional: Add padding to table cells */
            text-align: left; /* Optional: Align text within table cells */
        }

        th {
            background-color: #f0f0f0; /* Set the background color of table header cells */
            border: 1px solid #dddddd; /* Optional: Add border to table header cells */
            padding: 8px; /* Optional: Add padding to table header cells */
            text-align: left; /* Optional: Align text within table header cells */
        }

        td button {
            color: white; /* Change this color to the desired text color */
        }

        </style>
    
    <?php include('header.php'); ?>

    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="container-lg">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                            <b><h3>List of Bookings</b></h3>
                            </div>
                            <!--<div class="col-sm-4">
                                <a href='add.php'><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button></a>
                            </div>-->
                        </div>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Booking ID</th>
                            <th>Movie ID</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Theatre & Type</th>
                            <th>Time</th>
                            <th>Order ID</th>
                            <th>Options</th>

                        </tr>
                        <tbody>
                            <?php

                            $con = mysqli_connect($host, $user, $password, $dbname);
                            $select = "SELECT * FROM `bookingtable`";
                            $run = mysqli_query($con, $select);
                            while ($row = mysqli_fetch_array($run)) {
                                $bookingid = $row['bookingID'];
                                $movieID = $row['movieID'];
                                $bookingFName = $row['bookingFName'];
                                $bookingLName = $row['bookingLName'];
                                $mobile = $row['bookingPNumber'];
                                $email = $row['bookingEmail'];
                                $date = $row['bookingDate'];
                                $theatre = $row['bookingTheatre'];
                                $type = $row['bookingType'];
                                $time = $row['bookingTime'];
                                $ORDERID = $row['ORDERID'];

                                

                            ?>
                                <tr align="center">
                                <td><?php echo $bookingid; ?></td>
                                    <td><?php echo $movieID; ?></td>
                                    <td><?php echo $bookingFName . ' ' . $bookingLName; ?></td>
                                    <td><?php echo $mobile; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $theatre . ' ' . $type; ?></td>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo $ORDERID; ?></td>
                                    <td><button type="submit" type="button" class="btn btn-outline-danger"><?php echo  "<a href='deleteBooking.php?id=" . $row['bookingID'] . "' >Delete</a>"; ?></button><button name="update"  type="submit" onclick="" type="button" class="btn btn-outline-warning"><?php echo  "<a href='editBooking.php?id=" . $row['bookingID'] . "'>Update</a>"; ?></button></td>
                                </td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>