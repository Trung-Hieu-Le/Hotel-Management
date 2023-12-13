<?php include 'header.php' ?>

<body>
    <div>
        <div class="modal-dialog" style="max-width:1200px; top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">THÔNG TIN CÁ NHÂN KHÁCH HÀNG:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <?php
                $sql = "SELECT * FROM user WHERE id = $userID";
                $result = $conn->query($sql) or die($conn->error);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<p>Tên: " . $row["name"] . "</p>";
                        // echo $row["gender"] == b'1' ? '<p>Giới tính: Nam</p>' : '<p>Giới tính: Nữ</p>';
                        // echo "<p>Ngày sinh: " . $row["birthday"] . "</p>";
                        // echo "<p>Căn cước công dân: " . $row["cccd"] . "</p>";
                        echo "<p>Số điện thoại" . $row["phone"] . "</p>";
                        echo "<p>Địa chỉ" . $row["address"] . "</p>";
                        echo "<p>Email" . $row["email"] . "</p>";
                    }
                } else {
                    echo "<p>Lỗi khi tải thông tin người dùng</p>";
                }
                ?>
                <div class="container">
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
                                            <table>
                                                <tr>
                                                    <td>Tên</td>
                                                    <td><input type="text" name="name" value="<?php echo $row["name"] ?>" required></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Ngày sinh</td>
                                                    <td><input type="date" name="birthday" value="<?php echo $row["birthday"] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Giới tính</td>
                                                    <td>
                                                        <input type="radio" <?php if ($row["gender"] == b'1') echo " checked"; ?> name="gender" value=1> Nam
                                                        <input type="radio" <?php if ($row["gender"] == b'0') echo " checked"; ?> name="gender" value=0> Nữ
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Căn cước công dân</td>
                                                    <td><input type="text" name="cccd" value="<?php echo $row["cccd"] ?>"></td>
                                                </tr> -->
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td><input type="text" name="address" value="<?php echo $row["address"] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td><input type="text" name="phone" value="<?php echo $row["phone"] ?>" required pattern="[0-9]+" title="Nhập số từ 0-9"></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><input type="text" name="email" value="<?php echo $row["email"] ?>"></td>
                                                </tr>
                                            </table>
                                            <button type="submit" name="userdetailedit" class="btn btn-primary mt-3">Cập nhật</button>
                                    <?php
                                        }
                                    }
                                    if (isset($_POST['userdetailedit'])) {
                                        $EditName = $_POST['name'];
                                        // $EditBirthday = $_POST['birthday'];
                                        // $EditGender = $_POST['gender'];
                                        // $EditCccd = $_POST['cccd'];
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
                                    <table>
                                        <tr>
                                            <td>Mật khẩu hiện tại:</td>
                                            <td><input type="password" name="current_password" required></td>
                                        </tr>
                                        <tr>
                                            <td>Mật khẩu mới:</td>
                                            <td><input type="password" name="new_password" required></td>
                                        </tr>
                                        <tr>
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
                                                    echo "<script>swal({
                                                            title: 'Thay đổi mật khẩu thành công',
                                                            icon: 'success',
                                                        })</script>";
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