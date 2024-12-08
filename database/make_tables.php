<?php
include 'db_connection.php';
/*
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type ENUM('buyer', 'seller', 'admin') NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();*/

/*
$sql = "CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    location VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    floor_plan VARCHAR(255) NOT NULL,
    square_footage INT NOT NULL,
    bedrooms INT NOT NULL,
    bathrooms INT NOT NULL,
    garden BOOLEAN DEFAULT FALSE,
    parking BOOLEAN DEFAULT FALSE,
    proximity VARCHAR(255),
    main_roads VARCHAR(255),
    property_tax DECIMAL(10, 2) AS (0.07 * price) STORED,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'properties' created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();*/

/*
$sql = "ALTER TABLE properties ADD COLUMN image_path VARCHAR(255)";

if ($conn->query($sql) === TRUE) {
    echo "Column 'image_path' added successfully!";
} else {
    echo "Error adding column: " . $conn->error;
}*/

/*Checks property img path
$sql = "SELECT id, location, image_path FROM properties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Image Path</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['location']}</td>
                <td>{$row['image_path']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No properties found.";
}

$conn->close();*/

?>
