<?php
include '../config.php';

$userId = isset($_GET['userId']) ? $_GET['userId'] : null;

if ($userId != null) {
    $sql = "SELECT * FROM user WHERE id = $userId";
} else {
    $sql = "SELECT * FROM user LIMIT 1";
}
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p>Họ tên: " . $row["name"] . "</p>";
    echo "<p>Số điện thoại: " . $row["phone"] . "</p>";
    echo "<p>Địa chỉ: " . $row["address"] . "</p>";
    echo "<p>Email: " . $row["email"] . "</p>";
} else {
    echo "Không tìm thấy thông tin người dùng";
}
?>
