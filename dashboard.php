<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['email']; ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="dashboard.php?logout=true">Logout</a>
</body>
</html>
