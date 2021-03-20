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

	<section class="search_bar">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="" method="post">
						<div class="row">
							<div class="col-12">
								<div class="">
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Film title" aria-label="Film title" aria-describedby="button-addon2">
										<div class="input-group-append">
											<button class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

 	<section class="home_items">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h4>Movies</h4>
					<div class="ecoms">
						<?php $call2 = $app->films(); if($call2 !=""){if($call2){while($fetch2 = mysqli_fetch_object($call2)){ ?>
	                    <div class="ecom" title="<?php echo $fetch2->film_title ?>">
	                    	<div class="ecom_img">
	                    		<img src="<?php if($fetch2->film_avatar){echo $fetch2->film_avatar;}else {echo "./files/img/item1.png";} ?>" class="img-fluid" alt=" " />
	                    	</div>
	                    	<div class="ecom_body">
	                    		<h4 title="<?php echo $fetch2->film_title ?>">
	                    			<?php echo $fetch2->film_title ?>
	                    		</h4>
	                    		<p>$<?php echo number_format($fetch2->film_price,2) ?> | <span><?php echo $fetch2->film_year ?></span></p>
	                    		<form method="post">
	                    			<input type="hidden" name="id" value="<?php echo $fetch2->film_id ?>">
                            		<input type="hidden" name="title" value="<?php echo $fetch2->film_title ?>">
                            		<input type="hidden" name="year" value="<?php echo $fetch2->film_year ?>">
		                            <input type="hidden" name="price" value="<?php echo $fetch2->film_price ?>">
		                            <input type="hidden" name="avatar" value="<?php echo $fetch2->film_avatar ?>">
		                            <input type="hidden" name="genre" value="<?php echo $fetch2->film_genre ?>">
	                    			<button name="create_cart" class="btn">Add To Cart</button>
	                    		</form>
	                    	</div>
	                    </div>
	                    <?php }}} else {echo "
	                    <div class='text-center'>
	                    	<div class='text-center loading'>&nbsp;</div>
	                    </div>";}?>
	                </div>
				</div>
			</div>
		</div>
	</section>

	<script src="files/js/custom.js"></script>
</body>
</html>