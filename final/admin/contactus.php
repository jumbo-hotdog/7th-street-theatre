
<!DOCTYPE html>
<html lang="en">

<head>
    <title> message</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
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

        h3 {
            color: white; /* Change this color to the desired text color */
            padding-top:20px;     
            margin-left: 20px;       
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
                            <b><h3>Customer Feedback</b></h3>
                            </div>
                            <!--<div class="col-sm-4">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                            </div>-->
                        </div>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Message ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Feedback</th>
                            <th>More</th>
                        </tr>
                        <tbody>
                            <?php
                            include "config.php";
                            $host = "localhost"; /* Host name */
                            $user = "root"; /* User */
                            $password = ""; /* Password */
                            $dbname = "cinema_db"; /* Database name */

                            $select = "SELECT * FROM `feedbacktable`";
                            $run = mysqli_query($con, $select);
                            while ($row = mysqli_fetch_array($run)) {
                                $id = $row['msgID'];
                                $firstname = $row['senderfName'];
                                $lastname = $row['senderlName'];
                                $email = $row['sendereMail'];
                                $message = $row['senderfeedback'];

                            ?>
                                <tr align="center">
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $firstname; ?></td>
                                    <td><?php echo $lastname; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $message; ?></td>
                                    <!--<td><?php echo  "<a href='Deletecontact.php?id=" . $row['msgID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" class="btn btn-danger"><?php echo  "<a href='Deletecontact.php?id=" . $row['msgID'] . "'>delete</a>"; ?></button></td>
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