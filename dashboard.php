<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Dashboard</h1>
            <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
            <a href="logout.php" class="logout-button">Logout</a>
        </header>
        <main>
            <section class="dashboard-content">
                <h2>Dashboard Content</h2>
                <p>Here you can add the content for your dashboard.</p>
            </section>
        </main>
    </div>
</body>
</html>
