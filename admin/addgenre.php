<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Genre</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<link href="../files/img/logo.png" rel="icon">
<link href="../files/css/plugin.css" rel="stylesheet" type="text/css">
<link href="../files/css/styles.css" rel="stylesheet" type="text/css">
<script src="../files/js/plugin.js"></script>
<script src="../files/js/custom.js"></script>
</head>
<?php include ('inc/nav.php');?>

<body>

<section class="container">
    <div class="lord">
        <a href="./genres" class="btn pull-right"> VIEW GENRE</a>
        <h1>Add <span>Genre</span></h1>
        <form method="POST" action="">
            <p><?php if($result){echo $result[0]; } ?></p>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="genre">Genre Name</label>
			            <input type="text" name="genre" required class="form-control" placeholder="Genre Name">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
			            <button type="submit" name="add_genre" class="btn btn-submit">ADD GENRE </button>
			        </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="js/active.js"></script>
</body>
</html>