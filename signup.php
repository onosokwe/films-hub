<?php include('apps/api.php'); ?>
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
            <div class="account" style="max-width: 500px;">
                <h1>Sign Up</h1>
                <form method="post">
                    <p class="text-danger"><?php if($response){echo $response[0];} ?></p>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter your full name" id="name" class="form-control" value="<?php if(isset($_POST['signup'])){echo $_POST['name']; } ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Enter your email" id="email" class="form-control" value="<?php if(isset($_POST['signup'])){echo $_POST['email']; } ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" name="address" placeholder="Enter your Address" id="address" class="form-control" value="<?php if(isset($_POST['signup'])){echo $_POST['address']; } ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control form-select" value="<?php if(isset($_POST['signup'])){echo $_POST['dob']; } ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Choose a password" id="password" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password2" placeholder="Confirm password" id="password" class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="signup" class="btn" value="Signup">
                        </div>
                    </div>
                </form>
                <div class="form_links">
                    <p>Have an account? <a href="./login">Login</a></p>
                    <span></span>
                    <p>By logging in, you have agreed to abide by the FilmsHub <a href="#">terms</a>.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>