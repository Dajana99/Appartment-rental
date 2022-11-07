    <?php session_start()?>
    <?php
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'subadmin'){
            header("location: home.php");
        }
    ?>
    <?php 
        $database = mysqli_connect("localhost",'root','','appartment_rental');
        $offer_id = $_GET['offer'];
        $query = "SELECT offers.*,cities.name as 'city_name' FROM offers INNER JOIN cities on cities.id = offers.city_id WHERE offers.id = $offer_id";
        $offer = $database->query($query)->fetch_assoc();
        $seller_id = $_SESSION['user_id'];
        if($seller_id != $offer['seller_id']){
            header('location: seller.php');
        }
        else{
            $query = "DELETE FROM offers WHERE id = $offer_id";
            if($database->query($query) === TRUE){
                header('location: seller.php');
            }
        }
    ?>