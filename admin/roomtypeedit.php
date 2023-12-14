<?php include 'header.php'; ?>
<?php

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM room_type WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $name = $row['name'];
    $image = $row['image'];
    $description = $row['description'];
    $price = $row['price'];
    $status = $row['status'];
}

if (isset($_POST['roomtypedetailedit'])) {
    $EditName = $_POST['name'];
    $EditImage = $_POST['image'];
    $EditDescription = $_POST['description'];
    $EditPrice = $_POST['price'];
    $EditStatus = $_POST['status'];

    
    $sql = "UPDATE room_type SET name = '$EditName', image = '$EditImage', description = '$EditDescription', status = b'$EditStatus', price = '$EditPrice' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        
        header("Location:roomtype.php");
    } else {
        echo "<script>alert('Lỗi khi sửa loại phòng');</script>";
    }
}

?>

<?php include('sidebar.php')?>
  <div class="main-content">
    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">SỬA THÔNG TIN LOẠI PHÒNG:</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <form action="" method="POST">
            <div class="row modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" class="form-control" id="phone-input" value="<?php echo $name ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Ảnh:</label>
                        <input type="text" name="image" class="form-control" id="phone-input" value="<?php echo $image ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Giá:</label>
                        <input type="text" name="price" class="form-control" id="phone-input" value="<?php echo $price ?>" required pattern="[0-9]+" title="Nhập số từ 0-9">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="phone">Mô tả :</label>
                        <input type="text" name="description" class="form-control" id="phone-input" value="<?php echo $description ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Trạng thái :</label>
                        <select name="status" class="form-control" required>
                            <option disabled>Trạng thái</option>
                            <option value="1" <?php if ($status == 1) {
                                                    echo "selected";
                                                } ?>>Hoạt động</option>
                            <option value="0" <?php if ($status == 0) {
                                                    echo "selected";
                                                } ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="roomtype.php" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary" name="roomtypedetailedit">Hoàn thành</button>
            </div>
        </form>
    </div>
  </div>
    <?php include 'footer.php'; ?>
