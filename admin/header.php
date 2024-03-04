<style>
        h2 a {
            color: #FFFACF; }

            .btn.btn-outline-warning {
            color: #FFFACF;
            border-color: #FFFACF; 
        }

        .btn.btn-outline-warning:hover {
            color: #3A3A3A;
            background-color: #FFFACF; /* Change background color on hover */
        }

        .admin-logo img {
            width: 200px; /* Set the width of the image */
            height: auto; /* Maintain aspect ratio */
        }

        .admin-logo {
            text-align: center; /* Center align the content */
            background-color: #7B1E22; /* Set background color for the admin logo */

        }
        
        .admin-logo img {
            display: inline-block; /* Make image display as a block element */
        }


    </style>
<?php


// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}


?>
<div class="admin-section-header"style="background-color: #5D1215;">
    <div class="admin-logo">
    <img src="/movie_ticket_booking_system_php-main/img/7th_logo.gif" alt="Admin Logo">
    </div>
    <div class="admin-login-info">
        <div style="padding: 0 20px;">
            <h2><a href="#">Admin Console</a></h2>
        </div>
        <form method='post' action="">
            <input type="submit" value="Log out" class="btn btn-outline-warning" name="but_logout">
        </form>
        <img class="admin-user-avatar" src="/movie_ticket_booking_system_php-main/img/profile.png" alt="Icon">
    </div>
</div>