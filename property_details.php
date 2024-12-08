<?php
include 'database/db_connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
// Check if the property id is passed
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid property ID.";
    exit();
}

// get the property id
$property_id = $_GET['id'];

// get the property details from the database
$sql = "SELECT properties.*, users.username AS seller_name
        FROM properties
        JOIN users ON properties.seller_id = users.id
        WHERE properties.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the property exists
if ($result->num_rows === 0) {
    echo "Property not found.";
    exit();
}

// get the property details
$property = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        h1 {
            text-align: center;
        }
        .property-details img {
            max-width: 100%;
            height: auto;
        }
        .property-details table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .property-details th, .property-details td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .property-details th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <header>
        <div class="banner">
            <div class="logo">
                <h1>House Hub</h1>
            </div>
            <nav>
                <a href="index.php">Home</a>
                <a href="seller_dashboard.php">Back to Dashboard</a>
            </nav>
            <div class="user-info">
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
        </div>
    </header>
    <h1>Property Details</h1>

    <div class="property-details">
        <h2><?php echo $property['location']; ?></h2>
        <!-- Property Image -->
        <img src="<?php echo $property['image_path']; ?>" alt="Property Image">

        <!-- Property Information -->
        <table>
            <tr>
                <th>Location</th>
                <td><?php echo htmlspecialchars($property['location']); ?></td>
            </tr>
            <tr>
                <th>Age</th>
                <td><?php echo htmlspecialchars($property['age']); ?> years</td>
            </tr>
            <tr>
                <th>Floor Plan</th>
                <td><?php echo htmlspecialchars($property['floor_plan']); ?></td>
            </tr>
            <tr>
                <th>Square Footage</th>
                <td><?php echo htmlspecialchars($property['square_footage']); ?> sq. ft.</td>
            </tr>
            <tr>
                <th>Bedrooms</th>
                <td><?php echo htmlspecialchars($property['bedrooms']); ?></td>
            </tr>
            <tr>
                <th>Bathrooms</th>
                <td><?php echo htmlspecialchars($property['bathrooms']); ?></td>
            </tr>
            <tr>
                <th>Garden</th>
                <td><?php echo $property['garden'] ? 'Yes' : 'No'; ?></td>
            </tr>
            <tr>
                <th>Parking</th>
                <td><?php echo $property['parking'] ? 'Yes' : 'No'; ?></td>
            </tr>
            <tr>
                <th>Nearby Places</th>
                <td><?php echo htmlspecialchars($property['proximity']); ?></td>
            </tr>
            <tr>
                <th>Main Roads</th>
                <td><?php echo htmlspecialchars($property['main_roads'] ?: 'Not specified'); ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td>$<?php echo number_format($property['price'], 2); ?></td>
            </tr>
            <tr>
                <th>Seller</th>
                <td><?php echo htmlspecialchars($property['seller_name']); ?></td>
            </tr>
            <tr>
                <th>Property Tax (7% of Price)</th>
                <td>$<?php echo number_format($property['property_tax'], 2); ?></td>
            </tr>
            <tr>
                <th>Posted At</th>
                <td><?php echo date("F j, Y, g:i a", strtotime($property['created_at'])); ?></td>
            </tr>
        </table>
        <nav>
                <a href="seller_dashboard.php">Back to Dashboard</a>
        </nav>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
