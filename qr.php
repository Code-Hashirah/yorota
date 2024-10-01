<?php
include('db.php');
require_once "header.php";
$title="My QR Code";
require_once "navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'];
    
    // Search by chassis number or plate number
    $sql = "SELECT * FROM tricycle_riders WHERE chassis_number = '$input' OR plate_number = '$input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();
        $qrFilePath = 'qrcodes/' . $rider['chassis_number'] . '.png';

        if (file_exists($qrFilePath)) {
            echo "<h3>QR Code for {$rider['name']}:</h3>";
            echo "<img src='$qrFilePath' alt='QR Code'><br>";
            echo "<a href='$qrFilePath' download>Download QR Code</a>";
        } else {
            echo "QR code not generated yet.";
        }
    } else {
        echo "No rider found with this chassis or plate number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download QR Code</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
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
  <img src="assets/ride2.webp" alt="rider2" class="d-block img img w-100 h-25">
  </div>
  <div class="carousel-item">
  <img src="assets/ride3.webp" alt="rider3" class="d-block img img w-100 h-25">
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
    <h2>Download Your QR Code</h2>
    <form method="post">
        Enter Chassis or Plate Number: <input type="text" name="input" required>
        <input type="submit" value="Submit">
    </form>

    <?php
    require_once "footer.php";
    ?>
</body>
</html>
