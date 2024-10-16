<?php
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // Load existing users from a file
    $users = json_decode(file_get_contents('users.json'), true);

    // Check if the username already exists
    if (isset($users[$username])) {
        $error = "Username already exists!";
    } else {
        // Add new user to the users array
        $users[$username] = [
            "email" => $email,
            "mobile" => $mobile,
            "password" => $password
        ];

        // Save updated users to the file
        file_put_contents('users.json', json_encode($users));

        // Automatically log in the user after signup
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;

        // Redirect to welcome page
        header("Location: welcome.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Sign Up</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" name="mobile" id="mobile" required><br><br>

        <input type="submit" name="submit" value="Sign Up">
    </form>

    <p>Already have an account
