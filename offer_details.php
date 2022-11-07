<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalji o nekretnini</title>
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
        $database = mysqli_connect('localhost','root','','appartment_rental');
        $id = $_GET['id'];
        $query = "SELECT offers.*, cities.name as 'city_name' FROM offers INNER JOIN cities on offers.city_id = cities.id WHERE offers.id = $id";
        $result = $database->query($query)->fetch_assoc();
        $query = "SELECT title FROM offer_images WHERE offer_id = $id";
        $images = $database->query($query);
        $thumbnails = $database->query($query);
    ?>
    <div class="container-grid">
        <div class="sidebar">
            <h1><?php echo $result['offer_name']?></h1>
            <h3><?php echo $result['city_name']?></h3>
            <h3>Broj soba: <?php echo $result['room_number']?></h3>
            <h3>Maksimalan broj ljudi: <?php echo $result['people_number']?></h3>
            <h3>Internet:
                <?php if($result['internet']):?>
                Da
                <?php else:?>
                Ne
                <?php endif?>
            </h3>
            <h3>Parking:
                <?php if($result['parking']):?>
                Da
                <?php else:?>
                Ne
                <?php endif?>
            </h3>
            <h3>Dozvoljeno pusenje:
                <?php if($result['smoking_allowed']):?>
                Da
                <?php else:?>
                Ne
                <?php endif?>
            </h3>
            <?php if(isset($_SESSION['username'])):?>
            <button class="reserve-btn" id="myBtn">
                <h5 class="wf">Cena po danu: <span class="wf" id="offer-price"><?php echo $result['price']?></span>.00
                    rsd</h5>
                Rezervisi
            </button>
            <?php else:?>
            <a href="register.php" class="text-center register-btn">
                <h5 class="wf">Cena po danu: <span class="wf" id="offer-price"><?php echo $result['price']?></span>.00
                    rsd</h5>

                Nalog je obavezan za rezervaciju.
            </a>
            <?php endif?>

        </div>
        <div class="content">
            <div class="offer-gallery">
                <h1>Galerija slika</h1>
                <div class="gallery-images">
                    <img src='media/arrow-left-solid.svg' id="gallery-prev" class="gallery-control"></img>
                    <?php $i = 0;?>
                    <?php while($row = $images->fetch_assoc()):?>
                    <img id=<?php echo $i?> class="gallery-image" src="house_images/<?php echo $row['title'];?>">
                    <?php $i++?>
                    <?php endwhile?>
                    <img src="media/arrow-right-solid.svg" id="gallery-next" class="gallery-control"></img>
                </div>
                <div class="gallery-thumbnails">
                    <?php while($row = $thumbnails->fetch_assoc()):?>
                    <img id=<?php echo $i?> class="gallery-thumbnail" src="house_images/<?php echo $row['title'];?>">
                    <?php $i++?>
                    <?php endwhile?>
                </div>

            </div>
            <div class="reviews">
                <?php if(isset($_SESSION['user_id'])):?>
                <?php 
                    $user_id = $_SESSION['user_id'];
                    $offer_id = $_GET['id'];
                    $query = "SELECT end_date as 'ed' FROM offer_reservations WHERE user_id = $user_id AND offer_id = $offer_id";
                    $check = $database->query($query)->fetch_assoc();
                    if(isset($check['ed'])){
                    $date_end = $check['ed'];
                    $date_end = date_create($date_end);
                }
                    else{
                        $date_end = null;
                    }
                    $current_date =date_create(date('m/d/Y')); 
                    $reviewquery = "SELECT * from offer_reviews where user_id = $user_id and offer_id = $offer_id";
                    $reviewresult = $database->query($reviewquery);    
                    $review_exists = false;
                    if(mysqli_num_rows($reviewresult) > 0){
                            $review_exists = true; 
                        }
                ?>
                <?php if($date_end < $current_date && $date_end != null && $review_exists):?>
                <h1>Ocena vec postoji. Mozete je izmeniti u svako doba.</h1>
                <?php $rr = $reviewresult->fetch_assoc()?>
                <form method = "post" action = "index.php" class="review-form">
                    <label for="rate">Ocena (1-5)</label>
                    <input class = "date input" type = "number" max = 5 min = 1 id = "rate" name = "rate" value = "<?php echo $rr['rate']?>">
                    <label for="review">Komentar</label>
                    <textarea name = "review" id = "review" class = "input date"><?php echo $rr['review']?></textarea>
                    <input type = "hidden" name = "user_id" value = "<?php echo $_SESSION['user_id']?>">
                    <input type = "hidden" name = "offer_id" value = "<?php echo $result['id']?>">
                    <input type = "hidden" name = "edit_review" value = 1>
                    <button type = "submit mx-auto" class = "submit-btn">Azuriraj ocenu</button>
                </form>
                <?php elseif($date_end < $current_date && $date_end != null && !$review_exists):?>
                <form method = "post" action = "index.php" class="review-form">
                    <label for="rate">Ocena (1-5)</label>
                    <input class = "date input" type = "number" id = "rate" name = "rate" value = "">
                    <label for="review">Komentar</label>
                    <textarea name = "review" id = "review" class = "input date"></textarea>
                    <input type = "hidden" name = "user_id" value = "<?php echo $_SESSION['user_id']?>">
                    <input type = "hidden" name = "offer_id" value = "<?php echo $result['id']?>">
                    <input type = "hidden" name = "submit_review" value = 1>
                    <button type = "submit mx-auto" class = "submit-btn">Oceni</button>
                </form>
                <?php else:?>
                    <h3 class = "text-center">Ocenjivanje nije moguce. Morate se vratiti sa lokacije da biste je ocenili, ili morate rezervisati smestaj.</h3><br>
                <?php endif;?>
                <?php else:?>
                    <h2 class = "text-center">Nalog je obavezan za ocenu. <a href = "login.php">Ulogujte se ovde</a></h2><br>
                <?php endif;?>
                <h1>Ocene korisnika</h1>
                <?php 
                    $qr = "SELECT offer_reviews.review, offer_reviews.rate, users.username, offer_reviews.date_created FROM offer_reviews INNER JOIN users on users.id = offer_reviews.user_id WHERE offer_reviews.offer_id = $id";
                    $results = $database->query($qr);
                ?>
                <?php while($row = $results->fetch_assoc()):?>
                <div class="review">
                    <div class="review-title">
                        <p><?php echo $row['username']?></p>
                        <p>Ocena : <?php echo $row['rate']?> / 5</p>
                    </div>
                    <div class="review-content">
                        <p><?php echo $row['review']?></p>
                    </div>
                </div>
                <?php endwhile?>
            </div>
        </div>
    </div>


    <!-- Modal content -->

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Rezervisi</h2>
            </div>
            <div class="modal-body">
                <div id="reservation-error" class="reservation-error">
                    <h3>Greska pri rezervaciji. Rezervacija pod ovim intervalom vec postoji</h3>
                </div>
                <div id="date-error1" class="reservation-error">
                    <h3>Datum rezervacije ne moze biti pre danasnjeg datuma</h3>
                </div>
                <div id="date-error2" class="reservation-error">
                    <h3>Datum povratka ne sme biti pre datuma odlaska</h3>
                </div>
                <h2>Rezervacija za: <?php echo $result['offer_name']?></h2><br>
                <form action="index.php" method="post">
                    <label for="start-date">Datum dolaska</label>
                    <input id="start-date" class="date input" type="date" name="date_started">
                    <label for="end-date">Datum odlaska</label>
                    <input id="end-date" class="date input" type="date" name="date_end">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                    <input type="hidden" id="offer_id" name="offer_id" value="<?php echo $result['id'];?>">
                    <input type='hidden' name="create_reservation" value=1>
                    <h3 id="price-modal" class="price-modal">Cena: </h3>
                    <div class="payment-method" id="payment">
                        <div class="payment-options">
                            <div class="option">
                                <label for="cash">Kes</label>
                                <input type="radio" name="payment" value=0 id="cash">
                            </div>
                            <div class="option">
                                <label for="card">Kartica</label>
                            </div>
                            <input type="radio" name="payment" value=1 id="card">
                        </div>
                        <div class="card-info">
                            <input class="date input" placeholder="Ime vlasnika kartice">
                            <input class="date input" placeholder="Broj kartice">
                            <div class="input-half">
                                <input class="date input" placeholder="Datum isticaja">
                                <input class="date input" placeholder="CVC broj">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn mx-auto" id="modal-btn">Rezervisi</button>
                </form>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src='js/offer_details.js'></script>
    <script src="js/modal.js"></script>
    </body>
</html>