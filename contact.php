<?php
// Include database configuration file
include('config.php');

// Handle form submission after POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // SQL query to insert form data into the database
  $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

  // Execute the query and check if it was successful
  if ($conn->query($sql) === TRUE) {
    echo "<p>تم إرسال رسالتك بنجاح! سنقوم بالرد عليك قريبًا.</p>";  // Success message 
  } else {
    echo "<p>حدث خطأ أثناء إرسال الرسالة. حاول مرة أخرى.</p>";  // Error message
  }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تواصل معنا - عدستي</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
  <nav>
    <h1><i class="fas fa-camera-retro"></i> عدستي</h1>
    <ul>
      <!-- Navigation menu links -->
      <li><a href="index.html">الرئيسية</a></li>
      <li><a href="gallery.php">المعرض</a></li>
      <li><a href="upload.php">أضف صورة</a></li>
      <li><a href="about.html">عن الموقع</a></li>
      <li><a href="contact.php">تواصل معنا</a></li>
    </ul>
  </nav>
</header>

<section class="contact-section">
  <h2>تواصل معنا</h2>
  
  <!-- Contact form -->
  <form method="POST">
    <label for="name">الاسم:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="email">البريد الإلكتروني:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="message">الرسالة:</label>
    <textarea id="message" name="message" rows="5" required></textarea><br>

    <button type="submit">إرسال الرسالة</button>
  </form>
</section>

<footer>
  <!-- Footer with copyright -->
  <p>© 2025 عدستي. جميع الحقوق محفوظة.</p>
</footer>

</body>
</html>
