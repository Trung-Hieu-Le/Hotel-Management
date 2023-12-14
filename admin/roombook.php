<?php
session_start();
include '../config.php';

?>
<?php
//Xóa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $deletesql = "DELETE FROM reservation WHERE id = $id";

    $result = mysqli_query($conn, $deletesql);

    header("Location:roombook.php");
}
//Thêm
if (isset($_POST['guestdetailsubmit'])) {
    $userID = $_POST['User'];
    $Phone = $_POST['Phone'];
    $RoomType = $_POST['RoomType'];
    $NoofRoom = $_POST['NoofRoom'];
    $Bed = $_POST['Bed'];
    $Cin = $_POST['cin'];
    $Cout = $_POST['cout'];
    $Note = $_POST['note'];
    if (empty($userID) || empty($NoofRoom) || empty($RoomType) || strtotime($Cout) <= strtotime($Cin)) {
        echo "<script>swal({
                    title: 'Hãy nhập đầy đủ thông tin và ngày đi không được trước ngày đến',
                    icon: 'error',
                });
                </script>";
    } else {
        $Status = 0;
        $sql = "INSERT INTO reservation(user_id,phone,room_type,no_room,no_bed,check_in,check_out,no_day,status,note)
                 VALUES ('$userID','$Phone','$RoomType','$NoofRoom','$Bed','$Cin','$Cout',datediff('$Cout','$Cin'),$Status,'$Note')";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $reservationId = mysqli_insert_id($conn);

            if (isset($_POST['Service']) && is_array($_POST['Service'])) {
                foreach ($_POST['Service'] as $service_id) {
                    $sql = "INSERT INTO chosen_service (reservation_id, service_id) VALUES ('$reservationId', '$service_id')";
                    $result2 = mysqli_query($conn, $sql);
                    if (!$result2) {
                        // Handle the error, for example, log it or display a message
                        echo "<script>console.error('Error inserting into chosen_service: " . mysqli_error($conn) . "');</script>";
                    }
                }
            }

            echo "<script>swal({
                            title: 'Đặt phòng thành công',
                            icon: 'success',
                        });
                    </script>";
        } else {
            // Handle the error, for example, log it or display a message
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
    <title>Sparrow Hotel - Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $('select').selectpicker();

</script>
</head>

<body>
    <!-- guestdetailpanel -->

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <label for="phone-input" class="form-label">Tài khoản khách hàng:</label>
                        <select name="User" class="form-select mb-3">
                            <option value="" disabled>Chọn người đặt phòng</option>
                            <?php
                            $usersql = "SELECT id, name FROM user";
                            $userresult = mysqli_query($conn, $usersql);
                            if (mysqli_num_rows($userresult) > 0) {
                                while ($row = mysqli_fetch_assoc($userresult)) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                }
                            }
                            ?> </select>
                        <div class="mb-3">
                            <label for="phone-input" class="form-label">SĐT liên hệ:</label>
                            <input type="text" class="form-control" id="phone-input" name="Phone">
                        </div>
                        <!-- Dropdown Loại phòng -->
<div class="mb-3">
  <label for="roomTypeSelect" class="form-label">Loại phòng:</label>
  <select name="RoomType" id="roomTypeSelect" class="form-select">
    <option value="" disabled>Chọn loại phòng</option>
    <?php
    $roomtypesql = "SELECT id, name FROM room_type";
    $roomtyperesult = mysqli_query($conn, $roomtypesql);
    if (mysqli_num_rows($roomtyperesult) > 0) {
      while ($row = mysqli_fetch_assoc($roomtyperesult)) {
        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
      }
    }
    ?>
  </select>
</div>
<!-- Dropdown Số phòng -->
<div class="mb-3">
  <label for="noOfRoomSelect" class="form-label">Số phòng:</label>
  <select name="NoofRoom" id="noOfRoomSelect" class="form-select">
    <option value="" disabled>Chọn số phòng</option>
    <?php
    for ($i = 1; $i <= 10; $i++) {
      echo "<option value='$i'>$i</option>";
    }
    ?>
  </select>
</div>

<!-- Dropdown Số giường -->
<div class="mb-3">
  <label for="bedSelect" class="form-label">Số giường:</label>
  <select name="Bed" id="bedSelect" class="form-select">
    <option value="" disabled>Chọn số giường</option>
    <?php
    for ($i = 1; $i <= 20; $i++) {
      echo "<option value='$i'>$i</option>";
    }
    ?>
  </select>
</div>

<!-- Dropdown Dịch vụ -->
<div class="mb-3">
  <label for="serviceSelect" class="form-label">Dịch vụ:</label>
  <select name="Service[]" class="form-select selectpicker" multiple data-live-search="true">
    <option value="" disabled>Dịch vụ</option>
    <?php
    $servicesql = "SELECT id, name FROM service";
    $serviceresult = mysqli_query($conn, $servicesql);
    if (mysqli_num_rows($serviceresult) > 0) {
        while ($row = mysqli_fetch_assoc($serviceresult)) {
            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
        }
    }
    ?>
</select>
</div>
                        <!-- Thêm các trường thông tin khác tương tự -->

                        <!-- Các trường ngày đến và ngày đi -->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="cin" class="form-label">Ngày đến</label>
                                <input name="cin" type="date" class="form-control">
                            </div>
                            <div class="col">
                                <label for="cout" class="form-label">Ngày đi</label>
                                <input name="cout" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <input type="text" class="form-control" id="note" name="note" placeholder="Ghi chú">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success" name="guestdetailsubmit">Hoàn thành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
            Đặt phòng
        </button> <!-- <button class="adduser" id="adduser" onclick="adduseropen()"> Add</button> -->
        <!-- <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form> -->
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
        $roombooktablesql = "SELECT reservation.*, user.name AS username, room_type.name AS roomtypename, GROUP_CONCAT(service.name SEPARATOR ', ') AS listservice
    FROM reservation
    JOIN user ON reservation.user_id = user.id
    JOIN room_type ON reservation.room_type = room_type.id
    LEFT JOIN chosen_service ON reservation.id = chosen_service.reservation_id
    LEFT JOIN service ON chosen_service.service_id = service.id
    GROUP BY reservation.id";
        $roombookresult = mysqli_query($conn, $roombooktablesql);
        $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên</th>
                    <!-- <th scope="col">Email</th> -->
                    <!-- <th scope="col">Địa chỉ</th> -->
                    <th scope="col">SĐT</th>
                    <th scope="col">Loại phòng</th>
                    <th scope="col">Số phòng</th>
                    <th scope="col">Số giường</th>
                    <th scope="col">Dịch vụ</th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col" class="action">Hành động</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($roombookresult)) {
                ?>
                    <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['phone'] ?></td>
                        <td><?php echo $res['roomtypename'] ?></td>
                        <td><?php echo $res['no_room'] ?></td>
                        <td><?php echo $res['no_bed'] ?></td>
                        <td>
                            <?php
                            if (isset($res['listservice'])) {
                                $services = explode(',', $res['listservice']);
                                foreach ($services as $service) {
                                    echo $service . '<br/>';
                                }
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                        <td><?php echo $res['check_in'] ?></td>
                        <td><?php echo $res['check_out'] ?></td>
                        <td><?php echo $res['no_day'] ?></td>
                        <td><?php echo $res['status'] ?></td>
                        <td><?php echo $res['note'] ?></td>
                        <td class="action">
                            <!-- <?php
                            if ($res['status'] == "Confirm") {
                                echo " ";
                            } else {
                                echo "<a href='roomconfirm.php?id=" . $res['id'] . "'><button class='btn btn-success'>Confirm</button></a>";
                            }
                            ?> -->
                            <a href="roombookedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="roombook.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./javascript/roombook.js"></script>



</html>