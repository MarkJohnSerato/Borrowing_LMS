<?php
session_start();
// Database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User Log-in
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the username, password, and role match
    $loginQuery = "SELECT * FROM user WHERE username='$username' AND password='$password' AND role='$role'";
    $loginResult = $conn->query($loginQuery);

    if ($loginResult->num_rows > 0) {
        $user = $loginResult->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on user role
        switch ($user['role']) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'library':
                header("Location: library.php");
                break;
            case 'user':
                header("Location: user.php");
                break;
            default :
                header("Location: login.php");
                break;
        }
        exit();
    } else {
        header("Location: login.php?error=username");
        exit();
    }
}


// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Authentication</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>  <!-- Where the form start -->
    <div class="container">
        <div class="form-container">
            <h2>Sign In</h2>
            <form method="post" action="login.php">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>User Role:</label>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="library">Library Assistant</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error === 'username') {
                            echo '<p class="error">Incorrect Username, Password or Role. Please try again.</p>';
                        }
                    }
                ?>
                <div class="form-group">
                    <input type="submit" name="login" value="Log In"> <!-- Submit button -->
                </div>
                <p>Don't Have an Account? Please <a href="signup.php">Sign up.</p></a>
            </form>
        </div>
    </div>
</body>
</html>