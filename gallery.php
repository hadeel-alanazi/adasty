<?php
// Include database connection
include('config.php');

// Check if a search term is provided
$search = '';
if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

// SQL query to search for photos based on title, photographer, or category
$sql = "SELECT * FROM photos WHERE title LIKE '%$search%' OR photographer LIKE '%$search%' OR category LIKE '%$search%' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>المعرض - عدستي</title>
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

<section class="search-bar">
  <!-- Search form -->
  <form method="GET" action="gallery.php">
    <input type="text" name="search" id="search" placeholder="ابحث حسب اسم المصور أو التصنيف" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">بحث</button>
  </form>
</section>

<section class="gallery">
  <div class="gallery-grid">
    <?php
    // Check if results are found
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
      <div class="gallery-item">
        <!-- Image with an onclick event to open the modal -->
        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" onclick="openModal(this)">
        <div class="gallery-info">
          <h3><?php echo $row['title']; ?></h3>
          <p><?php echo $row['photographer']; ?> - <?php echo $row['category']; ?></p>
        </div>
      </div>
    <?php
      }
    } else {
      // If no results found
      echo "<p>لا توجد صور تطابق البحث.</p>";
    }
    ?>
  </div>
</section>

<!-- Modal for displaying enlarged image -->
<div id="imageModal" class="modal">
  <span class="close" onclick="closeModal()">&times;</span>
  <img class="modal-content" id="modalImage">
  <div id="caption"></div>
</div>

<footer>
  <p>© 2025 عدستي. جميع الحقوق محفوظة.</p>
</footer>

<!-- Link to external JavaScript file -->
<script src="js/script.js" defer></script>

</body>
</html>
