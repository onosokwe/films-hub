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

 	<section class="cart_items">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Your Cart</h1>
				</div>
				<div class="col-md-8 col-sm-6">
					<div class="row">
					<?php if(!empty($_SESSION["brillo_cart"])){
						$total = 0; $name = ''; 
						foreach ($_SESSION["brillo_cart"] as $key => $values) { ?>
						<div class="col-md-6">
	                <div class="store">
	                    <div class="imgbox">
	                        <img src="<?php echo $values["item_avatar"]; ?>" class="img-fluid" alt=" ">
	                    </div>
	                    <div class="txtbox">
	                        <h2><?php echo $values["item_title"] ?></h2>
	                        <h3>$<?php echo number_format($values["item_price"], 2) ?> </h3>
	                        <p><?php echo $values['item_year'] ?></p>
	                        <div class="tag"><?php echo $values["item_genre"] ?></div>
	                        <form method="post">
	                            <input type="hidden" name="this_item" value="<?php echo $values["item_id"] ?>">
	                            <button name="remove_cart" title="Remove from Cart" class="remove"><i class="fa fa-remove"></i></button>
	                        </form>
	                    </div>
                	</div>
                </div>
	        	<?php  $total = $total + $values["item_price"];
        		} echo "</div></div> 
	        	<div class='col-md-4 col-sm-6'>"; ?>
		            <?php if($empty){echo '<span class="myerror">Something went wrong</span>';} ?>
	            	<div class="buybox">
		                <h3>$ <?php echo number_format($total,2) ?> </h3>
		                <div class="pox">               
		                    <p><i class="fa fa-shopping-cart"></i> <?php echo $count ?> item(s) in cart </p>
		                    <p><i class="fa fa-bullseye"></i> Available in hard and soft copy</p>
		                    <p><i class="fa fa-clock-o"></i> Instant soft copy delivery</p>
		                </div>
		                <form method="post">
		                    <input type="hidden" name="count" value="<?php echo $count ?>">
		                    <input type="hidden" name="ipadd" id="location" value="">
		                    <input type="hidden" name="total" value="<?php echo $total ?>">
		                    <input <?php if(!isset($_SESSION['customer'])){echo "disabled";} ?> type="submit" name="save_cart" class="btn" value="CHECKOUT">
		                </form>
		             </div>
	            <?php  } ?>
	            </div>
            	<?php if (empty($_SESSION["brillo_cart"])) { ?>
                <div class="col-md-12 text-center empty">
                    <img src="files/img/empty-cart.png" class="img-fluid">
                    <p>Your cart is empty!</p>
                </div>
            	<?php } ?>
	        </div>
		</div>
	</section>

</body>
</html>