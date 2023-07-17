<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if a file was selected
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Read the image data
    $imageData = file_get_contents($_FILES['image']['tmp_name']);

    // Check if the image already exists
    $stmt = $conn->prepare("SELECT image_id FROM images WHERE image_name = ?");
    $stmt->bindParam(1, $_FILES['image']['name']);
    $stmt->execute();
    $existingImage = $stmt->fetchColumn();

    if ($existingImage) {
      // Update the existing image data
      $stmt = $conn->prepare("UPDATE images SET image_data = ? WHERE image_id = ?");
      $stmt->bindParam(1, $imageData, PDO::PARAM_LOB);
      $stmt->bindParam(2, $existingImage);
      $stmt->execute();
    } else {
      // Insert the new image data
      $stmt = $conn->prepare("INSERT INTO images (image_name, image_data) VALUES (?, ?)");
      $stmt->bindParam(1, $_FILES['image']['name']);
      $stmt->bindParam(2, $imageData, PDO::PARAM_LOB);
      $stmt->execute();
    }

    echo 'Image uploaded successfully.';
  } else {
    echo 'Error uploading the image.';
  }
}
?>
