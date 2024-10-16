<?php
session_start();

// Load existing users from a file
$users = json_decode(file_get_contents('users.json'), true);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // Check if username and password match
    if (isset($users[$username]) && 
        $users[$username]['password'] == $password && 
        $users[$username]['email'] == $email && 
        $users[$username]['mobile'] == $mobile) {
        
        // Save user details in the session
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid credentials. Please check your details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <img src="DOSS.png" alt="Logo"  class="logo">
            <h1>DOSS MEDIATECH PVT LTD</h1>
        </div>
    </header>


    <h2>LogIn</h2>
    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form id="login-form">
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <form id="forgot-password-form">
        <input type="email" id="resetEmail" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>



    <p>Don't have an account? <a href="signup.php">Sign Up here</a>.</p>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 DOSS MEDIATECH PVT LTD. All rights reserved.</p>
        <nav>
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.14.1/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.14.1/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCt2kSAcKIG12MElivX1qPOCa3rZbL4RWo",
            authDomain: "email-42c22.firebaseapp.com",
            projectId: "email-42c22",
            storageBucket: "email-42c22.appspot.com",
            messagingSenderId: "661899538082",
            appId: "1:661899538082:web:408a0e28bf363c77c5b1fb",
            measurementId: "G-PZBKHCGHSM"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>

    <script>
        const auth = firebase.auth();

        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            auth.signInWithEmailAndPassword(email, password)
                .then(userCredential => {
                    alert('Login successful!');
                    // You can redirect users after login
                })
                .catch(error => {
                    console.error(error.message);
                    alert('Login failed: ' + error.message);
                });
        });
    </script>

    <script>
        document.getElementById('forgot-password-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('resetEmail').value;

            auth.sendPasswordResetEmail(email)
                .then(() => {
                    alert('Password reset email sent!');
                })
                .catch(error => {
                    console.error(error.message);
                    alert('Error: ' + error.message);
                });
        });
    </script>




</body>
</html>
