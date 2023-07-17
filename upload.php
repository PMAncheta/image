<?php
// Retrieve the image from the database
$stmt = $conn->prepare("SELECT image_name, image_data FROM images WHERE image_id = ?");
$imageId = 1; // Provide the desired image ID here
$stmt->bindParam(1, $imageId);
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Display the image
if ($result) {
  $imageName = $result['image_name'];
  $imageData = $result['image_data'];
  $imageType = mime_content_type($imageName);
  header("Content-type: $imageType");
  echo $imageData;
} else {
  echo 'Image not found.';
}
?>
