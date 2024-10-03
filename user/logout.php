<?php
    include('../logs/log_writer.php');
    $page_title = "Log Out";
    session_start();

    unset( $_SESSION['authenticated']);
    unset( $_SESSION['username']);
    $_SESSION['status']="You Logged Out Successfully";

    write_log('logout.php',__FILE__,'SUCCESS',$username." Logged Out Successfully");
    header("Location: login.php");
?>