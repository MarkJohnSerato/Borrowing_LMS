<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'library') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Assistant Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h2>Welcome to the Library Assistant Dashboard</h2>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
            <p>Here you can perform library assistant tasks.</p>
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>