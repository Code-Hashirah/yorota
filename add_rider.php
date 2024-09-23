<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $plate_number = $_POST['plate_number'];
    $chassis_number = $_POST['chassis_number'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);

    $sql = "INSERT INTO tricycle_riders (chassis_number, name, phone_number, plate_number, picture) 
            VALUES ('$chassis_number', '$name', '$phone_number', '$plate_number', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New rider added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tricycle Rider</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Phone Number: <input type="text" name="phone_number" required><br>
        Plate Number: <input type="text" name="plate_number" required><br>
        Chassis Number: <input type="text" name="chassis_number" required><br>
        Picture: <input type="file" name="picture" required><br>
        <input type="submit" value="Add Rider">
    </form>
</body>
</html>
