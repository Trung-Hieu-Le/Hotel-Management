<?php include 'header.php' ?>
<?php 
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        header("Location:index.php");
    }
?>
<body>
    <div>
        <div class="modal-dialog" style="max-width:1200px; top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">THÔNG TIN CÁ NHÂN KHÁCH HÀNG:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="container">
                    <?php
                    $sql = "SELECT * FROM user WHERE id = $userID";
                    $result = $conn->query($sql) or die($conn->error);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<p>Tên: " . $row["name"] . "</p>";
                            echo "<p>Số điện thoại: " . $row["phone"] . "</p>";
                            echo "<p>Địa chỉ: " . $row["address"] . "</p>";
                            echo "<p>Email: " . $row["email"] . "</p>";
                        }
                    } else {
                        echo "<p>Lỗi khi tải thông tin người dùng</p>";
                    }
                    ?>
                </div>
                <div class="container mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal">
                        Sửa thông tin
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                        Đổi mật khẩu
                    </button>
                </div>
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa thông tin người dùng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <?php
                                    $sql = "SELECT * FROM user WHERE id = $userID";
                                    $result = $conn->query($sql) or die($conn->error);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <label for="name" class="form-label">Tên:</label>
                                                    <input type="text" id="name" name="name" value="<?php echo $row["name"] ?>" class="form-control" required>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label for="phone" class="form-label">Số điện thoại:</label>
                                                    <input type="text" id="phone" name="phone" value="<?php echo $row["phone"] ?>" class="form-control" required pattern="[0-9]+" title="Nhập số từ 0-9">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <label for="address" class="form-label">Địa chỉ:</label>
                                                    <input type="text" id="address" name="address" value="<?php echo $row["address"] ?>" class="form-control">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="text" id="email" name="email" value="<?php echo $row["email"] ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <button type="submit" name="userdetailedit" class="btn btn-primary mt-3">Cập nhật</button>
                                    <?php
                                        }
                                    }
                                    if (isset($_POST['userdetailedit'])) {
                                        $EditName = $_POST['name'];
                                        $EditAddress = $_POST['address'];
                                        $EditPhone = $_POST['phone'];
                                        $EditEmail = $_POST['email'];

                                        $sql = "UPDATE user SET name = '$EditName', address = '$EditAddress', phone = '$EditPhone', email = '$EditEmail' WHERE id = '$userID'";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                swal({
                                                title: 'Cập nhật thành công',
                                                icon: 'success',
                                                }).then(function() {
                                                window.location.href = 'profile.php';
                                                });
                                            </script>";
                                            // header("Location:home.php");
                                        } else {
                                            echo "<script>swal({
                                        title: 'Xin vui lòng thử lại',
                                        icon: 'error',
                                    });
                            </script>";
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- editPassword -->
                <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPasswordModalLabel">Đổi mật khẩu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <table class="table table-borderless">
                                        <tr class="mb-3 border-0">
                                            <td>Mật khẩu hiện tại:</td>
                                            <td><input type="password" name="current_password" required></td>
                                        </tr>
                                        <tr class="mb-3">
                                            <td>Mật khẩu mới:</td>
                                            <td><input type="password" name="new_password" required></td>
                                        </tr>
                                        <tr class="mb-3">
                                            <td>Xác nhận mật khẩu mới:</td>
                                            <td><input type="password" name="confirm_password" required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><button class="btn btn-primary" type="submit" name="userpasswordedit">Đổi mật khẩu</button></td>
                                        </tr>
                                    </table>

                                </form>
                                <?php
                                if (isset($_POST['userpasswordedit'])) {
                                    $currentPassword = $_POST['current_password'];
                                    $newPassword = $_POST['new_password'];
                                    $confirmPassword = $_POST['confirm_password'];
                                    if ($newPassword != $confirmPassword) {
                                        echo "<script>swal({
                                                title: 'Mật khẩu mới và mật khẩu xác nhận không khớp',
                                                icon: 'error',
                                            })</script>";
                                    } else {
                                        $sql = "SELECT * FROM user WHERE id = '$userID'";
                                        $result = $conn->query($sql) or die($conn->error);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            if ($currentPassword == $row['password']) {
                                                $updateSql = "UPDATE user SET password = '$newPassword' WHERE id = '$userID'";

                                                if ($conn->query($updateSql) === TRUE) {
                                                    echo "<script>
                                                    swal({
                                                    title: 'Cập nhật thành công',
                                                    icon: 'success',
                                                    }).then(function() {
                                                    window.location.href = 'profile.php?id=$userID';
                                                    });
                                                    </script>";
                                                } else {
                                                    echo "<script>swal({
                                                            title: 'Lỗi khi cập nhật: '" . $conn->error . ",
                                                            icon: 'error',
                                                        })</script>";
                                                }
                                            } else {
                                                echo "<script>swal({
                                                        title: 'Mật khẩu hiện tại không đúng',
                                                        icon: 'error',
                                                    })</script>";
                                            }
                                        } else {
                                            echo "<script>swal({
                                                    title: 'Không tìm thấy người dùng',
                                                    icon: 'error',
                                                })</script>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php' ?>