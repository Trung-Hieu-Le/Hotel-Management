<?php
session_start();
include '../config.php';
?>

        $id = $_GET['delete'];
        $roomdeletesql = "DELETE FROM staff WHERE id = $id";
        $result = mysqli_query($conn, $roomdeletesql);
        header("Location:staff.php");
        }
        //Thêm
        if (isset($_POST['addstaff'])) {
            $staffname = $_POST['staffname'];
            $staffrole = $_POST['staffrole'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $check_query = "SELECT * FROM staff WHERE phone = '$phone'";
            $check_result = mysqli_query($conn, $check_query);
            
            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('SĐT nhân viên đã tồn tại');</script>";
            } else {
            $sql = "INSERT INTO staff(name,role,address,phone,email,password) VALUES ('$staffname', '$staffrole','$address','$phone','$email','$password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: staff.php");
            } else {
                echo "<script>alert('Lỗi khi thêm nhân viên');</script>";
            }
        }
        }
        ?>

<?php include 'header.php'; ?>

<div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            Thêm nhân viên
        </button>
    </div>
    <!-- Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:750px;">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="" method="POST">
        <div class="modal-body">
            <div class="row h-100">
                <div class="col-lg-6">
                    <label for="username">Tên:</label>
                    <input type="text" name="staffname" class="form-control" required>
                </div>
                <div class="col-lg-6">
                    <label for="staffrole">Vị trí:</label>
                    <select name="staffrole" class="form-control" required>
                        <option value="" disabled>Chọn vị trí</option>
                        <?php
                        $roles = array("Admin", "Ban điều hành", "Đầu bếp", "Lễ tân", "Tạp vụ", "Bảo vệ");

                        foreach ($roles as $roleOption) {
                            echo "<option value='$roleOption'>$roleOption</option>";
                        }
                        ?>
                    </select>
                </div>
                
            </div>
            <div class="row h-100">
                <div class="col-lg-6">
                    <label for="phone">Email:</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label for="phone">Địa chỉ:</label><br>
                    <input type="text" name="address" class="form-control">
                </div>
                
            </div>
            <div class="row h-100">
                <div class="col-lg-6">
                    <label for="phone">SĐT :</label>
                    <input type="text" name="phone" class="form-control" required pattern="[0-9]+" title="Nhập số từ 0-9">
                </div>
                <div class="col-lg-6">
                    <label for="password">Mật khẩu :</label>
                    <input type="password" name="password" class="form-control" required>
                </div> 
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="addstaff">Thêm nhân viên</button>
        </div>
    </form>
    </div>
  </div>
</div>

    <div class="room">
        <?php
        $sql = "select * from staff";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            echo "<div class='roombox'>
						<div class='text-center no-boder'>
                        <img src='../image/icon/staff.png' width=80 height=80>
                        <h3>" . $row['name'] . "</h3>
                            <div class='mb-1'>" . $row['role'] . "</div>
                            <a href=''><button class='btn btn-primary'>Sửa</button></a>
                            <a href='staffdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Xóa</button></a>
						</div>
                    </div>";
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>