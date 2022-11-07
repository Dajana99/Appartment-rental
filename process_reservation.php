<?php session_start()?>
    <?php 
        $database = mysqli_connect("localhost",'root','','appartment_rental');
        $offer_id = $_GET['reservation'];
        $query = "SELECT offers.*,cities.name as 'city_name' FROM offers INNER JOIN cities on cities.id = offers.city_id";
        $offer = $database->query($query)->fetch_assoc();
        $seller_id = $_SESSION['user_id'];
        if($seller_id != $offer['seller_id']){
            header('location: seller.php');
        }
        else{
            if($_GET['status'] == 1){
                $query = "UPDATE offer_reservations SET status = 1 WHERE id = $offer_id";
                if($database->query($query) === TRUE){
                    header("location: seller_reservations.php");
                }
            }
            if($_GET['status'] == 0){
                $query = "UPDATE offer_reservations SET status = 0 WHERE id = $offer_id";
                if($database->query($query) === TRUE){
                    header("location: seller_reservations.php");
                }
            }
        }
    ?>