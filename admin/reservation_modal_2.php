<?php
include '../config.php';

//Thêm vào bảng reservation
if (isset($_POST['reservationSubmit'])) {
    
    $userID = $_POST['user'];
    $note = $_POST['note'];
    $noRoom = $_GET['no_room'];
    $noGuess = $_GET['no_guess'];
    $cin = $_GET['cin'];
    $cout = $_GET['cout'];
    $status = $_POST['status'];
    
            $sql = "INSERT INTO reservation(user_id,no_room,no_guess,check_in,check_out,no_day,status,note)
                 VALUES ('$userID','$noRoom','$noGuess','$cin','$cout',datediff('$cout','$cin')+1,$status,'$note')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $reservationId = mysqli_insert_id($conn);

            if (isset($_GET['room_ids'])) {
                $room_ids = $_GET['room_ids'];
                $room_ids_array = explode(',', $room_ids);
                foreach ($room_ids_array as $room_id) {
                    $sql = "INSERT INTO chosen_room (reservation_id, room_id) VALUES ('$reservationId', '$room_id')";
                    $result2 = mysqli_query($conn, $sql);
                    // if (!$result2) {
                    //     echo "<script>console.error('Lỗi khi chọn phòng: " . mysqli_error($conn) . "');</script>";
                    // }
                    if (!$result2) {
                        echo "<script>console.error('Lỗi khi chọn phòng: " . mysqli_error($conn) . "');</script>";
                    } else {
                        $update_status_sql = "UPDATE room
                        JOIN chosen_room ON room.id = chosen_room.room_id
                        JOIN reservation ON chosen_room.reservation_id = reservation.id
                        SET room.status = 
                        CASE 
                            WHEN reservation.status = 0 THEN 2
                            WHEN reservation.status IN (1, 2) THEN 1
                            ELSE room.status
                        END
                        WHERE room.id = '$room_id' AND reservation.id = '$reservationId';";
                        $update_status_result = mysqli_query($conn, $update_status_sql);
                        if (!$update_status_result) {
                            echo "<script>console.error('Lỗi khi cập nhật trạng thái phòng: " . mysqli_error($conn) . "');</script>";
                        }
                    }
                }
            }
            if (isset($_POST['service']) && is_array($_POST['service'])) {
                foreach ($_POST['service'] as $service_id) {
                    $sql = "INSERT INTO chosen_service (reservation_id, service_id) VALUES ('$reservationId', '$service_id')";
                    $result3 = mysqli_query($conn, $sql);
                    if (!$result3) {
                        echo "<script>console.error('Lỗi khi chọn dịch vụ: " . mysqli_error($conn) . "');</script>";
                    }
                }
            }

            echo "<script>swal({
                            title: 'Đặt phòng thành công',
                            icon: 'success',
                        });
                    </script>";
                    header("Location: reservation.php");

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.0/dist/js/multi-select-tag.js"></script>
</head>

<body>
    <div>
        <div>
            <div>
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG - ĐIỀN THÔNG TIN:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="POST">
                <div class="row modal-body m-auto">
                        <div class="col">
                            <h4><u>Thông tin khách hàng:</u></h4>
                            <div>
                                <label for="userSelect" class="form-label">Khách hàng:</label>
                                <select name="user" class="select" required>
                                    <option value="">Chọn khách hàng</option>
                                    <?php
                                    $usersql = "SELECT id, name FROM user";
                                    $userresult = mysqli_query($conn, $usersql);
                                    if (mysqli_num_rows($userresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($userresult)) {
                                            echo "<option value='" . $row["id"]. "'>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="userInfo">
                                <!-- Thông tin người dùng sẽ được hiển thị ở đây -->
                            </div>
                        </div>


                        <div class="col">
                            <h4><u>Thông tin chi tiết đặt phòng:</u></h4>
                            <?php 
                                echo "<p>Ngày nhận phòng: ".date('d-m-Y', strtotime($_GET["cin"]))."</p>";
                                echo "<p>Ngày trả phòng: ".date('d-m-Y', strtotime($_GET["cout"]))."</p>";
                                echo "<p>Số hành khách: ".$_GET["no_guess"]."</p>";
                                echo "<p>Số phòng: ".$_GET["no_room"]."</p>";

                            
                            ?>
                            <!-- TODO: Sửa multi select -->
                            <div>
                                <label for="serviceSelect" class="form-label">Dịch vụ:</label>
                                <select name="service[]" class="select multiselect" id="multiService" multiple>
                                    <option value="" disabled>Dịch vụ</option>
                                    <?php
                                    $servicesql = "SELECT id, name, price FROM service";
                                    $serviceresult = mysqli_query($conn, $servicesql);
                                    if (mysqli_num_rows($serviceresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($serviceresult)) {
                                            echo "<option value='" . $row["id"] . "' data-price='" . $row["price"] . "'>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="note" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Ghi chú">
                            </div>
                            <div>
                                <label>Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="2">Hủy đặt phòng</option>
                                    <option value="1">Đã thanh toán</option>
                                    <option value="0" selected>Chưa thanh toán</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="reservation_modal_1.php" class="btn btn-secondary">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary" name="reservationSubmit">Hoàn thành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- <script src="./javascript/roombook.js"></script> -->
<!-- <script>
    document.getElementById('addCustomerBtn').addEventListener('click', function() {
        window.location.href = 'user.php?showAddUserModal=true';
    });
</script> -->
<script>
document.querySelector('.select').addEventListener('change', function() {
    const selectedUserId = this.value;
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const userDetails = xhr.responseText;
                document.getElementById('userInfo').innerHTML = userDetails;
            } else {
                console.error('Đã xảy ra lỗi');
            }
        }
    };
    xhr.open('GET', 'getUserDetails.php?userId=' + selectedUserId, true);
    xhr.send();
});

</script>
</html>