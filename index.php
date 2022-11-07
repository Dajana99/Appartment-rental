<?php 
    $database = mysqli_connect("localhost",'root','','appartment_rental');
    session_start();
    if(isset($_POST['register'])){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $confirm_email = $_POST['confirm_email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'];
        session_start();
        $errors = [];
        if($first_name == ""){
            $error =  "Ime je obavezno <br>";
            array_push($errors,$error);
        }
        if($last_name == ""){
            $error = "Prezime je obavezno <br>";
            array_push($errors,$error);
        }
        if($email == ""){
            $error = "Email je obavezan <br>";
            array_push($errors,$error);
        }
        if($confirm_email == ""){
            $error = "Potvrda email adrese je obavezna <br>";
            array_push($errors,$error);
        }
        if($username == ""){
            $error = "Korisnicko ime je obavezno <br>";
            array_push($errors,$error);
        }
        if($password == ""){
            $error = "Lozinka je obavezna <br>";
            array_push($errors,$error);
        }
        if($confirm_password == ""){
            $error = "Potvrda lozinke je obavezna <br>";
            array_push($errors,$error);
        }
        if($email != $confirm_email){
            $error = "Email adrese se ne poklapaju <br>";
            array_push($errors,$error);
        }
        if($password != $confirm_password){
            $error = "Lozinke se ne poklapaju <br>";
            array_push($errors,$error);
        }
        if(!empty($errors)){
            $_SESSION['errors'] = [];
            array_push($_SESSION['errors'],$errors);
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
            {
            header("location: admin-create-user.php");
            }
            header("location: register.php");
        }
        else{
            $_SESSION['errors'] = [];
            $password = md5($password);
            $query = "SELECT * FROM users where username = '$username' OR email = '$email'";
            $results = $database -> query($query);
            if(mysqli_num_rows($results) > 0){
                $_SESSION['errors'] = [];
                array_push($_SESSION['errors'],'Korisnicki nalog vec postoji');
                if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                {
                    header("location: admin-create-user.php");
                }
                header("location: register.php");
            }
            else{
                $query = "INSERT INTO users(first_name,last_name,email,username,password,role) 
                        VALUES('$first_name','$last_name','$email','$username','$password','$role')
                ";
                if($database -> query($query) === TRUE){
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                    {
                        header("location: admin-create-user.php");
                    }
                    else{
                        header("location: register.php");
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $database->insert_id;
                        $_SESSION['role'] = $role;
                        header("location: home.php");
                    }
                }
                else{
                    echo $database->error;
                }
            }
        }

    }
    else if(isset($_POST['login'])){
        session_start();
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $_SESSION['errors'] = [];
        if($username == "" || $_POST['password']){
            array_push($_SESSION['errors'],'Molimo unesite validne podatke.');
            header("location:login.php");
        }
        $query = "SELECT * FROM users where (username = '$username' OR email = '$username') AND password = '$password'";
        $results = $database->query($query); 
        if(mysqli_num_rows($results) > 0){
            $_SESSION['errors'] = [];
            $results = $results->fetch_assoc();
            $_SESSION['username'] = $results['username'];
            $_SESSION['role'] = $results['role'];
            $_SESSION['user_id'] = $results['id'];

            if($results['role'] == 'user'){
                header("location: home.php");
            }
            if($results['role'] == 'subadmin'){
                header('location: seller.php');
            }
            if($results['role'] == 'admin'){
                header('location: admin.php');
            }
        }
        else{
            array_push($_SESSION['errors'], "Neuspesno logovanje");
            header("location:login.php");
        }
    }
    else if(isset($_POST['create_offer'])){
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $offer_name = $_POST['offer_name'];
        $offer_type = $_POST['offer_type'];
        $city = $_POST['city'];
        $room_number = $_POST['room_number'];
        $people_number = $_POST['people_number'];
        $parking = $_POST['parking'];
        $internet = $_POST['internet'];
        $smoking = $_POST['smoking'];
        $description = $_POST['description'];
        $images = $_FILES['images']['name'];
        $price = $_POST['price'];
        $query = "INSERT INTO offers(seller_id,offer_name,offer_type,city_id,room_number,people_number,parking,internet,smoking_allowed, description,price)
                     VALUES($user_id,'$offer_name',$offer_type,$city,$room_number,$people_number,$parking,$internet,$smoking,'$description',$price)";
        echo $query;
        if($database->query($query) === TRUE){
            $id = mysqli_insert_id($database);
            foreach ($images as $image){
                if($image != "")
                $query = "INSERT INTO offer_images(offer_id, title)
                        VALUES($id, '$image')";
                if($database->query($query) === TRUE){
                    header('location: seller.php');
                }
                else{
                    echo $database->error;
                }
            }
            $count = count($_FILES['images']['name']);
            $updloadPath = [];
            $tmpLoc = [];
            if ($count > 0) {
                for($i = 0;$i < $count; $i++){
                    $name = $_FILES['images']['name'][$i];
                    $nameArray = explode('.', $name);
                    $fileName = $nameArray[0];
                    $fileExt = $nameArray[1];
                    $tmpLoc[] = $_FILES['images']['tmp_name'][$i];
                    $updloadName = md5(microtime().$i).'.'.$fileExt;
                    $updloadPath[] = $_SERVER['DOCUMENT_ROOT'].'/house_images/'.$fileName.".".$fileExt;
                }
                for ($i=0; $i < $count; $i++) {
                    move_uploaded_file($tmpLoc[$i], $updloadPath[$i]);
                }
            }
        }
        else{
            echo $database->error;
        }
    }
    else if(isset($_POST['create_reservation'])){
        $user_id = $_POST['user_id'];
        $offer_id = $_POST['offer_id'];
        $date_start = $_POST['date_started'];
        $date_end = $_POST['date_end'];
        $payment_method = $_POST['payment'];
        $query = "INSERT INTO offer_reservations(offer_id,user_id,start_date,end_date,payment) VALUES ($offer_id,$user_id,'$date_start','$date_end',$payment_method)";
        if($database->query($query) === TRUE){
            header('location: home.php');
        }
        else{
            echo $database->error;
        }
    }
    else if(isset($_POST['get_dates'])){
        $offer_id = $_POST['offer_id'];
        $query = "SELECT start_date, end_date FROM offer_reservations where offer_id = $offer_id";
        $offers = $database->query($query);
        $offers_json = [];
        $i = 0;
        while($row = $offers->fetch_assoc()){
            $offers_json[$i] = $row;
            $i++;
        }
        echo json_encode($offers_json);
    }
    else if(isset($_POST['edit_offer'])){
        $offer_id = $_POST['offer_id'];
        $user_id = $_POST['user_id'];
        $offer_name = $_POST['offer_name'];
        $offer_type = $_POST['offer_type'];
        $city = $_POST['city'];
        $room_number = $_POST['room_number'];
        $people_number = $_POST['people_number'];
        $parking = $_POST['parking'];
        $internet = $_POST['internet'];
        $smoking = $_POST['smoking'];
        $description = $_POST['description'];
        $query = "UPDATE offers
                SET offer_name = '$offer_name',
                    offer_type = $offer_type,
                    city_id = $city,
                    room_number = $room_number,
                    people_number = $people_number,
                    parking = $parking,
                    internet = $internet,
                    smoking_allowed = $smoking,
                    description = '$description'
                WHERE id = $offer_id";
        if($database->query($query) === TRUE){
            header("location: seller.php");
        }
        else{
            echo $database->error;
        }
    }
    else if(isset($_POST['submit_review'])){
        $user_id = $_POST['user_id'];
        $offer_id = $_POST['offer_id'];
        $rate = $_POST['rate'];
        $review = $_POST['review'];
        $query = "INSERT INTO offer_reviews(user_id, offer_id, rate, review)
                    VALUES($user_id,$offer_id,$rate,'$review')";
        echo $query;
        if($database->query($query) === TRUE){
            header('location: home.php');
        }
        else{
            echo $database->error;
        }
    }
    else if(isset($_POST['edit_review'])){
        $user_id = $_POST['user_id'];
        $offer_id = $_POST['offer_id'];
        $rate = $_POST['rate'];
        $review = $_POST['review'];
        $query = "UPDATE offer_reviews
                    SET rate = $rate,
                        review = '$review'
                    WHERE user_id = $user_id AND offer_id = $offer_id";
        echo $query;
        if($database->query($query) === TRUE){
            header('location: home.php');
        }
        else{
            echo $database->error;
        }
    }
    else if(isset($_GET['search'])){
        $search_text = $_GET['search_text'];
        $query = "SELECT offers.*, cities.name as 'city_name' FROM offers INNER JOIN cities on offers.city_id = cities.id WHERE offers.name LIKE '%$search_text%' OR cities.name LIKE '%$search_text%'";
    }
    else if(isset($_POST['edit_account'])){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $user_id = $_POST['user_id'];  
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $query = "UPDATE users 
                    SET username = '$username',
                        first_name = '$first_name',
                        last_name = '$last_name',
                        email = '$email'
                    WHERE id = $user_id";
            if($database->query($query) === TRUE){
                header("location:admin.php");
            }
            else{
                echo $database->error;
            }
        }
    }
    else{
        $_SESSION['role'] = 'guest';
        header('location: home.php');
    }

?>