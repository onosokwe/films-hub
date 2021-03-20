<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Films</title>
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
    	<a href="./addfilm" class="btn pull-right"> ADD FILM </a>
        <h1>All <span>Films</span></h1>
        <p><?php if($result){echo $result[0]; } ?></p>
        <div class="col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control" id="search" onkeyup="Searcher()" placeholder="Search by Genre">
            </div>
        </div>
        <div class="table-responsive">
            <?php $n = 0; $call = $app->films(); if($call !=""){ ?>
            <table class="table table-hover table-bordered" id="myTable">
                <thead><tr><th>SN</th><th>Genre</th><th>Title</th><th>Avatar</th><th>Year</th><th>Posted On</th><th>Action</th></tr></thead>
                <tbody><?php if($call){while($fetch = mysqli_fetch_object($call)){ $place = $fetch->film_id ?>
                    <tr style="text-transform: capitalize;">
                        <td><?php echo ++$n ?></td>
                        <td><?php echo $fetch->film_genre ?></td>
                        <td><?php echo $fetch->film_title ?></td>
                        <td><img src="<?php if($fetch->film_avatar){echo $fetch->film_avatar;} else echo "";?>" height="30" alt=" " /></td>
                        <td><?php echo $fetch->film_year ?></td>
                        <td><?php echo $fetch->created_on ?> <?php echo $fetch->created_at ?></td>
                        <td><a href="" class="btn">EDIT</a>
		                    <?php if ($fetch->status == '1'){?>
                            <form method="post"><button type="submit" name="del_film" class="btn btn-delete" value="<?php echo $place ?>"> DELETE </button></form>
		                    <?php } ?>
		                </td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
            <?php } else echo "<span class='myerror'>No Film found.</span>";?>
        </div>
    </div>
</section>

</body>
</html>