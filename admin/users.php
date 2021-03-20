<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Users</title>
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
        <h1>All <span> Users</span></h1>
        <div class="col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control" id="search" onkeyup="Searcher()" placeholder="Search by User ID">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
                <?php $n = 0; $call = $app->getUsers(); if($call !=""){ ?>
                <thead><tr><th>SN</th><th>Name</th><th>UserID</th><th>Email</th><th>DateofBirth</th><th>UserAddress</th></tr></thead>
                <tbody><?php if($call){ while($fetch = mysqli_fetch_object($call)){ ?>
                <tr><td><?php echo ++$n ?> </td>
                    <td><?php echo $fetch->user_name ?> </td>
                    <td><?php echo htmlspecialchars_decode($fetch->user_id) ?> </td>                    
                    <td><?php echo htmlspecialchars_decode($fetch->user_email) ?> </td>
                    <td><?php echo htmlspecialchars_decode($fetch->user_bday) ?> </td>
                    <td><?php echo htmlspecialchars_decode($fetch->user_address) ?> </td>
                </tr>
                <?php }}} else echo "<span class='myerror'>No User Found.</span>";?>
            </tbody>
            </table>
        </div>
    </div>
</section>    
<script src="js/active.js"></script>
</body>
</html>
