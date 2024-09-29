<?php
include('db.php');
require_once "header.php";
// require_once "db.php";
// require_once "navbar.php";

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

    <title>Add Tricycle Rider</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-white bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="add_rider.php">Add Rider</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_riders.php">Display Riders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_admin.php">Add Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
