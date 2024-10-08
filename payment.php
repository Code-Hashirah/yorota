<?php
require_once "db.php";
require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 mt-5">Welcome to <bold class="text-success display-1">T</bold>ri  <bold class="text-warning display-1">Y</bold>ota</h1>
        <p class="lead">Tri Cycle Transport Management Platform.</p>
        <a href="qr.php" class="btn btn-primary btn-lg">Get QR <small>code</small></a>
    </div>
</section>
    <div class="container mt-5">
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
                    <img src="assets/ride1.webp" alt="rider1" class="d-block img w-100 h-25">
                </div>
                <div class="carousel-item">
                    <img src="assets/ride2.webp" alt="rider2" class="d-block img w-100 h-25">
                </div>
                <div class="carousel-item">
                    <img src="assets/ride3.webp" alt="rider3" class="d-block img w-100 h-25">
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
        <!-- End of carousel -->
        <!-- ******************************************************************************************* -->

        <!-- Payment Form -->
        <h2 class="mt-4">Enter Chassis Number to Pay</h2>
        <form action="process_payment.php" class="form active" method="POST">
    <input type="text" name="chassis_number" placeholder="Enter your chassis number">
    <input type="number" name="amount" placeholder="Enter amount">
    <input type="submit"class="btn btn-outline-info" value="Pay Now">
</form>

    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php
require_once "footer.php";
?>

</body>
</html>
