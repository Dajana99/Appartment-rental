<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uloguj se</title>
    <title>Iznajmljivanje nektretnina</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,800;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
    body {
        overflow: hidden;
    }
</style>

<body>
    <header class="header">
        <div class="main-header">
            <h1>Iznajmljivanje nekretnina</h1>
        </div>
    </header>
    <?php session_start()?>
    <div class="container">
        <?php if(!empty($_SESSION['errors'])):?>
        <div class='errors'>
            <?php foreach($_SESSION['errors'] as $error):?>
            <div class="error">
                <h4 class="text-center"><?php echo $error?></h4>
            </div>
            <?php endforeach?>
        </div>
        <?php endif;?>
    <?php $_SESSION['errors'] = []?>
        <h1 class="text-center bf">Uloguj se</h1>
        <form class="input-group" action="index.php" method="POST">
            <input class="input" type="text" placeholder="Korisnicko ime / E-mail adresa" name="username">
            <input class="input" type="password" placeholder="Lozinka" name="password">
            <h3 class="text-center">Nemate nalog? Registrujte se <a href="register.php">ovde.</a></h3>
            <button class="submit-btn" type="submit"> Uloguj se</button>
            <input type="hidden" name="login" value="1">
        </form>
    </div>
</body>

</html>