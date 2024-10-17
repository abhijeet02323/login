<?php
session_start();

// Load existing users from a file (assuming 'users.json' has user details)
$users = json_decode(file_get_contents('users.json'), true);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists with matching email and password
    foreach ($users as $username => $userData) {
        if ($userData['email'] == $email && $userData['password'] == $password) {
            // Store user information in session
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['mobile'] = $userData['mobile'];

            // Redirect to a welcome page after successful login
            header("Location: welcome.php");
            exit();
        }
    }

    // If login fails, redirect back to the login page with an error message
    header("Location: index.html?error=Invalid credentials");
    exit();
}
?>
