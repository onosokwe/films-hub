<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reports</title>
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
        <h1>All <span> Reports</span></h1>
        <form method="POST" action="">
            <p><?php if($result){echo $result[0]; } ?></p>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label>Select Month</label>
                        <select class="form-control form-select" name="period">
                            <option selected value="0">Select Month</option>
                            <?php $start = strtotime('2021-02-01'); $end = strtotime(date('Y-m-d')); while($start <= $end) { ?> 
                            <option value="<?php $start = strtotime("+1 month", $start); echo date('Y-m', $start);?>"><?php echo date('MY', $start); ?></option><?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="monthly" class="btn btn-submit">FETCH REPORT</button>
                    </div>
                </div>
            </div>
        </form>
        <?php if(isset($_POST['monthly']) && $_POST['period'] !=="0") { ?>
            <p>Total Sales this month (<?php echo $_POST['period'] ?>): $<?php echo number_format($crud->totalSales($_POST['period']),0) ?> </p>
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
                <?php $n = 0; $call = $app->getMonthlyOrders($_POST['period']); if($call !=""){ ?>
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
        <?php } ?>
    </div>
</section>    
<script src="js/active.js"></script>
</body>
</html>