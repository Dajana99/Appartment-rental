<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moj nalog</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <?php session_start()?>
    <?php include('nav.php')?>
    <?php 
        $database = mysqli_connect("localhost",'root','','appartment_rental');
        $user_id = $_SESSION['user_id'];
        if($user_id == ""){
            header('location: home.php');
        }
        $query = "SELECT users.*, COUNT(offer_reservations.user_id) as number_of_reservations FROM users INNER JOIN offer_reservations on users.id = offer_reservations.user_id WHERE user_id = $user_id";
        $user = $database->query($query)->fetch_assoc();
    ?>
    <div class="account-container">
        <div class="account-sidebar">
            <br>
            <h1 class="text-center wf"><?php echo $user['first_name']." ".$user['last_name'];?></h1><br>
            <h2 class="text-center wf"><?php echo $user['username'];?></h2><br>
            <h2 class="text-center wf"><?php echo $user['email'];?></h2><br>
            <h2 class="text-center wf">Broj rezervacija: <?php echo $user['number_of_reservations']?></h2><br>
            <div class="account-navigation">
                <div class="navigator">
                    <a href="#reservations" class="text-center wf">Rezervacije</a>
                </div>
                <div class="navigator">
                    <a href="#reviews" class="text-center wf">Ocene</a>
                </div>
            </div>
        </div>
        <div class="account-content">
            <div class="account-reservations" id="reservations">
                <h1 class="bf">Rezervacije</h1>
                <?php 
                        $query = "SELECT offers.*, cities.name as city_name,users.first_name,users.last_name,users.email,offer_reservations.start_date,offer_reservations.end_date,offer_reservations.payment,offer_reservations.status,offer_reservations.id as 'reservation_id'
                                    FROM offers
                                    INNER JOIN cities on offers.city_id = cities.id
                                    INNER JOIN offer_reservations on offers.id = offer_reservations.offer_id
                                    INNER JOIN users on offer_reservations.user_id = users.id
                                    WHERE offer_reservations.user_id = $user_id
                                ";
                    $results = $database->query($query);
                ?>
                <?php while($row = $results->fetch_assoc()):?>
                <div class="reservation">
                    <?php 
                    $offer_id = $row['id'];
                    $query = "SELECT title from offer_images where offer_id = $offer_id LIMIT 1";
                    $image = $database->query($query)->fetch_assoc();
                    ?>
                    <div class="reservation-image">
                        <img src="house_images/<?php echo $image['title'];?>">
                        <div class="reservation-actions">
                            <a class="action"
                                href="cancel_reservation.php?reservation=<?php echo $row['reservation_id']?>">Ukloni
                                rezervaciju</a>
                        </div>
                    </div>
                    <div class="reservation-details">
                        <h1 class="text-center"><?php echo $row['offer_name']?> - <?php echo $row['city_name']?>
                            (<?php echo $row['price']?>.00rsd / dan)</h1><br>
                        <h2><?php echo date_diff(date_create($row['end_date']),date_create($row['start_date']))->format("%a")?>
                            dan/a</h2>
                        <h2><?php echo date_format(date_create($row['start_date']),"d.m.y");?> -
                            <?php echo date_format(date_create($row['end_date']),"d.m.y");?></h2>
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

                </div>
                <?php endwhile;?>
            </div>
            <div class="account-reviews" id="reviews">
                <h1 class="bf">Ocene</h1>
                <div class="reviews">
                    <?php 
                    $query = "SELECT offers.offer_name, offers.id as 'offer_link', offer_reviews.review, offer_reviews.rate, users.username, offer_reviews.date_created FROM offer_reviews INNER JOIN offers on offers.id = offer_reviews.offer_id INNER JOIN users on users.id = offer_reviews.user_id WHERE offer_reviews.user_id = $user_id";
                    $results = $database->query($query);
                ?>
                    <?php while($row = $results->fetch_assoc()):?>
                    <div class="review">
                        <div class="review-title">
                            <a href = "offer_details.php?id=<?php echo $row['offer_link']?>"><?php echo $row['offer_name']?></a>
                            <p>Ocena : <?php echo $row['rate']?> / 5</p>
                        </div>
                        <div class="review-content">
                            <p><?php echo $row['review']?></p>
                        </div>
                        <div class="review-footer">
                            <a href = "delete_review.php?id=<?php echo $row['offer_link']?>">Ukloni ocenu</a>
                        </div>
                    </div>
                    <?php endwhile?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>