<?php
include 'database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = $_POST['user_type'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    // hashing password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Populate Database
    $sql = "INSERT INTO users (user_type, first_name, last_name, email, username, password)
            VALUES ('$user_type', '$first_name', '$last_name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
