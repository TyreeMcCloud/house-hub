<?php
include 'database/db_connection.php';
session_start();

if ($_SESSION['user_type'] != 'seller') {
    header('Location: login.php');
    exit();
}

// get the property to update
$property_id = $_GET['id'];
$sql = "SELECT * FROM properties WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Property not found.";
    exit();
}

$property = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
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
    $image_path = $property['image_path']; // Keep the existing image if no new file is uploaded
    if (isset($_FILES['property_image']) && $_FILES['property_image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['property_image']['name']);
        $target_path = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['property_image']['tmp_name'], $target_path)) {
            $image_path = $target_path;
        } else {
            echo "Failed to upload the file.";
        }
    }

    // Update the database with new values and the image path
    $sql = "UPDATE properties SET location = ?, age = ?, floor_plan = ?, square_footage = ?, bedrooms = ?, bathrooms = ?, garden = ?, parking = ?, proximity = ?, main_roads = ?, price = ?, image_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisiiisssdssi", $location, $age, $floor_plan, $square_footage, $bedrooms, $bathrooms, $garden, $parking, $proximity, $main_roads, $price, $image_path, $property_id);

    if ($stmt->execute()) {
        header('Location: seller_dashboard.php');
        exit();
    } else {
        echo "Error updating property: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Property</title>
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
    <h1>Update Property</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Location:</label>
        <input type="text" name="location" value="<?php echo $property['location']; ?>" required><br>
        <label>Age:</label>
        <input type="number" name="age" value="<?php echo $property['age']; ?>" required><br>
        <label>Floor Plan:</label>
        <input type="text" name="floor_plan" value="<?php echo $property['floor_plan']; ?>" required><br>
        <label>Square Footage:</label>
        <input type="number" name="square_footage" value="<?php echo $property['square_footage']; ?>" required><br>
        <label>Bedrooms:</label>
        <input type="number" name="bedrooms" value="<?php echo $property['bedrooms']; ?>" required><br>
        <label>Bathrooms:</label>
        <input type="number" name="bathrooms" value="<?php echo $property['bathrooms']; ?>" required><br>
        <label>Garden:</label>
        <input type="checkbox" name="garden" <?php echo $property['garden'] ? 'checked' : ''; ?>><br>
        <label>Parking:</label>
        <input type="checkbox" name="parking" <?php echo $property['parking'] ? 'checked' : ''; ?>><br>
        <label>Places Nearby (e.g., schools, shops):</label>
        <input type="text" name="proximity" value="<?php echo $property['proximity']; ?>" required><br>
        <label>Number of Main Roads:</label>
        <input type="text" name="main_roads" value="<?php echo $property['main_roads']; ?>" required><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $property['price']; ?>" required><br>

        <label for="property_image">Upload Property Image:</label>
        <input type="file" name="property_image" id="property_image" accept="image/*"><br>

        <button type="submit">Update Property</button>
    </form>

    <!-- Display current image -->
    <h2>Current Property Image:</h2>
    <img src="<?php echo $property['image_path']; ?>" alt="Current Property Image" style="width: 200px; height: auto;">
</main>
</body>
</html>
