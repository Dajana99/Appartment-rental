<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregled rezervacija</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php session_start()?>
    <?php
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'subadmin'){
            header("location: home.php");
        }
    ?>
    <?php include('nav.php')?>
    
    <div class="container">
        <h1 class="text-center bf">Pregled rezervacija</h1>
    <?php 
        $database = mysqli_connect('localhost','root','','appartment_rental');
        $user_id = $_SESSION['user_id'];
        $query = "SELECT offers.*, cities.name as city_name,users.first_name,users.last_name,users.email,offer_reservations.start_date,offer_reservations.end_date,offer_reservations.payment,offer_reservations.status,offer_reservations.id as 'reservation_id'
                FROM offers
                INNER JOIN cities on offers.city_id = cities.id
                INNER JOIN offer_reservations on offers.id = offer_reservations.offer_id
                INNER JOIN users on offer_reservations.user_id = users.id
                WHERE offers.seller_id = $user_id
        ";
        $results = $database->query($query);
    ?>
     <div class="container">
        <h1 class="text-center bf">Brz pristup</h1>
        <div class="quick-access">
           
             <a class="box" href = "add_offer.php">
                <img src="media/plus-circle-solid.svg" alt="" class="icon">
                <h3 class = "text-center wf">Dodaj ponudu</h3>
            </a>
             <a class="box" href = "seller_reviews.php">
                <img src="media/comments-solid.svg" alt="" class="icon">
                <h3 class = "text-center wf">Ocene i komentari</h3>
            </a>
        </div>
    </div>
    <div class="reservations">
        <?php while($row = $results->fetch_assoc()):?>
            <div class="reservation">
                <?php 
                    $offer_id = $row['id'];
                    $query = "SELECT title from offer_images where offer_id = $offer_id LIMIT 1";
                    $image = $database->query($query)->fetch_assoc();
                ?>
                <div class="reservation-image">
                    <img src = "house_images/<?php echo $image['title'];?>">
                </div>
                <div class="reservation-details">
                    <h1 class ="text-center"><?php echo $row['offer_name']?> - <?php echo $row['city_name']?> (<?php echo $row['price']?>.00rsd / dan)</h1><br>
                    <h2><?php echo $row['first_name']?> <?php echo $row['last_name']?></h2>
                    <h2><?php echo $row['email']?></h2>
                    <h2><?php echo date_diff(date_create($row['end_date']),date_create($row['start_date']))->format("%a")?> dan/a</h2>
                    <h2><?php echo date_format(date_create($row['start_date']),"m.d.y");?> - <?php echo date_format(date_create($row['end_date']),"m.d.y");?></h2>
                    <h2>Placanje: 
                        <?php if($row['payment'] == 0){
                            echo "Kes";
                        }
                        else {
                            echo "Kartica";
                        }
                        ?>
                    </h2>
                    <h2>Status: 
                        <?php if($row['status'] == 0){
                            echo "Neodobren";
                        }
                        else {
                            echo "Odobren";
                        }
                        ?>
                    </h2>
                </div>
                <div class="reservation-actions">
                    <a class = "action" href="cancel_reservation.php?reservation=<?php echo $row['reservation_id']?>">Ukloni rezervaciju</a>
                        <?php if($row['status'] == 0):?>
                    <a class = "action" href = "process_reservation.php?status=1&reservation=<?php echo $row['reservation_id']?>">Odobri rezervaciju</a>
                    <?php else:?>
                        <a class = "action" href = "process_reservation.php?status=0&reservation=<?php echo $row['reservation_id']?>">Ponisti rezervaciju</a>
                    <?php endif?>
                </div>
            </div>
        <?php endwhile;?>
    </div>
    
    </div>
</body>
</html>