<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ponudu</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="/path/to/flickity.css" media="screen">

</head>

<body>
    <?php session_start()?>
    <?php include('nav.php')?>
    <?php
        $database = mysqli_connect('localhost','root','','appartment_rental');
        $username = $_SESSION['username'];
        $query = "SELECT id FROM users where username = '$username'";
        $results = $database->query($query)->fetch_assoc();
        $id = intval($results['id']);
    ?>
 <div class="container">
        <h1 class="text-center bf">Brz pristup</h1>
        <div class="quick-access">
           
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
        <h1 class="text-center">Dodaj ponudu</h1>
        <form class="add-form" action="index.php" method="post" enctype="multipart/form-data">
            <input class="input" type="text" placeholder="Naziv ponude" name="offer_name">
            <?php 
                $query = "SELECT * FROM cities";
                $results = $database->query($query);
            ?>
            <select name="city" class="input">
                <?php while($row = $results->fetch_assoc()):?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php endwhile;?>
            </select>
            <div class="input-half">
                <input class="input" type="number" placeholder="Broj soba" name="room_number">
                <input class="input" type="number" placeholder="Broj ljudi" name="people_number">
            </div>
            <input class = "input" placeholder = "Cena" name = "price">
            
            <label for="">Tip ponude</label>
            <select class="input" name="offer_type">
                <option value=0>Kuca</option>
                <option value=1>Stan</option>
            </select>
            <label for="">Parking?</label>
            <select name="parking" class="input">
                <option value=1>Da</option>
                <option value=0>Ne</option>
            </select>
            <label for="">Internet?</label>
            <select name="internet" class="input">
                <option value=1>Da</option>
                <option value=0>Ne</option>
            </select>
            <label for="">Dozvoljeno pusenje?</label>
            <select class="input" name="smoking">
                <option value=1>Da</option>
                <option value=0>Ne</option>
            </select>
            <textarea name="description" class="input" placeholder="Opis"></textarea>
            <h3>Galerija slika(najvise 4)</h3>
            <div class="gallery">
                <label class="upload-btn" for="image1">Slika 1</label>
                <input type="file" class="image-upload" name='images[]' multiple id="image1">
            </div>
            
            <button type="submit" class="submit-btn">Kreiraj ponudu</button>
            <input type="hidden" class="image-upload" name="create_offer" value=1>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src = "js/seller.js"></script>
</body>

</html>