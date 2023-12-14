<?php include 'header.php' ?>

<?php
$id = $_GET['id'];

$sql_current = "SELECT * FROM room_type WHERE id = '$id' AND status = 1";
$result_current = mysqli_query($conn, $sql_current);
if (mysqli_num_rows($result_current) > 0) {
    $row_current = mysqli_fetch_assoc($result_current);
}
// Lấy 3 room_type liên quan
$sql_others = "SELECT * FROM room_type WHERE id != '$id' AND status = 1 LIMIT 3";
$result_others = mysqli_query($conn, $sql_others);
?>

<body>
    <div>
        <div style="margin: 70px auto; max-width:1000px">
            <h2>Thông tin chi tiết phòng <?php echo $row_current['name']; ?>:</h2>
            <img src="./image/room_type/<?php echo $row_current['image']; ?>" alt="<?php echo $row_current['name']; ?>" style="width: 100%; border:1px solid black; ">
            <h4>Mô tả:</h4>
            <p><?php echo $row_current['description']; ?></p>
            <h4>Giá: $<?php echo $row_current['price']; ?>/ngày</h4>
            <div class="d-flex justify-content-center">
                <?php if ($userID == true) : ?>
                    <a href="reservation_modal_1.php">
                        <button class="btn btn-success">Đặt phòng ngay</button>
                    </a>
                <?php else : ?>
                    <a href="index.php" onclick="return confirm('Vui lòng đăng nhập để có thể đặt phòng')"><button class='btn btn-success bookbtn'>Đặt phòng ngay</button></a>
                <?php endif; ?>
            </div>
            <hr>
            <h2>Các loại phòng có liên quan:</h2>
        </div>
        <div class="row m-auto justify-content-center">
            <?php
            if (mysqli_num_rows($result_others) > 0) {
                while ($row = mysqli_fetch_assoc($result_others)) {
            ?>
                    <div class="col-3">
                        <div class="card">
                            <img class="card-img" src="./image/room_type/<?php echo $row["image"]; ?>" alt="<?php echo $row['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $row['name']; ?></h3>
                                <a href="roomtype.php?id=<?php echo $row['id'] ?>" class="btn btn-primary card-btn">Chi tiết</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Không có thông tin phòng khác.";
            }
            ?>
        </div>
    </div>
</body>

<?php include 'footer.php' ?>