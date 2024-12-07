<?php
$host = "localhost";
$user = "tmccloud6";
$pass = "tmccloud6";
$dbname = "tmccloud6";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*$sql = "CREATE TABLE STUDENTS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    GPA VARCHAR(30) NOT NULL
)";*/

/*$sql = "INSERT INTO STUDENTS (firstname, lastname, GPA) VALUES
    ('shilpa', 'batthineni', 3.9),
    ('shi', 'batt', 2.5),
    ('shii', 'batth', 1.9),
    ('tyree', 'shi', 4.0),
    ('caleb', 'moore', 2.9)";

if ($conn->query($sql) === TRUE) {
    echo "Connected to database";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();*/
?>