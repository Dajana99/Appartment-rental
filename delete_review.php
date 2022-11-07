<?php
    session_start();
    $id = $_GET['id'];
    $database = mysqli_connect("localhost",'root','','appartment_rental');
    $user_id = $_SESSION['user_id'];
    $review = $database->query("SELECT * FROM offer_reviews WHERE id = $id")->fetch_assoc();
    if($review['user_id'] != $user_id){
        header("location:account.php");
    }
    else{
        $query = "DELETE from offer_reviews WHERE id = $id";
        if($database->query($query) === TRUE){
            header("location: account.php");
        }
        else{
            echo $database->error;
        }
    }
?>