<?php

include 'config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<!-- TODO: giao diện login -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- aos animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- loading bar -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script> -->
    <link rel="stylesheet" href="./css/flash.css">
    <title>Sparrow Hotel</title>
</head>

<body>
    <!--  carousel -->
    <section id="carouselExampleControls" class="carousel slide carousel_section" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="carousel-image" src="./image/hotel1.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./image/hotel2.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./image/hotel3.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./image/hotel4.jpg">
            </div>
        </div>
    </section>

    <!-- main section -->
    <section id="auth_section">

        <div class="logo">
            <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
            <p>SPARROW HOTEL</p>
        </div>

        <div class="auth_container">
            <!--============ login =============-->

            <div id="Log_in">
                <h2>Đăng nhập</h2>
                <div class="role_btn">
                    <div class="btns active">Khách hàng</div>
                    <div class="btns">Nhân viên</div>
                </div>

                <!-- // ==userlogin== -->
                <?php
                if (isset($_POST['user_login_submit'])) {
                    $Phone = $_POST['phone'];
                    $Password = $_POST['password'];

                    $sql = "SELECT * FROM user WHERE phone = '$Phone' AND password = '$Password'";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        $_SESSION['userID'] = mysqli_fetch_array($result)['id'];
                        $_SESSION['userPhone'] = $Phone;
                        $Phone = "";
                        $Password = "";
                        echo "<script>
                        swal({
                            title: 'Đăng nhập thành công',
                            icon: 'success',
                            }).then(function() {
                            window.location.href = 'home.php';
                        });
                        </script>";
                        // header("Location: home.php");
                    } else {
                        echo "<script>swal({
                            title: 'Sai số điện thoại hoặc mật khẩu. Vui lòng thử lại',
                            icon: 'error',
                        });
                        </script>";
                    }
                }
                ?>
                <form class="user_login authsection active" id="userlogin" action="" method="POST">
                    <!-- <div class="form-floating">
                        <input type="text" class="form-control" name="Username" placeholder=" ">
                        <label for="Username">Username</label>
                    </div> -->
                    <div class="form-floating">
                        <input typuser_logine="phone" class="form-control" name="phone" placeholder=" " required pattern="[0-9]+" title="Nhập số từ 0-9">
                        <label for="Phone">Số điện thoại</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" placeholder=" " required>
                        <label for="Password">Mật khẩu</label>
                    </div>
                    <button type="submit" name="user_login_submit" class="auth_btn">Đăng nhập</button>

                    <div class="footer_line">
                        <h6 class="page_move_btn" onclick="editpasswordpage()">Quên mật khẩu?</h6>
                        <h6>Bạn chưa có tài khoản? <span class="page_move_btn" onclick="signuppage()">Đăng kí</span></h6>
                    </div>
                </form>

                <!-- == Emp Login == -->
                <?php
                if (isset($_POST['Emp_login_submit'])) {
                    $Phone = $_POST['emp_phone'];
                    $Password = $_POST['emp_password'];

                    $sql = "SELECT * FROM staff WHERE phone = '$Phone' AND password = '$Password'";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        $_SESSION['staffID'] = mysqli_fetch_array($result)['id'];
                        $_SESSION['staffPhone'] = $Phone;
                        $Phone = "";
                        $Password = "";
                        echo "<script>
                        swal({
                            title: 'Đăng nhập thành công',
                            icon: 'success',
                            }).then(function() {
                            window.location.href = 'admin/dashboard.php';
                        });
                        </script>";
                        // header("Location: admin/admin.php");
                    } else {
                        echo "<script>swal({
                                title: 'Có lỗi xảy ra, xin vui lòng thử lại!',
                                icon: 'error',
                            });
                            </script>";
                    }
                }
                ?>
                <form class="employee_login authsection" id="employeelogin" action="" method="POST">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="emp_phone" placeholder=" " required pattern="[0-9]+" title="Nhập số từ 0-9">
                        <label for="floatingInput">Số điện thoại</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="emp_password" placeholder=" " required>
                        <label for="floatingPassword">Mật khẩu</label>
                    </div>
                    <button type="submit" name="Emp_login_submit" class="auth_btn">Đăng nhập</button>
                </form>

            </div>

            <!--============ signup =============-->
            <?php
            if (isset($_POST['user_signup_submit'])) {
                $Username = $_POST['username'];
                // $Birthday = $_POST['birthday'];
                // $Gender = $_POST['gender'];
                // $Cccd = $_POST['cccd'];
                $Address = $_POST['address'];
                $Phone = $_POST['phone'];
                $Email = $_POST['email'];
                $Password = $_POST['password'];
                $CPassword = $_POST['confirmPassword'];

                if ($Username == "" || $Email == "" || $Password == "") {
                    echo "<script>swal({
                            title: 'Hãy nhập đầy đủ thông tin',
                            icon: 'error',
                        });
                        </script>";
                } else {
                    if ($Password == $CPassword) {
                        $sql = "SELECT * FROM user WHERE phone = '$Phone'";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            echo "<script>swal({
                                    title: 'Số điện thoại đã tồn tại',
                                    icon: 'error',
                                });
                                </script>";
                        } else {
                            $sql = "INSERT INTO user (name, address, phone, email, password) VALUES ('$Username', '$Address', '$Phone', '$Email', '$Password')";
                            $result = mysqli_query($conn, $sql);
                            $sql = "SELECT * FROM user WHERE phone = '$Phone'";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $_SESSION['userID'] = mysqli_fetch_array($result)['id'];
                                $_SESSION['userPhone'] = mysqli_fetch_array($result)['phone'];
                                $Username = "";
                                $Phone = "";
                                $Password = "";
                                $CPassword = "";
                                echo "<script>
                        swal({
                            title: 'Đăng kí thành công',
                            icon: 'success',
                            }).then(function() {
                            window.location.href = 'home.php';
                        });
                        </script>";
                                header("Location: home.php");
                            } else {
                                echo "<script>swal({
                                        title: 'Có lỗi xảy ra, xin vui lòng thử lại!',
                                        icon: 'error',
                                    });
                                    </script>";
                            }
                        }
                    } else {
                        echo "<script>swal({
                                title: 'Mật khẩu không trùng khớp',
                                icon: 'error',
                            });
                            </script>";
                    }
                }
            }
            ?>
            <!--============ changepassword =============-->
            <?php
            if (isset($_POST['user_change_password'])) {
                $Phone = $_POST['phone'];
                $Email = $_POST['email'];
                $NewPassword = $_POST['password'];
                $ConfirmPassword = $_POST['confirmPassword'];

                if ($NewPassword != $ConfirmPassword) {
                    echo "<script>swal({
                title: 'Mật khẩu mới và xác nhận mật khẩu không khớp',
                icon: 'error',
            });
            </script>";
                } else {
                    $sql = "SELECT * FROM user WHERE phone = '$Phone' AND email = '$Email'";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $updateSql = "UPDATE user SET password = '$NewPassword' WHERE phone = '$Phone' AND email = '$Email'";
                        $updateResult = mysqli_query($conn, $updateSql);

                        if ($updateResult) {
                            echo "<script>swal({
                                title: 'Đổi mật khẩu thành công',
                                icon: 'success',
                            });
                            </script>";
                        } else {
                            echo "<script>swal({
                                title: 'Có lỗi xảy ra, xin vui lòng thử lại!',
                                icon: 'error',
                            });
                            </script>";
                        }
                    } else {
                        echo "<script>swal({
                            title: 'Không tìm thấy người dùng',
                            icon: 'error',
                        });
                        </script>";
                    }
                }
            }
            ?>
            <div id="sign_up">
                <h2>Đăng ký</h2>

                <form class="user_signup" id="usersignup" action="" method="POST">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="username" placeholder=" " required>
                        <label for="Username">Họ & tên</label>
                    </div>
                    <!-- <div class="row">
                        <div class="form-floating col-9">
                            <input type="date" class="form-control" name="birthday" placeholder=" " required>
                            <label for="Birthday" style="left:12px;">Ngày sinh</label>
                        </div>
                        <div class="form-floating col-3">
                            <div>
                                <label>Giới tính</label>
                            </div>
                            <input type="radio" name="gender" value="1" checked>Nam
                            <input type="radio" name="gender" value="0">Nữ
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="cccd" placeholder=" " required>
                        <label for="IdentityCard">Số CMND/CCCD</label>
                    </div> -->
                    <div class="form-floating">
                        <input type="text" class="form-control" name="address" placeholder=" " required>
                        <label for="Address">Địa chỉ</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="phone" placeholder=" " required pattern="[0-9]+" title="Nhập số từ 0-9">
                        <label for="Phone">Số điện thoại</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" placeholder=" " required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" placeholder=" " required>
                        <label for="Password">Mật khẩu</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="confirmPassword" placeholder=" " required>
                        <label for="CPassword">Xác nhận mật khẩu</label>
                    </div>

                    <button type="submit" name="user_signup_submit" class="auth_btn">Đăng ký</button>

                    <div class="footer_line">
                        <h6>Bạn đã có tài khoản? <span class="page_move_btn" onclick="loginpage()">Đăng nhập</span></h6>
                    </div>
                </form>
            </div>
            <div id="change_password">
                <h2>Đổi mật khẩu</h2>

                <form class="user_change_password" id="usersignup" action="" method="POST">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="phone" placeholder=" " required pattern="[0-9]+" title="Nhập số từ 0-9">
                        <label for="Phone">Số điện thoại</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" placeholder=" " required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" placeholder=" " required>
                        <label for="Password">Mật khẩu mới</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="confirmPassword" placeholder=" " required>
                        <label for="CPassword">Xác nhận mật khẩu mới</label>
                    </div>

                    <button type="submit" name="user_change_password" class="auth_btn">Đổi mật khẩu</button>

                    <div class="footer_line">
                        <h6>Bạn đã có tài khoản? <span class="page_move_btn" onclick="loginpage()">Đăng nhập</span></h6>
                    </div>
                </form>
            </div>
    </section>
</body>


<script src="./javascript/index.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- aos animation-->
<!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> -->
<!-- <script>
    AOS.init();
</script> -->

</html>