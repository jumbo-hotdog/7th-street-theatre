<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Container */
        .container {
            width: 40%;
            margin: 0 auto;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url('/movie_ticket_booking_system_php-main/img/index-bg.gif');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login */
        #div_login {
            width: 470px;
            height: 270px;
            margin: 480px auto 0;
        }

        #div_login h1 {
            margin-top: 0px;
            font-weight: bold;
            padding: 10px;
            color: #FFFACF;
            font-family: Arial;
            text-align: center;
        }

        #div_login div {
            clear: both;
            margin-top: 10px;
            padding: 5px;
        }

        #div_login .textbox {
        width: 50%;
        padding: 7px;
        border: 2px solid #4E1311;
        background-color: #FFFACF;
        transform: translateX(43%);

        }

        #div_login input[type=submit] {

        padding: 7px;
        width: 100px;
        background-color: #FFFACF;
        color: black;
        display: block;
        margin: 0 auto;
        border-radius: 10px;
        border: 3px solid #4E1311;

        }

        #div_login input[type=submit]:hover {
        background-color: #B83E2E;

        }

    </style>
</head>

<body>
        <div class="container">
        <form method="post" action="">
            <div id="div_login">
                <div>
                    <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                </div>
                <div>
                    <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password" />
                </div>
                <div>
                    <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include "config.php";

if (isset($_POST['but_submit'])) {

    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

    if ($uname != "" && $password != "") {

        $sql_query = "select count(*) as cntUser from users where username='" . $uname . "' and password='" . $password . "'";
        $result = mysqli_query($con, $sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if ($count > 0) {
            $_SESSION['uname'] = $uname;
            header('Location: admin.php');
        } else {
            echo "Invalid username and password";
        }
    }
}
?>