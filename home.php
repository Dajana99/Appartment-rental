<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iznajmljivanje nektretnina</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
    <?php session_start()?>
    <?php include('nav.php')?>
    <div class="container">
        <form class = "search-form" action="search.php" method = "get" id = "search-form">
            <img src = "media/search-solid.svg" class = "search-icon" id = "search_btn">
            <input type = "text" name = "search_text" placeholder = "Pretrazi(npr. Kragujevac, stan, Beograd...)">
        </form>
    </div>

    <div class="container">
        <?php 
            $database = mysqli_connect('localhost','root','','appartment_rental');
            $query = "SELECT offers.*, cities.name as city_name FROM offers INNER JOIN cities on offers.city_id = cities.id";
            $results = $database->query($query);
        ?>
        <div class="home-offers">
            <?php while($row = $results->fetch_assoc()):?>
            <a href="offer_details.php?id=<?php echo $row['id']?>" class="home-offer">
                <?php if($row['offer_type'] == 0):?>
                    <input type = "hidden" class = "house">
                    <?php else:?>
                    <input type = "hidden" class = "appartment">
                <?php endif?>
                <div class="home-offer-img">
                    <?php 
                            $offer_id = $row['id'];
                            $query = "SELECT title FROM offer_images WHERE offer_id = $offer_id LIMIT 1";
                            $image = $database->query($query)->fetch_assoc();
                            ?>
                    <img src="house_images/<?php echo $image['title']?>">
                </div>
                <div class="home-offer-details">
                    <h1 class=""><?php echo $row['offer_name']?></h1>
                    <h3 class=""><?php echo $row['city_name']?></h3>
                    <h4>Broj soba: <?php echo $row['room_number']?></h4>
                    <h4>Broj ljudi: <?php echo $row['people_number']?></h4>

                    <div class="icons">
                        <div class="icon">
                            <?php if($row['parking']):?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/parking.svg">
                                <span class="tooltiptext">Postoje parking mesta</span>
                            </div>
                            <?php else:?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/no-parking.svg">
                                <span class="tooltiptext">Ne postoje parking mesta</span>
                            </div>

                            <?php endif?>
                        </div>
                        <div class="icon">
                            <?php if($row['smoking_allowed']):?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/smoking-solid.svg">
                                <span class="tooltiptext">Dozvoljeno pusenje</span>
                            </div>
                            <?php else:?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/smoking-ban-solid.svg">
                                <span class="tooltiptext">Zabranjeno pusenje</span>
                            </div>
                            <?php endif?>
                        </div>
                        <div class="icon">
                            <?php if($row['internet']):?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/wifi.svg">
                                <span class="tooltiptext">Internet</span>
                            </div>
                            <?php else:?>
                            <div class="tooltip">
                                <img class="icon-info" src="media/no-wifi.svg">
                                <span class="tooltiptext">Nema interneta</span>
                            </div>
                            <?php endif?>
                        </div>
                    </div>
                </div>
            </a>
            <?php endwhile?>
        </div>
    </div>
    <div class="container">
        <h1 class="bf text-center mb-0">Nije ono sto ste trazili?</h1>
        <h2 class="text-center">Pogledajte neke od navedenih opcija</h2><br><br>
        <div class="quick-actions">
            <?php if(!isset($_SESSION['username'])):?>
            <a class="action" href = "login.php">
                <img src="media/sign-in-alt-solid.svg" class = "icon">
                <h3 class = "wf">Ulogujte se</h3>
            </a>
            <?php else:?>
            <a class="action" href = "account.php#reservations">
                <img src="media/bookmark-solid.svg" class="icon">
                <h3 class = "wf">Rezervacije</h3>
            </a>
            <a class="action" href = "account.php#reviews">
                <img src="media/eye-solid.svg" class="icon ">
                <h3 class = "wf">Vase ocene</h3>
            </a>
            <a class="action" href = "logout.php">
                <img src="media/sign-out-alt-solid.svg" class="icon">
                <h3 class = "wf">Odjavite se</h3>
            </a>
            <?php endif;?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/home.js"></script>
</body>

</html>