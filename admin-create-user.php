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
    <?php include('nav.php')?>
    <div class="container">
        <h1 class="bf text-center">
            Kreiraj korisnika
        </h1>
        <form class="input-group" action="index.php" method = "POST">
            <div class="input-half">
                <input class = "input" type="text" placeholder="Ime" name = "first_name">
                <input class = "input" type="text" placeholder="Prezime" name = "last_name">
            </div>
            <div class="input-half">
                <input class = "input" type="email" placeholder="E-mail adresa" name = "email">
                <input class = "input" type="text" placeholder="Potvrda e-mail adrese" name = "confirm_email">
            </div>
            <input class = "input" type="text" placeholder="Korisnicko ime" name = "username">

            <div class="input-half">
                <input class = "input input-half" type="password" placeholder="Lozinka" name = "password">
                <input class = "input input-half" type="password" placeholder="Potvrda lozinke" name = "confirm_password">
            </div>
            <label for=""><h3>Tip naloga:</h3></label>
            <select name = "role" class = "input dropdown">
                <option selected value = 'user'>Korisnik</option>
                <option selected value = 'subadmin'>Prodavac</option>
            </select>
            <button class = "submit-btn" type="submit"> Registruj korisnika</button>
            <input type = "hidden" name = "register" value = "1">

        </form>
    </div>
</body>
</html>