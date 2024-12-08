<?php include 'database/db_connection.php'; ?>
<?php
session_start();
if ($_SESSION['user_type'] != 'seller') {
    header('Location: login.php');
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM properties WHERE seller_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
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
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
        </div>
    </header>
    <main>
        <h1>Seller Dashboard</h1>
        <a href="add_property.php" class="add-property">+ Add New Property</a>
        <div class="dashboard-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($property = $result->fetch_assoc()): ?>
                    <div class="card">
                    <img src="<?php echo $property['image_path'] ? $property['image_path'] : 'images/home.png'; ?>" alt="Property">
                        <div class="card-content">
                            <h3><?php echo $property['location']; ?></h3>
                            <p>Price: $<?php echo number_format($property['price'], 2); ?></p>
                            <p>Bedrooms: <?php echo $property['bedrooms']; ?></p>
                            <p>Bathrooms: <?php echo $property['bathrooms']; ?></p>
                            <p>Property Tax: $<?php echo number_format($property['property_tax'], 2); ?></p>
                        </div>
                        <div class="card-actions">
                             <a href="update_property.php?id=<?php echo $property['id']; ?>" class="btn-update">Update</a>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn-view">View Details</a>
                            <a href="delete_property.php?id=<?php echo $property['id']; ?>" class="btn-delete">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="card">
                    <div class="card-content">
                    <h3>No Properties Found</h3>
                    <p>Click the '+' symbol to add your first property!</p>
                    <a href="add_property.php" class="add-property">+ Add New Property</a>
                   </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>

