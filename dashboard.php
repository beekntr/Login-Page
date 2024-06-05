<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$sql = "SELECT name, email, password FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        h1 {
            color: #333;
        }

        .logout-button {
            background-color: #ff4b4b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-button:hover {
            background-color: #ff1f1f;
        }

        main {
            padding: 20px 0;
        }

        .dashboard-content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
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

                <!-- Display data from the database -->
                <?php
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                            </tr>";
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $name = isset($row["name"]) ? $row["name"] : 'N/A';
                        $email = isset($row["email"]) ? $row["email"] : 'N/A';
                        $password = isset($row["password"]) ? $row["password"] : 'N/A';
                        echo "<tr>
                                <td>" . htmlspecialchars($name) . "</td>
                                <td>" . htmlspecialchars($email) . "</td>
                                <td>" . htmlspecialchars($password) . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </section>
        </main>
    </div>
</body>
</html>
