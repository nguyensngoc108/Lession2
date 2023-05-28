<?php
function authenticateUser($conn, $username, $password) {
    // Validate form data (you can add additional validation if needed)
    if (empty($username) || empty($password)) {
        return "Username and password are required";
    } else {
        // Hash the password
        $hashedPassword = hash('sha256', $password);

        // Check if the user exists in the database
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            return true; // Authentication successful
        } else {
            return "Invalid username or password";
        }
    }
}
?>
