<?php include 'header.php'; ?>
<?php


// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM service WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $Name = $row['name'];
    $Image = $row['image'];
    $Price = $row['price'];
    $Description = $row['description'];
    $Status = $row['status'];
}

if (isset($_POST['servicedetailedit'])) {
    $EditName = $_POST['Name'];
    $EditImage = $_POST['Image'];
    $EditPrice = $_POST['Price'];
    $EditDescription = $_POST['Description'];
    $EditStatus = $_POST['Status'];

  
    $check_query = "SELECT * FROM service WHERE name = '$EditName' AND id <> $id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Dịch vụ đã tồn tại');</script>";
    } else {
    $sql = "UPDATE service SET name = '$EditName', image = '$EditImage', price = '$EditPrice', description = '$EditDescription', status = b'$EditStatus' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
       
        header("Location:service.php");
    } else {
        echo "<script>alert('Lỗi khi sửa dịch vụ');</script>";
    }
}
}

?>

<?php include('sidebar.php')?>
  <div class="main-content">
    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">SỬA THÔNG TIN DỊCH VỤ:</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <form action="" method="POST">
            <div class="row modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="name">Tên:</label>
                        <input type="text" name="Name" class="form-control" id="phone-input" value="<?php echo $Name ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Ảnh:</label>
                        <input type="text" name="Image" class="form-control" id="phone-input" value="<?php echo $Image ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Giá:</label>
                        <input type="text" name="Price" class="form-control" id="phone-input" value="<?php echo $Price ?>" required pattern="[0-9]+" title="Nhập số từ 0-9">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="phone">Mô tả :</label>
                        <input type="text" name="Description" class="form-control" id="phone-input" value="<?php echo $Description ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Trạng thái :</label>
                        <select name="Status" class="form-control" required>
                            <option disabled>Trạng thái</option>
                            <option value="1" <?php if ($Status == 1) {
                                                    echo "selected";
                                                } ?>>Hoạt động</option>
                            <option value="0" <?php if ($Status == 0) {
                                                    echo "selected";
                                                } ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="service.php" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary" name="servicedetailedit">Hoàn thành</button>
            </div>
        </form>
    </div>
  </div>
    <?php include 'footer.php'; ?>