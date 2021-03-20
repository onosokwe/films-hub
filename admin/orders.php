<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Orders</title>
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
        <h1>All <span> Orders</span></h1>
        <div class="col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control" id="search" onkeyup="Searcher()" placeholder="Search by Order ID">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
                <?php $n = 0; $call = $app->getOrders(); if($call !=""){ ?>
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
        </div>
    </div>
</section>    
<script src="js/active.js"></script>
</body>
</html>