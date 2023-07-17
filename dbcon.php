<?php
// Database connection settings
$host = 'your_host';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';

// Create database connection
$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if a file was selected
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Read the image data
    $imageData = file_get_contents($_FILES['image']['tmp_name']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO images (image_name, image_data) VALUES (?, ?)");

    // Bind the parameters
    $stmt->bindParam(1, $_FILES['image']['name']);
    $stmt->bindParam(2, $imageData, PDO::PARAM_LOB);

    // Execute the statement
    $stmt->execute();

    echo 'Image uploaded successfully.';
  } else {
    echo 'Error uploading the image.';
  }
}
?>
