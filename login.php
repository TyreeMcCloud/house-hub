<?php include 'database/db_connection.php'; ?>
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['username'] = $user['username'];

            if ($user['user_type'] == 'seller') {
                header('Location: seller_dashboard.php');
            } elseif ($user['user_type'] == 'buyer') {
                header('Location: unsupported_user.php');
            }
            elseif ($user['user_type'] == 'admin') {
                header('Location: unsupported_user.php');
            }else {
                header('Location: unsupported_user.php');
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <div class="banner">
            <div class="logo">
                <h1>House Hub</h1>
            </div>
            <nav>
                <a href="index.php">Home</a>
            </nav>
            <div class="user-info">
            <p>Please login to continue</p>
            </div>
        </div>
    </header>
    <br>
    <h1 align="center">Login</h1>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
