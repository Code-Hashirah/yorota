<!-- Navbar -->
<?php require "header.php" ;
    session_start();
    // echo $_SESSION['Phone'];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand text-bg-warning rounded-1" href="index.php">Tri Cycle</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="list"><a class="nav-link" href="index.php">Home</a></li>
                <li class="list"><a class="nav-link" href="qr.php">Generate QR</a></li>
            <li class="list"><a class="nav-link" href="about.php">About us</a></li>
            
                <li class="list"><a class="nav-link" href="payment.php">Payment</a></li>

    
        </ul>
        <span class="rounded-2 p-2 text-info d-flex">

        </span>
    </div>
</nav>