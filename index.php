<?php
$title="Home Page";
    require_once "header.php";
    require_once "db.php";
    require_once "navbar.php";
 
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4">Welcome to <bold class="text-success display-1">T</bold>ri  <bold class="text-warning display-1">C</bold>ycle</h1>
        <p class="lead">Tri Cycle Transport Management Platform.</p>
        <a href="signUp.php" class="btn btn-primary btn-lg">Get QR <small>code</small></a>
    </div>
</section>


<!-- ******************************************************************************************* -->
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>

  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="assets/farm1.webp" alt="farm1" class="d-block img w-100 h-25">
    </div>
    <div class="carousel-item">
    <img src="assets/farm5.webp" alt="farm2" class="d-block img img w-100 h-25">
    </div>
    <div class="carousel-item">
    <img src="assets/farm6.webp" alt="farm3" class="d-block img img w-100 h-25">
    </div>
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<!-- end of carousel  -->
<!-- ******************************************************************************************* -->

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row">
            <a href="proceed.php" class="col-md-4 text-decoration-none">
            <div>
                <div class="card">
                    <div class="card-body">
                        <!-- <button class="btn btn-primary">Bloom</button> -->
                        <h5 class="card-title">Easy Pay</h5>
                        <img class="card-img top" src="assets/farm2.webp" alt="farm image">
                        <p class="card-text">Easy payment.</p>
                    </div>
                </div>
            </div>
            </a>
            
            <a href="proceed.php" class="col-md-4 text-decoration-none">
                <div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Easy Tracking</h5>
                        <img class="card-img top" src="assets/farm1.webp" alt="farm image">
                        <p class="card-text">Track Payment.</p>
                    </div>
                </div>
            </div>
        </a>
            
            <a href="proceed.php" class="col-md-4 text-decoration-none">
            <div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Secure process</h5>
                        <img class="card-img top" src="assets/farm4.webp" alt="farm image">
                        <p class="card-text">Ensure reliable payment process</p>
                    </div>
                </div>
            </div>

            </a>
                </div>
    </div>
</section>

<?php
require_once "footer.php";
?>
