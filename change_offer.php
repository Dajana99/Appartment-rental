<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izmena ponude</title>
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
        $offer_id = $_GET['offer'];
        $query = "SELECT offers.*,cities.name as 'city_name' FROM offers INNER JOIN cities on cities.id = offers.city_id WHERE offers.id = $offer_id";
        $offer = $database->query($query)->fetch_assoc();
        $seller_id = $_SESSION['user_id'];
        if($seller_id != $offer['seller_id']){
            header('location: seller.php');
        }
    ?>
    <div class="container">
        <h1 class = "bf text-center">Izmena ponude</h1>
        <form action="index.php" method = "post" class = "edit-form">
            <label>Naziv ponude</label>
            <input class="input" type="text" placeholder="Naziv ponude" name="offer_name" value = "<?php echo $offer['offer_name']?>">
            <?php 
                $query = "SELECT * FROM cities";
                $results = $database->query($query);
            ?>
            <label>Lokacija</label>
            <select name="city" class="input">
                <?php while($row = $results->fetch_assoc()):?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php endwhile;?>
            </select>
                <label for="room_number">Broj soba</label>
                <input id = "room_number" class="input" type="number" placeholder="Broj soba" name="room_number" value = "<?php echo $offer['room_number']?>">
                <label for = "people_number">Broj ljudi</label>
                <input id = "people_number" class="input" type="number" placeholder="Broj ljudi" name="people_number" value = "<?php echo $offer['people_number']?>">

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
            <textarea name="description" class="input" placeholder="Opis"><?php echo $offer['description']?></textarea>
            <button type="submit" class="submit-btn mx-auto">Azuriraj ponudu</button>
            <input type="hidden" name="edit_offer" value=1>
            <input type="hidden" name="offer_id" value="<?php echo $offer_id;?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
        </form>
    </div>
    
</body>
</html>