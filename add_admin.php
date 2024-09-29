<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
<div class="container mt-5">
    <h2>Add New Admin</h2>
    <a href="signup.php" class="btn btn-primary">Go to Signup</a>
</div>
</body>
</html>
