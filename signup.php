<?php
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

// (Registration)
if(isset($_POST['signup'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];


   // Check if the username already exists
   $checkQuery = "SELECT * FROM user WHERE username='$username'";
   $checkResult = $conn->query($checkQuery);

   if ($checkResult->num_rows > 0) {
       echo "Username already exists. Please choose a different username.";
   } else {
       // Insert the new user into the database
       $insertQuery = "INSERT INTO user (f_name, l_name, contact_number, gender, birthdate, username, password, role) VALUES ('$f_name', '$l_name', '$contact_number','$gender','$birthdate', '$username', '$password', '$role')";
       if ($conn->query($insertQuery) === TRUE) {
           echo "Registered successfully!";
       } else {
           echo "Error registering user: " . $conn->error;
       }
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
<body>

<div class="container"> <!-- container of the form to display at center-->
<div class="form-container"> <!-- inside the form -->
            <h2>User Registration</h2>
            <form method="post" action="signup.php">

            <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name="f_name" required>
                </div>

                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" name="l_name" required>
                </div>

                <div class="form-group">
                    <label>Contact Number :</label>
                    <input type="text" name="contact_number" required>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <input type="radio" name="gender" value="male" required> Male
                    <input type="radio" name="gender" value="female" required> Female
                </div>

                <div class="form-group">
                    <label>Birthdate:</label>
                    <input type="date" name="birthdate" required>
                </div>



                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                
                <!-- Dropdown Button -->
                <div class="form-group">
                    <label>User Role:</label>

                    <!-- Inside of the Dropdown -->
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="library">Library Assistant</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="signup" value="Sign Up"> <!-- sign up button -->
                </div>
                <p>Already Have an Account? Please <a href="login.php">Log in.</p></a>
            </form>
        </div>
        </body>
        </html>