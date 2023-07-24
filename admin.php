<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p>Here you can perform admin tasks.</p>
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>