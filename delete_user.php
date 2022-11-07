<?php 
    session_start();
    $database = mysqli_connect("localhost",'root','','appartment_rental');
    $user_id = $_GET['user_id'];
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $query = "DELETE FROM users WHERE id = $user_id";
        if($database->query($query) === TRUE){
            header("location: admin.php");
        }
        else{
            echo $database->error;
        }
    }
    else{
        header('location:home.php');
    }
?>