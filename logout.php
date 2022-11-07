<?php 
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['role'] = 'guest';
    $_SESSION['user_id'] = null;
    header("location: home.php");
?>