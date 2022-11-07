
<header class="header">
    <div class="main-header">
        <h1 class="title"><a href="home.php">Iznajmljivanje nekretnina</a></h1>
        <?php if(isset($_SESSION['username'])):?>
        <div class="user-info">
            <ul class="account-actions">
                <?php if($_SESSION['role'] == 'admin'):?>
                <li><a href="admin.php" class="link">Admin</a></li>
                <li><a href="admin-create-user.php" class="link">Kreiraj korisnika</a></li>
                <?php endif?>
                <?php if($_SESSION['role'] == 'user'):?>
                <li><a class="link" href="account.php"><?php echo $_SESSION['username']?></a></li>
                <?php endif?>
                <?php if($_SESSION['role'] == 'subadmin'):?>
                <li><a class="link" href="seller.php"><?php echo $_SESSION['username']?></a></li>
                <?php endif?>
                <li><a class="link" href="logout.php">Odjavi se</a></li>

            </ul>
        </div>
        <?php else:?>
        <div class="login">
            <ul class="nav-login">
                <li><a href="login.php" class="link">Ulogujte se</a></li>
                <li><a href="register.php" class="link">Registrujte se</a></li>
            </ul>
        </div>
        <?php endif;?>
    </div>
    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'guest')):?>
    <nav class="nav">
        <ul>
            <li><a href="#" class="link" id=1>Apartmani</a></li>
            <li><a href="#" class="link" id=0>Kuce</a></li>
        </ul>
    </nav>
    <?php endif?>
</header>