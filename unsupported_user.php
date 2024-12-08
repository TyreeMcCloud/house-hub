<?php
include 'database/db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Type Not Supported</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <div class="banner">
            <div class="logo">
                <h1>House Hub</h1>
            </div>
            <nav>
                <a href="registration.php">Register</a>
                <a href="login.php">Login</a>
            </nav>
            <div class="user-info">
            <p>Sorry, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
        </div>
    </header>
    <main>
        <section class="error-message">
            <h2>We're Sorry!</h2>
            <p>The user type you selected is not supported at the moment.</p>
            <p>Currently, our platform only supports <strong>sellers</strong>. Please check back later for updates.</p>
            <a href="registration.php" class="register-link">Go Back to Registration</a>
        </section>
    </main>
</body>
</html>
