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
					<h1>Complete Your Order</h1>
				</div>
				<?php if (isset($_SESSION["checkout"])) { ?>
				<div class="col-md-12 col-sm-12">
	            	<div class="buybox" style="max-width: 350px; margin: 0 auto;">
		                <h3>$ <?php echo number_format($_SESSION["checkout"][2],2) ?> </h3>
		                <div class="pox">               
		                    <p><i class="fa fa-shopping-cart"></i> <?php echo $_SESSION["checkout"][3] ?> item(s) </p>
		                    <p><i class="fa fa-bullseye"></i> Order ID: <?php echo $_SESSION["checkout"][0] ?> </p>
		                    <p><i class="fa fa-envelope-o"></i> Delivery Email: <?php echo $_SESSION["checkout"][1] ?> </p>
		                    <p><b><i class="fa fa-calendar-o"></i> Purchase Date:</b> <?php echo date('Y-m-d') ?></p>
                        	<p><b><i class="fa fa-clock-o"></i> Purchase Time:</b> <?php echo date('h:i:s a',)?> </p>
		                </div>
		                <form method="post">
		                    <script src="https://js.paystack.co/v1/inline.js"></script>
		                    <button <?php if(!isset($_SESSION['checkout'])){echo "disabled";} ?>  onclick="payWithPaystack()" name="checkout" class="btn">PAY NOW</button>
		                </form>
		                <script>
                        function payWithPaystack(){
                            var handler = PaystackPop.setup({
                            key: 'ENTER YOUR KEY HERE',
                            email: '<?php echo $_SESSION['checkout'][1] ?>',
                            amount: <?php echo $_SESSION['checkout'][2] ?>00,
                            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                            callback: function(response){
                                // alert('success. transaction ref is ' + response.reference);
                                if(response.reference){
                                    $.ajax({
                                        method:'POST',
                                        url:'process.php',
                                        data:{dat:response.reference, key:1},
                                        dataType:'text',
                                        success:function(data) {
                                            window.location.href= '';
                                        },
                                          complete:()=>{}
                                        })
                                    }
                                },
                            });
                            handler.openIframe();
                        }
                        </script>
		             </div>
	            </div>
	            <?php } else { ?>
                <div class="col-md-12 text-center empty">
                    <img src="files/img/empty-cart.png" class="img-fluid">
                    <p>Nothing here!</p>
                </div>
            	<?php } ?>
	        </div>
		</div>
	</section>

</body>
</html>