<?php
include 'database/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seller_id = $_SESSION['user_id'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $floor_plan = $_POST['floor_plan'];
    $square_footage = $_POST['square_footage'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garden = isset($_POST['garden']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $proximity = $_POST['proximity'];
    $main_roads = $_POST['main_roads'];
    $price = $_POST['price'];

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['property_image']) && $_FILES['property_image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['property_image']['name']);
        $target_path = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['property_image']['tmp_name'], $target_path)) {
            $image_path = $target_path;
        } else {
            echo "Failed to upload the file.";
        }
    } else {
        $image_path = 'uploads/default.png'; // Default image if none uploaded
    }

    // Insert into the database
    $sql = "INSERT INTO properties (seller_id, location, age, floor_plan, square_footage, bedrooms, bathrooms, garden, parking, proximity, main_roads, price, image_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisiissssdds", $seller_id, $location, $age, $floor_plan, $square_footage, $bedrooms, $bathrooms, $garden, $parking, $proximity, $main_roads, $price, $image_path);

    if ($stmt->execute()) {
        header('Location: seller_dashboard.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
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
                <a href="seller_dashboard.php">Dashboard</a>
            </nav>
            <div class="user-info">
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
        </div>
    </header>
    <main>
        <h1>Add New Property</h1>
        <form method="POST" action="add_property.php" enctype="multipart/form-data">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="age">Property Age (years):</label>
            <input type="number" id="age" name="age" min="0" required>

            <label for="floor_plan">Floor Plan Details:</label>
            <input type="text" id="floor_plan" name="floor_plan" required>

            <label for="square_footage">Square Footage:</label>
            <input type="number" id="square_footage" name="square_footage" min="0" required>

            <label for="bedrooms">Bedrooms:</label>
            <input type="number" id="bedrooms" name="bedrooms" min="0" required>

            <label for="bathrooms">Bathrooms:</label>
            <input type="number" id="bathrooms" name="bathrooms" min="0" required>

            <label>
                <input type="checkbox" name="garden" id="garden"> Has Garden
            </label>

            <label>
                <input type="checkbox" name="parking" id="parking"> Has Parking
            </label>

            <label for="proximity">Places Nearby (e.g., schools, shops):</label>
            <input type="text" id="proximity" name="proximity">

            <label for="main_roads">Number of Main Roads:</label>
            <input type="text" id="main_roads" name="main_roads">

            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required>

            <label for="property_image">Upload Property Image:</label>
            <input type="file" name="property_image" id="property_image" accept="image/*">

            <button type="submit">Add Property</button>
        </form>
    </main>
</body>
</html>
