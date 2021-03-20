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
				<div class="col-md-6 col-sm-12 text-left">
					<h1>Your Profile</h1>
					<?php if(!empty($_SESSION["customer"])){ ?>
						<?php $details = $app->getUser($_SESSION["customer"][3]); if($details !=""){ ?>
                        <div class="row">
                            <?php if($details){while($pol = mysqli_fetch_object($details)){ ?>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tbody>        
                                            <tr><th>UserID</th><td><?php echo $pol->user_id ?></td></tr>
                                            <tr><th>Username:</th><td><?php echo $pol->user_username  ?></td></tr>
                                            <tr><th>Full Name:</th><td><?php echo $pol->user_name ?></td></tr>
                                            <tr><th>Email:</th><td><?php echo $pol->user_email ?></td></tr>
                                            <tr><th>Birthday:</th><td><?php echo $pol->user_bday ?></td></tr>
                                            <tr><th>Address:</th><td><?php echo $pol->user_address ?></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    <?php } else echo "<div class='myerror'>No Detail Found.</div>";?>
        		<?php } ?>
				</div>
				<div class="col-md-6 col-sm-12 text-left">
					<a href="#" class="btn pull-right" data-toggle="modal" data-target="#myModal">Change Password</a>
					<h1>Update Profile</h1>
					<?php if(!empty($_SESSION["customer"])){ ?>
						<?php $details = $app->getUser($_SESSION["customer"][3]); if($details !=""){ ?>
							<?php if($details){while($pol = mysqli_fetch_object($details)){ ?>
								<?php if($result){echo $result[0];} ?>
					<form method="POST" action="">
                        <div class="row">
                        	<div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label id="email">Your Email</label>
                                    <input class="form-control" id="email" readonly type="email" value="<?php echo $pol->user_email ?>" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label id="userid">Your Username</label>
                                    <input class="form-control" id="userid" readonly type="text" value="<?php echo $pol->user_username ?>" />
                                </div>
                            </div>
                        	<div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label id="name">Your Name</label>
                                    <input class="form-control" name="name" required type="text" placeholder="Your Name" value="<?php echo $pol->user_name ?>" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label id="bday">Your Birthday</label>
                                    <input class="form-control" name="bday" id="bday" required type="date" value="<?php echo $pol->user_bday ?>" >
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label id="address">Your Address</label>
                                    <input  class="form-control" name="address" id="address" required type="text" value="<?php echo $pol->user_address ?>" >
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-submit" name="save_user" value="<?php echo $_SESSION["customer"][3] ?>">UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php }} ?>
                    <?php } else echo "<div class='myerror'>No Detail Found.</div>";?>
        		<?php } ?>
				</div>
	        </div>
		</div>
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-left">Change Your Password</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body text-left">
						<form method="POST" action="">
	                        <div class="row">
	                            <div class="col-md-12 col-sm-12">
	                                <div class="form-group">
	                                    <label id="cpass">Your Current Password</label>
	                                    <input class="form-control" name="cpass" required type="password" placeholder="Your Current Password" >
	                                </div>
	                            </div>
	                            <div class="col-md-12 col-sm-12">
	                                <div class="form-group">
	                                    <label id="npass">Your New Password</label>
	                                    <input  class="form-control" name="npass" required type="password" placeholder="Your New Password">
	                                </div>
	                            </div>
	                            <div class="col-md-12 col-sm-12">
	                                <div class="form-group">
	                                    <label id="cnpass">Your Retype Password</label>
	                                    <input  class="form-control" required type="password" name="cnpass" placeholder="Retype Your New Password">
	                                </div>
	                            </div>
	                            <div class="col-md-12 col-sm-12">
	                                <div class="form-group">
	                                    <button class="btn btn-submit" name="save_user_pass" value="<?php echo $_SESSION["customer"][3] ?>">SAVE CHANGES </button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>