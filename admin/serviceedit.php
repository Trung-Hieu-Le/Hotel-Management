<?php

include '../config.php';

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM service WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $Name = $row['name'];
    $Price = $row['price'];
    $Description = $row['description'];
    $Status = $row['status'];
}

if (isset($_POST['servicedetailedit'])) {
    $EditName = $_POST['Name'];
    $EditPrice = $_POST['Price'];
    $EditDescription = $_POST['Description'];
    $EditStatus = $_POST['Status'];

    // if (empty($EditUserID) || empty($EditNoofRoom) || empty($EditRoomType)) {
    //     echo "<script>swal({
    //         title: 'Hãy nhập đầy đủ thông tin và ngày đi không được trước ngày đến',
    //         icon: 'error',
    //     });
    //     </script>";
    // }
    // else {
    $sql = "UPDATE service SET name = '$EditName', price = '$EditPrice', description = '$EditDescription', status = '$EditStatus' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>swal({
            title: 'Đặt phòng thành công',
            icon: 'success',
        });
        </script>";
        header("Location:service.php");
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
                <h3 style="left:35%">SỬA DỊCH VỤ</h3>
                <a href="./service.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="reservationinfo">
                    <!-- <h4>Thông tin đặt phòng</h4> -->
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Tên dịch vụ:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Name" id="phone-input" value="<?php echo $Name ?>">
                    </div>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Giá:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Price" id="phone-input" value="<?php echo $Price ?>">
                    </div>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Mô tả:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Description" id="phone-input" value="<?php echo $Description ?>">
                    </div>
                    <select name="Status" class="selectinput">
                        <option value>Trạng thái</option>
                        <option value="1" <?php if ($Status == 1) {echo "selected";} ?>>Hoạt động</option>
                        <option value="0" <?php if ($Status == 0) {echo "selected";} ?>>Không hoạt động</option>
                    </select>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="servicedetailedit">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>