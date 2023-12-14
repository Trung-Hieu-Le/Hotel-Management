<?php include 'header.php'; ?>
<?php

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $name = $row['name'];
    // $birthday = $row['birthday'];
    // $gender = $row['gender'];
    // $cccd = $row['cccd'];
    $address = $row['address'];
    $phone = $row['phone'];
    $email = $row['email'];
    $password = $row['password'];
}

if (isset($_POST['userdetailedit'])) {
    $EditName = $_POST['name'];
    // $EditBirthday = $_POST['birthday'];
    // $EditGender = $_POST['gender'];
    // $EditCccd = $_POST['cccd'];
    $EditAddress = $_POST['address'];
    $EditPhone = $_POST['phone'];
    $EditEmail = $_POST['email'];
    $EditPassword = $_POST['password'];

   
    $check_query = "SELECT * FROM user WHERE phone = '$phone'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // User đã tồn tại
        echo "<script>alert('SĐT người dùng đã tồn tại');</script>";
    } else {
    $sql = "UPDATE user SET name = '$EditName', address = '$EditAddress', phone = '$EditPhone', email = '$EditEmail', password = '$EditPassword' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        
        header("Location:user.php");
    } else {
        echo "<script>alert('Lỗi khi sửa người dùng');</script>";
    }
    }
}
?>
<?php include('sidebar.php')?>
  <div class="main-content">
    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">SỬA THÔNG TIN NGƯỜI DÙNG:</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <form action="" method="POST">
            <div class="row modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="username">Tên:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="phone">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="phone">Địa chỉ:</label><br>
                        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="phone">SĐT :</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" required pattern="[0-9]+" title="Nhập số từ 0-9">
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Mật khẩu :</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="user.php" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary" name="userdetailedit">Hoàn thành</button>
            </div>
        </form>
    </div>
  </div>
    <?php include 'footer.php'; ?>