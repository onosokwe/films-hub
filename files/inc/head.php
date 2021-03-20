<header class=" fixed-top">
    <div class="topnav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="./cart"><i class="fa fa-shopping-cart"></i> Cart <?php if($count){echo "<span> $count </span>";} ?></a>
                    <?php if(isset($_SESSION['customer'])){echo "<a href='./profile'>". $_SESSION['customer'][2]. "</a>";} else echo "<a href='./login'>Login</a>"; ?>
                    <?php if(isset($_SESSION['customer'])){echo "<form method='post' style='display:inline'><button name='logout' class='logout'>Logout</button></form>";} else echo "<a href='./signup'>Create Account</a>"; ?>
                    <a href="./films" class="mobile">Films</a>
                    <a href="./genres" class="mobile">Genres</a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-sm mynavbar">
        <div class="container">
            <a class="navbar-brand" href="./"><img src="./files/img/logo.png" height="45" width="auto" class="img-responsive"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="./">Films</a></li>
                    <li class="nav-item"><a class="nav-link" href="./genres">Genres</a></li>
                    <?php if(isset($_SESSION['customer'])){echo "<li class='nav-item'><a href='./profile' class='nav-link'>Profile</a>";} ?>
                    <?php if(isset($_SESSION['customer'])){echo "<li class='nav-item'><a href='./history' class='nav-link'>History</a>";} ?>
                </ul>
            </div>
        </div>
    </nav>
</header>


