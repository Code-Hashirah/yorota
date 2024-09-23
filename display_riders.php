<?php
include('db.php');
require('qrcode/lib/qrlib.php');

$sql = "SELECT * FROM tricycle_riders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tricycle Riders</title>
</head>
<body>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Plate Number</th>
        <th>Chassis Number</th>
        <th>Picture</th>
        <th>Payment Status</th>
        <th>Generate QR Code</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['phone_number']; ?></td>
        <td><?= $row['plate_number']; ?></td>
        <td><?= $row['chassis_number']; ?></td>
        <td><img src="<?= $row['picture']; ?>" width="100" height="100"></td>
        <td><?= $row['payment_status']; ?></td>
        <td>
            <form action="generate_qr.php" method="POST">
                <input type="hidden" name="chassis_number" value="<?= $row['chassis_number']; ?>">
                <input type="submit" value="Generate QR Code">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
