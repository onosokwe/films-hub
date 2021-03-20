<?php 
session_start();
if(isset($_SESSION['customer'])){header('location: ./cart');}
include('apps/api.php');
$error = array();
if(isset($_POST['login'])){
    $email = $is_valid->valid_email($_POST['email']);
    $pass = trim($_POST['password']);
    if($email && $pass !== FALSE){
        $res = $app->isEmailRegistered($email);
        if($res){
            $user = $app->isEmailPasswordMatch($email, $pass);
            if($user){
                $userid = $user[0];
                $stat = $user[5];
                $level = $user[6];
                if($stat === '1' && $level === '1'){
                    $_SESSION['admin'] = $user;
                    header('location: ./admin');
                } elseif($stat === '1' && $level === '2'){
                    $_SESSION['customer'] = $user;
                    header('location: ./cart'); 
                } else array_push($error, 'An error occured. Please try again.');
            } else array_push($error, 'Invalid email or password');
        } else array_push($error, 'Incorrect email or password');
    } else array_push($error, 'Email or password empty');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="icon" type="text/image" href="files/img/logo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Films Hub - PHP Based Website with MySQL Database for Software Developer/Tutor Test</title>
	<link rel="stylesheet" href="files/css/plugin.css">
	<link rel="stylesheet" href="files/css/font-awesome.min.css">
	<link rel="stylesheet" href="files/css/styles.css">
	<meta name="description" content="Films Hub displays a plethora of films from which visitors can search and purchase. Built with PHP and MySQL for BrilloConnectz Software Developer/Tutor Test">
	<meta name="keywords" content="films, genres, movies, latest movies, latest action movies">
	<script src="files/js/jquery.js"></script>
	<script src="files/js/plugin.js"></script>
</head>
<body>
    <section class="login">
        <div class="container">
            <div class="account">
                <h1>Please Login</h1>
                <form method="post">
                    <p class="text-danger"><?php if($error){echo $error[0];} ?></p>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="login" class="btn" value="Login">
                        </div>
                    </div>
                </form>
                <div class="form_links">
                    <p>Forgot your Password? <a href="./reset">Reset it</a></p>
                    <p>Not registered yet? <a href="./signup">Create Account</a></p>
                    <span></span>
                    <p>By logging in, you have agreed to abide by the FilmsHub <a href="#">terms</a> and <a href="#">privacy policy</a>.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>