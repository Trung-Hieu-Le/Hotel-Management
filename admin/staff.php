<?php
session_start();
include '../config.php';
?>
<?php
        //Xóa
        if (isset($_GET['delete'])) {

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
            // TODO: Tránh trùng staff
            $sql = "INSERT INTO staff(name,role,address,phone,email,password) VALUES ('$staffname', '$staffrole','$address','$phone','$email','$password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: staff.php");
            }
        }
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
                    <label for="staffname">Tên :</label>
                    <input type="text" name="staffname" class="form-control">
                </div>
                <div class="col-4">
                    <label for="staffrole">Vị trí :</label>
                    <select name="Role" class="form-control">
                        <option value="" disabled>Chọn vị trí</option>
                        <?php
                        $roles = array("Admin", "Ban điều hành", "Đầu bếp", "Lễ tân", "Tạp vụ", "Bảo vệ");

                        foreach ($roles as $roleOption) {
                            echo "<option value='$roleOption'>$roleOption</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="address">Địa chỉ :</label>
                    <input type="text" name="address" class="form-control">
                </div>
            </div>
            <div class="row h-100">
                <div class="col-3">
                    <label for="phone">SĐT :</label>
                    <input type="text" name="phone" class="form-control" style="width:200px">
                </div>
                <div class="col-3">
                    <label for="email">Email :</label>
                    <input type="email" name="email" class="form-control" style="width:200px">
                </div>
                <div class="col-3">
                    <label for="password">Password :</label>
                    <input type="password" name="password" class="form-control" style="width:200px">
                </div>
                <div class="col-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success" name="addstaff">Thêm nhân viên</button>
                </div>
            </div>
            </div>
        </form>
    </div>


    <div class="room">
        <?php
        $sql = "select * from staff";
        $re = mysqli_query($conn, $sql)
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <!-- <th scope="col">Password</th> -->
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
                        <td><?php echo $res['role'] ?></td>
                        <td><?php echo $res['phone'] ?></td>
                        <td><?php echo $res['address'] ?></td>
                        <td><?php echo $res['email'] ?></td>
                      
                        <td class="action">
                            <a href="staffedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="staff.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>