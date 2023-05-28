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

// Perform database operations...



?>

<?php 
include_once 'api/authentication.php';

if (isset($_POST['cancel'])){
    header("Location: index.php");
    return;
}

$failure = false;

;
    
    
if(isset($_POST['login'])){
    $name = $_POST['who'];
    $pass = $_POST['pass'];

    $result = authenticateUser($conn, $name, $pass);

    if($result === true){
        header("Location: game.php?name=".urlencode($username));
        return;
    } else {
        $failure = $result;   
}
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login here</title>
</head>
<body>
   
    <div class="container1">
       <h1>Please Log In</h1>
       <?php if($failure !== false){
        echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
    } ?>

        <br>
        <form method="POST" >
            <label for="nam">User Name</label>
            <input type="text" name="who" id="nam"><br/>
            <br>
            <label for="id_1723">Password</label>
            <input type="text" name="pass" id="id_1723"><br/>
            <input type="submit" name="login" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
    </div>
</body>
</html>


<?php $conn->close(); ?>