<?php 
session_start(); $count = ''; $empty = '';
if(isset($_SESSION["brillo_cart"])){
	$count = count($_SESSION["brillo_cart"]);
} 
include('apps/api.php'); ?>
<!DOCTYPE html>
<html>
<head id="home">
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
	<?php include('files/inc/head.php') ?>

 	<section class="profile_page">
		<div class="container bg-white">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-left">
					<h1>Your Order History</h1>
					<?php if(!empty($_SESSION["customer"])){ ?>
						<table class="table table-bordered table-hover" id="myTable">
			                <?php $n = 0; $call = $app->getUserOrders($_SESSION["customer"][3]); if($call !=""){ ?>
			                <thead><tr><th>SN</th><th>OrderID</th><th>FilmID</th><th>Title</th><th>Year</th><th>Price</th><th>Genre</th><th>UserID</th><th>UserAddress</th><th>Date</th><th>Time</th></tr></thead>
			                <tbody><?php if($call){ while($fetch = mysqli_fetch_object($call)){$place = $fetch->sn ?>
			                <tr><td><?php echo ++$n ?> </td>
			                    <td><?php echo $fetch->order_id ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->film_id) ?> </td>                    
			                    <td><?php echo htmlspecialchars_decode($fetch->film_title) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->film_year) ?> </td>
			                    <td>$<?php echo htmlspecialchars_decode(number_format($fetch->film_price,0)) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->film_genre) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->user_id) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->user_address) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->ordered_on) ?> </td>
			                    <td><?php echo htmlspecialchars_decode($fetch->ordered_at) ?> </td>
			                </tr>
			                <?php }}} else echo "<span class='myerror'>No Order Found.</span>";?>
			            </tbody>
			            </table>
                    <?php } else echo "<div class='myerror'>No Order Found.</div>";?>
				</div>
			</div>
		</div>
	</section>
</body>
</html>