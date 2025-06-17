<?php
include('config.php'); // Include the database configuration file

// Handling the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form data
  $title = $_POST['title'];
  $photographer = $_POST['photographer'];
  $category = $_POST['category'];
  
  // Handling the uploaded image
  $imageName = $_FILES['image']['name'];
  $imageTmpName = $_FILES['image']['tmp_name'];
  $imageSize = $_FILES['image']['size'];
  $imageError = $_FILES['image']['error'];
  $imageType = $_FILES['image']['type'];

  // Get the file extension of the uploaded image
  $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
  $allowed = array('jpg', 'jpeg', 'png', 'gif'); // Allowed file extensions

  // Check if the uploaded file has a valid extension and no error
  if (in_array($imageExt, $allowed) && $imageError === 0) {
    if ($imageSize < 5000000) { // Check if image size is less than 5 MB
      // Generate a unique name for the image
      $newImageName = uniqid('', true) . '.' . $imageExt;
      $imageDestination = 'images/' . $newImageName;

      // Move the uploaded file to the target directory
      move_uploaded_file($imageTmpName, $imageDestination);

      // Insert the image data into the database
      $sql = "INSERT INTO photos (title, photographer, category, image) 
              VALUES ('$title', '$photographer', '$category', '$newImageName')";

      // Check if the query is successful
      if ($conn->query($sql) === TRUE) {
        echo "<p>تم رفع الصورة بنجاح!</p>"; // Success message
      } else {
        echo "<p>حدث خطأ أثناء رفع الصورة: " . $conn->error . "</p>"; // Error message
      }
    } else {
      echo "<p>حجم الصورة كبير جداً! يجب أن يكون أقل من 5 ميجا بايت.</p>"; // Image size too large message
    }
  } else {
    echo "<p>الرجاء رفع صورة بصيغة صحيحة (JPG, JPEG, PNG, GIF).</p>"; // Invalid file format message
  }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>رفع صورة - عدستي</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
  <nav>
    <h1><i class="fas fa-camera-retro"></i> عدستي</h1>
    <ul>
      <li><a href="index.html">الرئيسية</a></li>
      <li><a href="gallery.php">المعرض</a></li>
      <li><a href="upload.php">أضف صورة</a></li>
      <li><a href="about.html">عن الموقع</a></li>
      <li><a href="contact.php">تواصل معنا</a></li>
    </ul>
  </nav>
</header>

<section class="upload-section">
  <h2>رفع صورة جديدة</h2>

  <!-- Image upload form -->
  <form method="POST" enctype="multipart/form-data">
    <label for="title">عنوان الصورة:</label>
    <input type="text" id="title" name="title" required><br>

    <label for="photographer">اسم المصور:</label>
    <input type="text" id="photographer" name="photographer" required><br>

    <label for="category">التصنيف:</label>
    <input type="text" id="category" name="category" required><br>

    <label for="image">اختيار الصورة:</label>
    <input type="file" id="image" name="image" accept="image/*" required><br>

    <button type="submit">رفع الصورة</button>
  </form>
</section>

<footer>
  <p>© 2025 عدستي. جميع الحقوق محفوظة.</p>
</footer>

</body>
</html>
