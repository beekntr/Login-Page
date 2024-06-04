<?php
session_start();
$error_message = '';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) { // For security reasons, use password_hash() and password_verify() in real applications
                $_SESSION['email'] = $email;
                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No user found with this email.";
        }
        $stmt->close();
    } else {
        $error_message = "Please fill out both fields.";
    }
}
$conn->close();
?>

<!doctype html>
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <title>Login and Registration Form</title> 
  <link rel="stylesheet" href="style.css"> 
</head> 
<body> 
    <br>
    <br>
    <div class="cont">
        <div class="form sign-in">
            <h2>Welcome</h2>
            <form action="login.php" method="POST">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required />
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required />
                </label>
                <p class="forgot-pass">Forgot password?</p>
                <button type="submit" class="submit">Sign In</button>
                <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Don't have an account? Please Sign up!</h3>
                </div>
                <div class="img__text m--in">
                    <h3>If you already have an account, just sign in.</h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2>Create your Account</h2>
                <form action="register.php" method="POST">
                    <label>
                        <span>Name</span>
                        <input type="text" name="name" required />
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required />
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required />
                    </label>
                    <button type="submit" class="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
</body>
</html>
