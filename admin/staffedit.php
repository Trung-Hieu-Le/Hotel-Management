<?php

include '../config.php';

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
    $EditName = $_POST['Name'];
    $EditRole = $_POST['Role'];
    $EditAddress = $_POST['Address'];
    $EditPhone = $_POST['Phone'];
    $EditEmail = $_POST['Email'];
    $EditPassword = $_POST['Password'];

    // if (empty($EditUserID) || empty($EditNoofRoom) || empty($EditRoomType)) {
    //     echo "<script>swal({
    //         title: 'Hãy nhập đầy đủ thông tin và ngày đi không được trước ngày đến',
    //         icon: 'error',
    //     });
    //     </script>";
    // }
    // else {
    $sql = "UPDATE staff SET name = '$EditName', role = '$EditRole', address = '$EditAddress', phone = '$EditPhone', email = '$EditEmail', password = '$EditPassword' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>swal({
            title: 'Đặt phòng thành công',
            icon: 'success',
        });
        </script>";
        header("Location:staff.php");
    } else {
        echo "<script>swal({
                        title: 'Xin vui lòng thử lại',
                        icon: 'error',
                    });
            </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/roombook.css">
    <style>
        #editpanel {
            position: fixed;
            z-index: 1000;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            background-color: #00000079;
        }

        #editpanel .guestdetailpanelform {
            height: 665px;
            width: 620px;
            background-color: #ccdff4;
            border-radius: 10px;
            /* temp */
            position: relative;
            top: 20px;
            animation: guestinfoform .3s ease;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div id="editpanel">
        <form method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3 style="left:35%">SỬA NHÂN VIÊN</h3>
                <a href="./staff.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="reservationinfo">
                    <!-- <h4>Thông tin đặt phòng</h4> -->
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Tên:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Name" id="phone-input" value="<?php echo $Name ?>">
                    </div>
                    <select name="Role" class="form-control">
                        <option value="" disabled>Chọn vị trí</option>
                        <?php
                        $roles = array("Admin", "Ban điều hành", "Đầu bếp", "Lễ tân", "Tạp vụ", "Bảo vệ");

                        foreach ($roles as $roleOption) {
                            $selected = ($Role === $roleOption) ? "selected" : "";
                            echo "<option value='$roleOption' $selected>$roleOption</option>";
                        }
                        ?>
                    </select>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Địa chỉ:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Address" id="phone-input" value="<?php echo $Address ?>">
                    </div>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                SĐT:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Phone" id="phone-input" value="<?php echo $Phone ?>">
                    </div>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Email:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Email" id="phone-input" value="<?php echo $Email ?>">
                    </div>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Mật khẩu:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Password" id="phone-input" value="<?php echo $Password ?>">
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="staffdetailedit">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>