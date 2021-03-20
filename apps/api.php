<?php
require_once __DIR__ . '/app.php';
include_once __DIR__ . '/val.php';
include_once __DIR__ . '/fxn.php';

$app = new LAM_SHOP();
$crud = new sqlOps();
$is_valid = new VALIDATE();

date_default_timezone_set ("Africa/Lagos");

// general
$result = $response = array();

// logout customer
if(isset($_POST['logout'])){
    unset($_SESSION['customer']); 
    session_destroy(); 
    header("Location:./"); 
    exit;
}

// logout admin
if(isset($_POST['log'])){
    unset($_SESSION['admin']);
    session_destroy(); 
    header("Location:../"); 
    exit;
}

// signup
if(isset($_POST['signup'])){
    $email = $is_valid->valid_email($_POST['email']); // receive and sanitize email input
    $email = $crud->strEscape(strtolower($email)); // strip input of bad data
    $name = $is_valid->valid_string($_POST['name']); // receive and sanitize email input
    $name = $crud->strEscape(ucfirst($name)); // strip input of bad data
    $address = $is_valid->valid_string($_POST['address']); // receive and sanitize address input
    $address = $crud->strEscape(ucfirst($address)); // strip input of bad data
    $dob = $is_valid->valid_alnum($_POST['dob']); // receive and sanitize date of birth input
    $dob = $crud->strEscape($dob); // strip of bad data
    $pass = $is_valid->valid_pass($_POST['password']); // receive and sanitize password input
    $pass2 = $is_valid->valid_pass($_POST['password2']);
    if($name != FALSE){
        if($email != FALSE){
            if($dob != FALSE){
                if($pass != FALSE){
                    if($pass === $pass2){
                        $res = $app->isEmailRegistered($email);
                        if(!$res){
                            if($app->addUser($name,$email,$address,$dob,$pass)){
                                $app->sendRegisterMail($name,$email); // send a regustraton email to user
                                array_push($response, '<span class="mysuccess">Your account was created successfully.</span>');
                            } else array_push($response, '<span class="myerror">Invalid input</span>');
                        } else array_push($response, '<span class="myerror">Email is registered. Try again...</span>');
                    } else array_push($response, '<span class="myerror">Passwords do not match.</span>');
                } else array_push($response, '<span class="myerror">Password must be at least 8 characters.</span>');
            } else array_push($response, '<span class="myerror">Date of birth contains invalid input.</span>');
        } else array_push($response, '<span class="myerror">Email contains invalid input.</span>');
    } else array_push($response, '<span class="myerror">Name contains invalid input.</span>');
}

// create_cart
if (isset($_POST["create_cart"])) {
    if (isset($_SESSION["brillo_cart"])){
        $item_array_id = array_column($_SESSION["brillo_cart"], "item_id");
        if(!in_array($_POST["id"], $item_array_id)){
            $count;
            $count = count($_SESSION["brillo_cart"]);
            $item_array = array(
                'item_id' => $_POST["id"],
                'item_title' => $_POST["title"],
                'item_year' => $_POST["year"],
                'item_price' => $_POST["price"],
                'item_avatar' => $_POST["avatar"],
                'item_genre' => $_POST["genre"],
            );
            $_SESSION["brillo_cart"][$count] = $item_array;
        } else {
            echo "<script>alert ('Item already added to cart')</script>";
        }
    } else {
        $item_array = array(
            'item_id' => $_POST["id"],
            'item_title' => $_POST["title"],
            'item_year' => $_POST["year"],
            'item_price' => $_POST["price"],
            'item_avatar' => $_POST["avatar"],
            'item_genre' => $_POST["genre"],
        );
        $_SESSION["brillo_cart"]["0"] = $item_array;
    }
}

// remove_cart
if (isset($_POST["remove_cart"])) {
    $item_id = trim($_POST['this_item']);
    foreach ($_SESSION["brillo_cart"] as $keys => $values) {
        if ($values['item_id'] == $item_id) {
            unset($_SESSION["brillo_cart"][$keys]);
        }
    }
}

// save_cart
if (isset($_POST["save_cart"])) {
    if(isset($_SESSION['customer'])){
        // carts items
        $cart = $_SESSION["brillo_cart"];
        $count = count($cart);
        // user array
        $user = $_SESSION['customer'];
        $total = $_POST['total'];
        $uid = $user[0];
        $email = $user[3];
        $oid = rand(10000000,99999999); 
        $insert = $app->createOrders($oid, $uid, $email, $cart, $total);
        if($insert){
            $checkout_items = array($oid, $email, $total, $count);
            $_SESSION['checkout'] = $checkout_items;
            header('location: checkout');
        }  else array_push($response, '<span class="myerror">An error occured.</span>');
    } else {
        echo "<script>alert ('Please login to checkout ')</script>";
        echo "<script>window.location = 'login'</script>";
    }
}

// save user
if(isset($_POST['save_user'])){
    $email = $_POST['save_user'];
    $name = $is_valid->valid_string(ucwords($_POST['name']));
    $bday = $is_valid->valid_alnum($_POST['bday']);
    $address = $is_valid->valid_string(ucwords($_POST['address']));
    if($name && $bday && $address !== FALSE){
        if($app->updateUser($name,$bday, $address,$email)){
            array_push($result, '<span class="mysuccess">Details updated successfully</span>');
        } else array_push($result, '<span class="myerror">Profile Update Failed</span>');
    } else array_push($result, '<span class="myerror">Invalid input</span>');
}

// save_user_pass
if(isset($_POST['save_user_pass'])){
    $email = $_POST['save_user_pass'];
    $oldpass = $is_valid->valid_pass($_POST['cpass']);
    $newpass = $is_valid->valid_pass($_POST['npass']);              
    $connewpass = $is_valid->valid_pass($_POST['cnpass']);
    if ($oldpass !=""){
        if ($newpass !=""){
            if ($connewpass !=""){
                if($newpass === $connewpass){               
                    if($app->updatePassword($email,$oldpass,$newpass)){
                        array_push($result, '<span class="mysuccess">Password updated successfully</span>');
                    } else array_push($result, '<span class="myerror">Password Update Failed</span>');
                } else array_push($result, '<span class="myerror">Passwords do not match</span>');
            } else array_push($result, '<span class="myerror">Confirm Password invalid</span>');
        } else array_push($result, '<span class="myerror">New Password invalid</span>');
    } else array_push($result, '<span class="myerror">Old Password invalid</span>');
}


// add_genre
if(isset($_POST['add_genre'])){
    $genre = $is_valid->valid_string(ucwords($_POST['genre']));
    if($genre !== FALSE){
        if($app->addGenre($genre)){
            array_push($result, '<span class="mysuccess">Genre created successfully</span>');
        } else array_push($result, '<span class="myerror">Genre creation failed</span>');
    } else array_push($result, '<span class="myerror">Invalid input</span>');
}

// del_genre
if(isset($_POST['del_genre'])){
    $genreid = $_POST['del_genre'];
    if($genreid !== FALSE){
        if($app->delGenre($genreid)){
            array_push($result, '<span class="mysuccess">Genre deleted successfully</span>');
        } else array_push($result, '<span class="myerror">Genre deletion failed</span>');
    } else array_push($result, '<span class="myerror">Invalid input</span>');
}

// del_film
if(isset($_POST['del_film'])){
    $id = $_POST['del_film'];
    if($id !== FALSE){
        if($app->delFilm($id)){
            array_push($result, '<span class="mysuccess">Film deleted successfully</span>');
        } else array_push($result, '<span class="myerror">Film deletion failed</span>');
    } else array_push($result, '<span class="myerror">Invalid input</span>');
}


// add_film
if(isset($_POST['add_film'])){
    $title = $is_valid->valid_string(ucwords($_POST['title']));
    $year = $is_valid->valid_number($_POST['year']);
    $price = $is_valid->valid_number($_POST['price']);
    $genre = $is_valid->valid_string($_POST['genre']);
    $image = $_FILES['image']['name'];
    if($image){$imagePath = $app->uploadImages($image);} else {$imagePath = NULL;}
    if ($imagePath != NULL){
        if($title && $year && $price && $genre !=""){
            if($app->addFilm($title, $year, $price, $genre, $imagePath)){
                array_push($result, '<span class="mysuccess">Film uploaded successfully.</span>');
            } else array_push($result, '<span class="myerror">Film adding failed.</span>');
        } else array_push($result, '<span class="myerror">Invalid input</span>');
    } array_push($result, '<span class="myerror">Image upload failed</span>');
}


?> 