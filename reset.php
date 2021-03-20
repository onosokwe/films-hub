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
            <div class="account">
                <h1>Reset Password</h1>
                <form method="post">
                    <p class="text-danger"><?php if($response){echo $response[0];} ?></p>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Enter your email" id="email" class="form-control" value="<?php if(isset($_POST['signup'])){echo $_POST['email']; } ?>" />
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="reset" class="btn" value="Reset Password">
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