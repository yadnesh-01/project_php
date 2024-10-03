<?php
    include('../logs/rest_log_writer.php');
    $page_title="Log Out";
    session_start();

    unset( $_SESSION['authenticated']);
    unset( $_SESSION['username']);
    $_SESSION['status']="You Logged Out Successfully";

    write_log('logout.php',__FILE__,"SUCCESS",'Logged Out Successfuly');

    header("Location: login.php");
?>