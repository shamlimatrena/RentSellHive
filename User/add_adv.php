<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('location:../login_form.php');
    }
    ?>
