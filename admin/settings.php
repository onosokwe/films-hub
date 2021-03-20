<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Settings</title>
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
        <h1>Settings: <span>Your Profile</span></h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
                <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Last Login</th></tr></thead>
                <tbody><?php $call = $intanciate->ogaadmin(); if($call !=""){if($call){while($fetch = mysqli_fetch_object($call)){ ?>
                <tr>
                    <td><?php echo $fetch->uname ?> <?php echo $fetch->gname ?> </td>
                    <td><?php echo $fetch->uzer ?> </td>
                    <td><?php echo $fetch->phone ?> </td>
                    <td><?php echo date("jS M Y, h:ia", $fetch->lastseen); ?> </td>
                </tr>
                <?php }}};?>
            </tbody>
            </table>
        </div>
    </div>
</section>
    
<section class="container">
    <div class="lord">
        <h1>Settings: <span>Change Password</span></h1>        
        <?php $call = $intanciate->ogaadmin(); if($call !=""){if($call){ while($fetch = mysqli_fetch_object($call)){ ?>
        <div class="myerror"><?php if ($opEmpty){echo $opMsg;} elseif ($npEmpty){echo $npMsg;} elseif ($cpEmpty){echo $cpMsg;} elseif ($opInc){echo $opIncMsg;} elseif ($onMismatch){echo $onMisMsg; } ?></div>
        <div class="mysuccess"><?php if ($pwSuccess){echo $pwSucMsg;} ?></div>
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label id="name">Your Current Password</label>
                        <input class="form-control" name="cpass" type="password" placeholder="Your Current Password" value="<?php if (isset($_POST['updatepass'])){echo ($_POST['cpass']);}?>" >
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label id="name">Your New Password</label>
                        <input  class="form-control" name="npass" type="password" placeholder="Your New Password" value="<?php if (isset($_POST['updatepass'])){echo ($_POST['npass']);}?>" >
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label id="name">Your Retype Password</label>
                        <input  class="form-control" type="password" name="cnpass" placeholder="Retype Your New Password">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-submit" name="updatepass" value="<?php echo $fetch->email ?>">SAVE CHANGES </button>
                    </div>
                </div>
            </div>
        </form>
         <?php }}} ?>
    </div>
</section>   

<script src="js/active.js"></script>
</body>
</html>