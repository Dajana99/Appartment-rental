<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodavac-pocetna</title>
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
             <a class="box" href = "seller_reviews.php">
                <img src="media/comments-solid.svg" alt="" class="icon">
                <h3 class = "text-center wf">Ocene i komentari</h3>
            </a>
        </div>
    </div>
    <div class="container">
        <h3 class = "text-center bf">Vase ponude</h3>
        <?php
            $database = mysqli_connect('localhost','root','','appartment_rental');
            $user_id = $_SESSION['user_id'];
            $query = "SELECT offers.*,cities.name as city_name FROM offers INNER JOIN cities on offers.city_id = cities.id where seller_id = $user_id";
            $results = $database -> query($query);
        ?>
        <div class="offers">
        <?php while($row = $results->fetch_assoc()):?>
            <div class="offer">
                <?php
                    $offer_id = $row['id'];
                    $query = "SELECT * FROM offer_images WHERE offer_id = $offer_id LIMIT 1";
                    $result = $database -> query($query);
                    $image = $result->fetch_assoc();
                ?>
                <div class="offer-img wf">
                    <h2 class = "text-center"><?php echo $row['offer_name']?></h2>
                    <img src="house_images/<?php echo $image['title']?>" alt="">
                    <div class="offer-actions">
                        <a href = "change_offer.php?offer=<?php echo $row['id'];?>" class = "offer-btn">Izmeni</a>
                        <a href = "delete_offer.php?offer=<?php echo $row['id'];?>" class = "offer-btn">Ukloni</a>
                    </div>
                </div>
                <div class="offer-details wf">
                    <div class="details">
                    <h4 class = "wf"> Lokacija: <?php echo $row['city_name']?></h4>
                    <p class = "wf"><strong >Tip ponude:</strong> 
                    <?php if($row['offer_type'] == 0)
                            echo "Kuca";
                        else 
                            echo "Stan";
                    ?>
                    </p>
                    <p class = "wf"> 
                         <strong >Broj soba: </strong>
                        <?php echo $row['room_number']?>
                    </p>
                    <p class = "wf">
                         <strong >Broj ljudi: </strong>
                        <?php echo $row['people_number']?>
                    </p>
                    <p class = "wf" ><strong >Parking: </strong>
                    <?php if ($row['parking'] == 1){
                            echo "Postoji";
                        }
                        else{
                            echo "Ne postoji";
                        }
                    ?>
                    </p>
                    <p class = "wf"><strong >Internet: </strong>
                    <?php if ($row['internet'] == 1){
                            echo "Postoji";
                        }
                        else{
                            echo "Ne postoji";
                        }
                    ?>
                    </p>
                     <p class = "wf" ><strong >Dozvoljeno pusenje: </strong>
                    <?php if ($row['internet'] == 1){
                            echo "Da";
                        }
                        else{
                            echo "Ne";
                        }
                    ?>
                    </p>
                    </div>
                    <div class="description">
                    <p class = "wf"><h3 class = "wf" >Opis: </h3>
                        <?php echo $row['description']?>
                        </div>
                    </p>
                </div>
            </div>
        <?php endwhile?>
        </div>
    </div>
</body>

</html>