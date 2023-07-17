CREATE TABLE images (
  image_id INT PRIMARY KEY AUTO_INCREMENT,
  image_name VARCHAR(255),
  image_data LONGBLOB
);

INSERT INTO images (image_name, image_data) VALUES (?, ?);
SELECT image_name, image_data FROM images WHERE image_id = ?;
