<?php include 'header.php'; ?>
<?php


// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM staff WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $Name = $row['name'];
    $Role = $row['role'];
    $Address = $row['address'];
    $Phone = $row['phone'];
    $Email = $row['email'];
    $Password = $row['password'];
}

if (isset($_POST['staffdetailedit'])) {
    $EditName = $_POST['name'];
    $EditRole = $_POST['role'];
    $EditAddress = $_POST['address'];
    $EditPhone = $_POST['phone'];
    $EditEmail = $_POST['email'];
    $EditPassword = $_POST['password'];

  
    $check_query = "SELECT * FROM staff WHERE phone = '$EditPhone' AND id <> $id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('SĐT nhân viên đã tồn tại');</script>";
    } else {
        $sql = "UPDATE staff SET name = '$EditName', role = '$EditRole', address = '$EditAddress', phone = '$EditPhone', email = '$EditEmail', password = '$EditPassword' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
           
            header("Location:staff.php");
        } else {
            echo "<script>alert('Lỗi khi sửa nhân viên');</script>";
        }
    }
}

?>

<?php include('sidebar.php')?>
  <div class="main-content">
    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">SỬA THÔNG TIN NHÂN VIÊN:</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <form action="" method="POST">
            <div class="row modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="username">Tên:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $Name; ?>" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="role">Vị trí:</label>
                        <select name="role" class="form-control" required>
                        <option value="" disabled>Chọn vị trí</option>
                        <?php
                        $roles = array("Admin", "Ban điều hành", "Đầu bếp", "Lễ tân", "Tạp vụ", "Bảo vệ");

                        foreach ($roles as $roleOption) {
                            $selected = ($Role === $roleOption) ? "selected" : "";
                            echo "<option value='$roleOption' $selected>$roleOption</option>";
                        }
                        ?>
                        </select>                    
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-6">
                        <label for="phone">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $Email; ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="phone">Địa chỉ:</label><br>
                        <input type="text" name="address" class="form-control" value="<?php echo $Address; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="phone">SĐT :</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $Phone; ?>" required pattern="[0-9]+" title="Nhập số từ 0-9">
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Mật khẩu :</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $Password; ?>" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="staff.php" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary" name="staffdetailedit">Hoàn thành</button>
            </div>
        </form>
    </div>
  </div>
    <?php include 'footer.php'; ?>