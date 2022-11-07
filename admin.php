<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php session_start()?>
    <?php 
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
            header("location: home.php");
        }
    ?>
    <?php include('nav.php')?>
    <div class="container">
        <h1 class="bf text-center">
            Lista korisnika
        </h1>
        <?php
            $database = mysqli_connect('localhost','root','','appartment_rental');
            $query = "SELECT * FROM users";
            $results = $database->query($query);
        ?>
        <div class="users">
            <?php while($row = $results->fetch_assoc()):?>
            <div class="user">
                <form action="index.php" method="post" id = "account-edit">
                <input class = "edit-input" type = hidden name = "user_id" value = "<?php echo $row['id']?>">
                <input class = "edit-input" type = text name = "username" value = "<?php echo $row['username']?>">
                <input class = "edit-input" type = text name = "first_name" value = "<?php echo $row['first_name']?>">
                <input class = "edit-input" type = text name = "last_name" value = "<?php echo $row['last_name']?>">
                <input class = "edit-input" type = email name = "email" value = "<?php echo $row['email']?>">
                <input class = "edit-input" type = "hidden" name = "edit_account" value = "1">
                </form>
                <div class="account-buttons">
                    <button class="account-button" id = "edit-button">
                        Izmeni
                    </button>
                    <a href = "delete_user.php?user_id=<?php echo $row['id']?>" class = "account-button">Ukloni</a>
                </div>
            </div>
            <?php endwhile;?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src = "js/admin.js"></script>
</body>
</html>