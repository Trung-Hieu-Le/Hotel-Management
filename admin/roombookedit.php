<?php

include '../config.php';

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM reservation WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $userID = $row['user_id'];
    $Phone = $row['phone'];
    $RoomType = $row['room_type'];
    $NoofRoom = $row['no_room'];
    $Bed = $row['no_bed'];
    $cin = $row['check_in'];
    $cout = $row['check_out'];
    $note = $row['note'];
    $Status = $row['status'];
}
$service_array = array();
$sql = "SELECT service_id FROM chosen_service WHERE reservation_id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $service_array[] = $row['service_id'];
    }
}

if (isset($_POST['guestdetailedit'])) {
    $EditUserID = $_POST['User'];
    $EditPhone = $_POST['Phone'];
    $EditRoomType = $_POST['RoomType'];
    $EditNoofRoom = $_POST['NoofRoom'];
    $EditBed = $_POST['Bed'];
    // $EditMeal = $_POST['Meal'];
    $EditCin = $_POST['cin'];
    $EditCout = $_POST['cout'];
    $EditNote = $_POST['note'];
    $EditStatus = $_POST['Status'];

    if (empty($EditUserID) || empty($EditNoofRoom) || empty($EditRoomType) || strtotime($EditCout) <= strtotime($EditCin)) {
        echo "<script>swal({
            title: 'Hãy nhập đầy đủ thông tin và ngày đi không được trước ngày đến',
            icon: 'error',
        });
        </script>";
    }
    else {
    $sql = "UPDATE reservation SET user_id = '$EditUserID', phone = '$EditPhone', room_type = '$EditRoomType', no_room = '$EditNoofRoom', no_bed = '$EditBed', check_in = '$EditCin', check_out = '$EditCout', status = '$EditStatus' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (isset($_POST['Service']) && is_array($_POST['Service'])) {
        // Xóa tất cả các liên kết dịch vụ cũ cho đặt phòng này
        $sql_delete = "DELETE FROM chosen_service WHERE reservation_id = '$id'";
        $result_delete = mysqli_query($conn, $sql_delete);

        foreach ($_POST['Service'] as $service_id) {
            $sql = "INSERT INTO chosen_service (reservation_id, service_id) VALUES ('$id', '$service_id')";
            $result2 = mysqli_query($conn, $sql);
        }
    }

    // $type_of_room = 0;
    // if ($EditRoomType == "Superior Room") {
    //     $type_of_room = 3000;
    // } else if ($EditRoomType == "Deluxe Room") {
    //     $type_of_room = 2000;
    // } else if ($EditRoomType == "Guest House") {
    //     $type_of_room = 1500;
    // } else if ($EditRoomType == "Single Room") {
    //     $type_of_room = 1000;
    // }


    // if ($EditBed == "Single") {
    //     $type_of_bed = $type_of_room * 1 / 100;
    // } else if ($EditBed == "Double") {
    //     $type_of_bed = $type_of_room * 2 / 100;
    // } else if ($EditBed == "Triple") {
    //     $type_of_bed = $type_of_room * 3 / 100;
    // } else if ($EditBed == "Quad") {
    //     $type_of_bed = $type_of_room * 4 / 100;
    // } else if ($EditBed == "None") {
    //     $type_of_bed = $type_of_room * 0 / 100;
    // }

    // if ($EditMeal == "Room only") {
    //     $type_of_meal = $type_of_bed * 0;
    // } else if ($EditMeal == "Breakfast") {
    //     $type_of_meal = $type_of_bed * 2;
    // } else if ($EditMeal == "Half Board") {
    //     $type_of_meal = $type_of_bed * 3;
    // } else if ($EditMeal == "Full Board") {
    //     $type_of_meal = $type_of_bed * 4;
    // }

    // noofday update
    // $psql = "Select * from reservation where id = '$id'";
    // $presult = mysqli_query($conn, $psql);
    // $prow = mysqli_fetch_array($presult);
    // $Editnoofday = $prow['nodays'];

    // $editttot = $type_of_room * $Editnoofday * $EditNoofRoom;
    // $editmepr = $type_of_meal * $Editnoofday;
    // $editbtot = $type_of_bed * $Editnoofday;

    // $editfintot = $editttot + $editmepr + $editbtot;

    // $psql = "UPDATE payment SET Name = '$EditName',Email = '$EditEmail',RoomType='$EditRoomType',Bed='$EditBed',NoofRoom='$EditNoofRoom',Meal='$EditMeal',cin='$Editcin',cout='$Editcout',noofdays = '$Editnoofday',roomtotal = '$editttot',bedtotal = '$editbtot',mealtotal = '$editmepr',finaltotal = '$editfintot' WHERE id = '$id'";

    // $paymentresult = mysqli_query($conn, $psql);

    // if ($paymentresult) {
    //     header("Location:roombook.php");
    // }

    if ($result & $result2) {
        echo "<script>swal({
            title: 'Đặt phòng thành công',
            icon: 'success',
        });
        </script>";
        header("Location:roombook.php");
    } else {
        echo "<script>swal({
                        title: 'Xin vui lòng thử lại',
                        icon: 'error',
                    });
            </script>";
    }
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
                <h3 style="left:35%">SỬA ĐẶT PHÒNG</h3>
                <a href="./roombook.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="reservationinfo">
                    <!-- <h4>Thông tin đặt phòng</h4> -->
                    <select name="User" class="selectinput">
                        <option value selected>Người đặt phòng</option>
                        <?php
                        $usersql = "SELECT id, name FROM user";
                        $userresult = mysqli_query($conn, $usersql);
                        if (mysqli_num_rows($userresult) > 0) {
                            while ($row = mysqli_fetch_assoc($userresult)) {
                                $selected = "";
                                if ($row["id"] == $userID) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $row["id"] . "' " . $selected . ">" . $row["name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                SĐT liên hệ:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Phone" id="phone-input" value="<?php echo $Phone ?>">
                    </div>

                    <select name="RoomType" class="selectinput">
                        <option value selected>Loại phòng</option>
                        <?php
                        $roomtypesql = "SELECT id, name FROM room_type";
                        $roomtyperesult = mysqli_query($conn, $roomtypesql);
                        if (mysqli_num_rows($roomtyperesult) > 0) {
                            while ($row = mysqli_fetch_assoc($roomtyperesult)) {
                                $selected = "";
                                if ($row["id"] == $RoomType) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $row["id"] . "' " . $selected . ">" . $row["name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <select name="NoofRoom" class="selectinput">
                        <option value>Số phòng</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            $selected = "";
                            if ($NoofRoom == $i) {
                                $selected = "selected";
                            }
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                    <select name="Bed" class="selectinput">
                        <option value>Số giường</option>
                        <?php
                        for ($i = 1; $i <= 20; $i++) {
                            $selected = "";
                            if ($Bed == $i) {
                                $selected = "selected";
                            }
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                    <select name="Service[]" class="form-control" multiple style="height: 60px;">
                        <option value>Dịch vụ</option>
                        <?php
                        $sql = "SELECT id, name FROM service";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = '';
                                $service_id = $row['id'];
                                if (in_array($service_id, $service_array)) {
                                    $selected = 'selected';
                                }
                                echo "<option style='height:60px;' value='" . $service_id . "' " . $selected . ">" . $row['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="datesection">
                        <span>
                            <label for="cin">Ngày đến</label>
                            <input name="cin" type="date" value="<?php echo $cin ?>">
                        </span>
                        <span>
                            <label for="cin">Ngày đi</label>
                            <input name="cout" type="date" value="<?php echo $cout ?>">
                        </span>
                    </div>
                    <input type="text" name="note" placeholder="Ghi chú" value="<?php echo $note ?>">
                    <select name="Status" class="selectinput">
                        <option value>Trạng thái</option>
                        <option value="1" <?php if ($Status == 1) {echo "selected";} ?>>Hoạt động</option>
                        <option value="0" <?php if ($Status == 0) {echo "selected";} ?>>Không hoạt động</option>
                    </select>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailedit">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>