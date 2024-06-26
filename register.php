<?php
session_start();

$servername = "srv1497.hstgr.io";
$username = "u188323907_lester";
$password = "#Dgisweakgamer1";
$dbname = "u188323907_login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "User with this email already exists.";
        } else {
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $password);

            if ($stmt->execute()) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        echo "Please fill out all fields.";
    }
}
$conn->close();
?>
