<?php
include 'database/db_connection.php';
session_start();

if ($_SESSION['user_type'] != 'seller') {
    header('Location: login.php');
    exit();
}

// Get the property ID from the query string
$property_id = $_GET['id'];

// Delete the property from the database
$sql = "DELETE FROM properties WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);

if ($stmt->execute()) {
    header('Location: seller_dashboard.php');
    exit();
} else {
    echo "Error deleting property: " . $stmt->error;
}
?>
