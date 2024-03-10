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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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



</style>
    <?php
    $sql = "SELECT * FROM bookingTable";
    $bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
    $messagesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM feedbackTable"));
    $moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movieTable"));
    ?>
    
    <?php include('header.php'); ?>

    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">


                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Add a film</h2>
                        <i class="fas fa-film" style="background-color: #00BF63"></i>
                    </div>
                    <form action="" method="POST">
                        <input placeholder="Title" type="text" name="movieTitle" required>
                        <input placeholder="Genre" type="text" name="movieGenre" required>
                        <input placeholder="Duration" type="number" name="movieDuration" required>
                        <input placeholder="Release Date" type="date" name="movieRelDate" required>
                        <input placeholder="Director" type="text" name="movieDirector" required>
                        <input placeholder="Actors" type="text" name="movieActors" required>

                        <br>
                        <label>Add Poster</label>
                        <input type="file" name="movieImg" accept="image/*">
                        <button type="submit" value="submit" name="submit" class="form-btn" style="background-color: #00BF63;">+ Add Film</button>
                        <?php
                        if (isset($_POST['submit'])) {
                            $insert_query = "INSERT INTO 
                            movieTable (  movieImg,
                                            movieTitle,
                                            movieGenre,
                                            movieDuration,
                                            movieRelDate,
                                            movieDirector,
                                            movieActors,
                                            mainhall_price,
                                            viphall_price,
                                            privatehall_price)
                            VALUES (        'img/" . $_POST['movieImg'] . "',
                                            '" . $_POST["movieTitle"] . "',
                                            '" . $_POST["movieGenre"] . "',
                                            '" . $_POST["movieDuration"] . "',
                                            '" . $_POST["movieRelDate"] . "',
                                            '" . $_POST["movieDirector"] . "',
                                            '" . $_POST["movieActors"] . "',
                                            '" . $_POST["mainhall_price"] . "',
                                            '" . $_POST["viphall_price"] . "',
                                            '" . $_POST["privatehall_price"] . "')";
                           $rs= mysqli_query($con, $insert_query);
                           if ($rs) {
                            echo "<script>alert('Successfully Submitted');
                                  window.location.href='addmovie.php';</script>";
                        }
                        }
                        ?>
                    </form>
                </div>
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Recent Films</h2>
                        <i class="fas fa-film" style="background-color: #7B1E22"></i>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Movie ID</th>
                            <th>Movie Title</th>
                            <th>Movie Genre</th>
                            <th>Release Date</th>
                            <th>Director</th>
                            <th>Remaining Seats</th>
                            <th>Reserved Seats</th>
                            <th>Options</th>

                            
                        </tr>
                        <tbody>
                            <?php
                            $host = "localhost"; /* Host name */
                            $user = "root"; /* User */
                            $password = ""; /* Password */
                            $dbname = "cinema_db"; /* Database name */

                            $con = mysqli_connect($host, $user, $password, $dbname);
                            $select = "SELECT * FROM `movietable`";
                            $run = mysqli_query($con, $select);
                            while ($row = mysqli_fetch_array($run)) {
                                $ID = $row['movieID'];
                                $title = $row['movieTitle'];
                                $genere = $row['movieGenre'];
                                $releasedate = $row['movieRelDate'];
                                $movieactor = $row['movieDirector'];
                                $remainingseats = $row['remainingSeats'];
                                $reservedseats = $row['reservedSeats'];



                            ?>
                                <tr align="center">
                                    <td><?php echo $ID; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $genere; ?></td>
                                    <td><?php echo $releasedate; ?></td>
                                    <td><?php echo $movieactor; ?></td>
                                    <td><?php echo $remainingseats; ?></td>
                                    <td><?php echo $reservedseats; ?></td>



                                    <!--<td><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" style="background-color: white; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#FF5E5E';" onmouseout="this.style.backgroundColor='white';"class="btn btn-danger"><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>Delete</a>"; ?></button>
                                    <button name="update"  type="submit" onclick="" type="button" class="btn btn-outline-warning">    <?php echo "<a href='updatemovie.php?id=" . $row['movieID'] . 
               "&title=" . $row['movieTitle'] . 
               "&genre=" . $row['movieGenre'] . 
               "&duration=" . $row['movieDuration'] . 
               "&rel_date=" . $row['movieRelDate'] . 
               "&director=" . $row['movieDirector'] . 
               "&actors=" . $row['movieActors'] . 
               "&mainhall=" . $row['mainhall'] . 
               "&viphall=" . $row['viphall'] . 
               "&privatehall=" . $row['privatehall'] . 
               "'>Update</a>"; ?>
</button>
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