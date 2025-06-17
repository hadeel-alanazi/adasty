<?php
// إعدادات الاتصال بقاعدة البيانات 
$host = 'localhost';
$username = 'root';
$password = '';  
$dbname = 'adasty_db';

// محاولة الاتصال بقاعدة البيانات
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
