<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/room.css">
    <style>
        .roombox {
            background-color: #d1d7ff;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <div class="h-100 py-2">
            <div class="row h-100">
                <div class="col-4">
                    <label for="username">Tên :</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="col-4">
                    <label for="address">Địa chỉ :</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="col-4">
                    <label for="phone">SĐT :</label>
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <div class="row h-100">
                <div class="col-4">
                    <label for="email">Email :</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-4">
                    <label for="password">Password :</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success" name="adduser">Thêm người dùng</button>
                </div>
            </div>
            </div>
        </form>

        <?php
        if (isset($_POST['adduser'])) {
            $username = $_POST['username'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            // TODO: Tránh trùng user
            $sql = "INSERT INTO user(name,address,phone,email,password) VALUES ('$username', '$address','$phone','$email','$password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: staff.php");
            }
        }
        ?>
    </div>


    <div class="room">
        <?php
        $sql = "select * from user";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            echo "<div class='roombox'>
						<div class='text-center no-boder'>
                            <img src='../image/icon/user.png' width=80 height=80>
							<h3>" . $row['name'] . "</h3>
                            <div class='mb-1'>" . $row['phone'] . "</div>
                            <a href=''><button class='btn btn-primary'>Sửa</button></a>
                            <a href='userdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Xóa</button></a>
						</div>
                    </div>";
        }
        ?>
    </div>

</body>

</html>