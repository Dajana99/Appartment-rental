<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocene</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
        session_start();
        include('nav.php');
        $user_id = $_SESSION['user_id'];
        if($_SESSION['role'] != 'subadmin' || !isset($_SESSION['role'])){
            header('location: home.php');
            return;
        }
        $database = mysqli_connect('localhost','root','','appartment_rental');
        $query = "SELECT offers.id as 'offer_id',offer_reviews.date_created,offers.offer_name,offer_reviews.review,offer_reviews.rate, users.username FROM offer_reviews INNER JOIN users on users.id = offer_reviews.user_id  INNER JOIN offers on offer_reviews.offer_id = offers.id WHERE offers.seller_id = $user_id";
        $results = $database->query($query);
    ?>
    <?php
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'subadmin'){
            header("location: home.php");
        }
    ?>
     <div class="container">
        <h1 class="text-center bf">Brz pristup</h1>
        <div class="quick-access">
           
             <a class="box" href = "add_offer.php">
                <img src="media/plus-circle-solid.svg" alt="" class="icon">
                <h3 class = "text-center wf">Dodaj ponudu</h3>
            </a>
             <a class="box" href = "seller_reservations.php">
                <img src="media/bookmark-solid.svg" alt="" class="icon">
                <h3 class = "text-center wf">Pregled rezervacija</h3>
            </a>
        </div>
    </div>
    <div class="container">
        <h1 class = "bf text-center">Ocene Vasih ponuda</h1>
        <div class="reviews">
            <?php while($row = $results->fetch_assoc()):?>
                <div class="review">
                    <div class="review-title wf">
                        <p><?php echo $row['username'];?></p>
                        <h4><a class = "wf" href="change_offer.php?offer=<?php echo $row['offer_id']?>"><?php echo $row['offer_name']?></a></h4>
                        <p><?php echo $row['rate']?> / 5</p>
                    </div>
                    <div class="review-content wf">
                        <?php echo $row['review']?>
                    </div>
                    <div class="review-footer wf">
                        <p class = "text-end"><?php echo date_format(date_create($row['date_created']),"m.d.y");?></p>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>
</body>
</html>