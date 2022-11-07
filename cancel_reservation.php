<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:home.php');
        return;
    }
    $database = mysqli_connect("localhost",'root','','appartment_rental');
    $offer_id = $_GET['reservation'];
    $query = "DELETE FROM offer_reservations WHERE id = $offer_id";
    if($database->query($query) === TRUE){
        if($_SESSION['role'] == 'subadmin'){
            header('location: seller_reservations.php');
        }
        else{
            header('location:account.php');
        }
    }
    else{
        echo $database->error;
    }

?>