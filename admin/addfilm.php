<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:./');}
include('../apps/api.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Films</title>
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
        <a href="./addfilms"><button class="btn pull-right"> VIEW FILMS</button></a>
        <h1>Add <span>Film</span></h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <p><?php if($result){echo $result[0];}?></p>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="title">Film Title</label>
                        <input type="text" name="title" placeholder="Film title" id="title" class="form-control" required  />
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="year">Year of Release</label>
                        <select name="year" class="form-control form-select">
                            <option selected value="0">Choose A Year</option>
                            <?php for($y = 1930; $y <= date('Y'); $y++){ ?>
                            <option value="<?php echo $y ?>"><?php echo $y ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="price">Film Price</label>
                        <input type="number" name="price" placeholder="Film price" id="price" class="form-control" required />
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="avatar">Film Avatar</label>
                        <input type="file" name="image" id="avatar" class="form-control" required />
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="genre">Film Genre</label>
                        <select name="genre" id="genre" class="form-control form-select">
                            <option selected value="0">Select Genre...</option>
                            <?php $items = $app->getGenres(); if($items !=""){ ?>
                            <?php if($items){while($item = mysqli_fetch_object($items)){ ?>
                            <option required value='<?php echo $item->genre_name ?>'><?php echo $item->genre_name ?></option>
                            <?php }}} else echo "<option value='0'>No Genre.</option>"; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_film" class="btn btn-submit">SUBMIT FILM</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>