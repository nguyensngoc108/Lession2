<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_login";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate form data (you can add additional validation if needed)
    if (empty($username) || empty($password)) {
        $failure = "Username and password are required";
    } else {
        // Hash the password
        $hashedPassword = hash('sha256', $password);
        
        // Insert user account into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        
        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $failure = "Error: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container1">
        <h1>Register an Account</h1>
        <?php if(isset($failure)) {
            echo '<p style="color: red;">' . htmlentities($failure) . "</p>\n";
        } ?>

        <br>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username"><br/>
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"><br/>
            <br>
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</body>
</html>
