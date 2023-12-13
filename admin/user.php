<?php
session_start();
include '../config.php';
?>

<?php
        //Xóa
        if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $userdeletesql = "DELETE FROM user WHERE id = $id";
        $result = mysqli_query($conn, $userdeletesql);
        header("Location:user.php");
        }
        //Thêm
        if (isset($_POST['adduser'])) {
            $name = $_POST['name'];
            // $birthday = $_POST['birthday'];
            // $gender = $_POST['gender'];
            // $cccd = $_POST['cccd'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Kiểm tra xem user đã tồn tại hay chưa
            $check_query = "SELECT * FROM user WHERE phone = '$phone'";
            $check_result = mysqli_query($conn, $check_query);
            
            if (mysqli_num_rows($check_result) > 0) {
                // User đã tồn tại
                echo "<script>alert('SĐT người dùng đã tồn tại');</script>";
            } else {
                // Thêm user mới vào cơ sở dữ liệu
                $insert_query = "INSERT INTO user (name, address, phone, email, password) VALUES ('$name', '$address', '$phone', '$email', '$password')";
                $insert_result = mysqli_query($conn, $insert_query);
        
                if ($insert_result) {
                    header("Location: user.php");
                } else {
                    echo "<script>alert('Lỗi khi thêm người dùng');</script>";
                }
            }
        }
        ?>

<?php include 'header.php'; ?>

    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Thêm người dùng
        </button>
    </div>
    <!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:750px;">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm người dùng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="" method="POST">
        <div class="modal-body">
            <div class="row h-100">
                <div class="col-lg-4">
                    <label for="username">Tên:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-lg-4">
                    <label for="phone">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-lg-4">
                    <label for="phone">Địa chỉ:</label><br>
                    <input type="text" name="address" class="form-control">
                </div>
                
            </div>
            <div class="row h-100">
                <!-- <div class="col-lg-4">
                    <label for="phone">Ngày sinh:</label>
                    <input type="date" name="birthday" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="phone">Giới tính:</label><br>
                    <input type="radio" name="gender" value="1" checked>Nam
                    <input type="radio" name="gender" value="0">Nữ
                </div> -->
                <!-- <div class="col-lg-4">
                    <label for="username">CCCD:</label>
                    <input type="text" name="cccd" class="form-control" required>
                </div> -->
                
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
            <button type="submit" class="btn btn-primary" name="adduser">Thêm người dùng</button>
        </div>
    </form>
    </div>
  </div>
</div>

    <div class="room">
        <?php
        $sql = "select * from user";
        $re = mysqli_query($conn, $sql)
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="action">Hành động</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($re)) {
                ?>
                    <tr style="height:80px;">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['phone'] ?></td>
                        <td><?php echo $res['address'] ?></td>
                        <td><?php echo $res['email'] ?></td>
                        <td class="action">
                            <a href="useredit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="user.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>

