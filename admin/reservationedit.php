<?php

include '../config.php';

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM reservation WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $userID = $row['user_id'];
    // $Phone = $row['phone'];
    // $RoomType = $row['room_type'];
    $NoofRoom = $row['no_room'];
    $No_guess = $row['no_guess'];
    $cin = $row['check_in'];
    $cout = $row['check_out'];
    $note = $row['note'];
    $Status = $row['status'];
}
$room_array = array();
$service_array = array();
//TODO: Sửa sql
$sql = "SELECT room_id FROM chosen_room WHERE reservation_id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $room_array[] = $row['room_id'];
    }
}
$sql = "SELECT service_id FROM chosen_service WHERE reservation_id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $service_array[] = $row['service_id'];
    }
}

if (isset($_POST['guestdetailedit'])) {
    $EditUserID = $_POST['user'];
    // $EditPhone = $_POST['Phone'];
    // $EditRoomType = $_POST['RoomType'];
    $EditNoofRoom = count($_POST['room']);
    $EditNoofGuess = $_POST['no_guess'];
    $EditCin = $_POST['cin'];
    $EditCout = $_POST['cout'];
    $EditNote = $_POST['note'];
    $EditStatus = $_POST['status'];

    if (strtotime($EditCout) < strtotime($EditCin)) {
        echo "<script>alert('Ngày nhận phòng không được trước ngày trả phòng');</script>";

    }
    else {
    $sql = "UPDATE reservation SET user_id = '$EditUserID', no_room = '$EditNoofRoom', no_guess = '$EditNoofGuess', check_in = '$EditCin', check_out = '$EditCout', no_day = datediff('$EditCout', '$EditCin')+1, note = '$EditNote', status = '$EditStatus' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
        
    if (isset($_POST['room']) && is_array($_POST['room'])) {
        
        $sql_delete = "DELETE FROM chosen_room WHERE reservation_id = '$id'";
        $result_delete = mysqli_query($conn, $sql_delete);
            foreach ($_POST['room'] as $room_id) {
                $sql = "INSERT INTO chosen_room (reservation_id, room_id) VALUES ('$id', '$room_id')";
                $result2 = mysqli_query($conn, $sql);
                $update_status_sql = "UPDATE room
                          JOIN chosen_room ON room.id = chosen_room.room_id
                          JOIN reservation ON chosen_room.reservation_id = reservation.id
                          SET room.status = 
                          CASE 
                              WHEN reservation.status = 0 THEN 2
                              WHEN reservation.status IN (1, 2) THEN 1
                              ELSE room.status
                          END
                          WHERE room.id = '$room_id' AND reservation.id = '$id';";
                $result3 = mysqli_query($conn, $update_status_sql);
            } 
    }
    if (isset($_POST['service']) && is_array($_POST['service'])) {
        $sql_delete = "DELETE FROM chosen_service WHERE reservation_id = '$id'";
        $result_delete = mysqli_query($conn, $sql_delete);
        foreach ($_POST['service'] as $service_id) {
            $sql = "INSERT INTO chosen_service (reservation_id, service_id) VALUES ('$id', '$service_id')";
            $result4 = mysqli_query($conn, $sql);
        } 
    }
    if ($result & $result2) {
        echo "<script>swal({
            title: 'Đặt phòng thành công',
            icon: 'success',
        });
        </script>";
        header("Location:reservation.php");
    } else {
        echo "<script>alert('Lỗi khi sửa đơn đặt phòng');</script>";

    }
    }
}
?>


<?php include 'header.php'; ?>

    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG - SỬA THÔNG TIN:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="POST">
                    <div class="row modal-body">
                        <div class="col">
                            <div>
                                <label for="phone-input" class="form-label">Tài khoản khách hàng:</label>
                                <select name="user" class="form-select mb-3" required>
                                    <option value="" disabled>Chọn người đặt phòng</option>
                                    <?php
                                    $usersql = "SELECT id, name FROM user";
                                    $userresult = mysqli_query($conn, $usersql);
                                    if (mysqli_num_rows($userresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($userresult)) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="no_guess" class="form-label">Số hành khách:</label>
                                <select name="no_guess" id="no_guess" class="form-select" required>
                                    <option value="" disabled>Chọn số hành khách</option>
                                    <?php
                                        for ($i = 1; $i <= 20; $i++) {
                                            $selected = ($No_guess == $i) ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="cin" class="form-label">Ngày nhận phòng:</label>
                                <input name="cin" type="date" class="form-control" value="<?php echo $cin; ?>" required>
                            </div>
                            <div>
                                <label for="cout" class="form-label">Ngày trả phòng:</label>
                                <input name="cout" type="date" class="form-control" value="<?php echo $cout; ?>" required>
                            </div>
                            <!-- <div class="col-lg-3">
                                <label>Chưa có tài khoản khách hàng?</label><br>
                                <button type="button" class="btn btn-primary mt-2" id="addCustomerBtn">Thêm khách hàng</button>
                            </div> -->
                            
                        </div>


                        <div class="col">
                            <!-- Dropdown -->
                            <div>
                                <label for="roomSelect" class="form-label">Phòng:</label>
                                <select name="room[]" class="select multiselect" multiple required>
                                    <option value="" disabled>Phòng</option>
                                    <?php
                                    $roomsql = "SELECT id, name FROM room";
                                    $roomresult = mysqli_query($conn, $roomsql);
                                    if (mysqli_num_rows($roomresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($roomresult)) {
                                            $selected = in_array($row["id"], $room_array) ? 'selected' : '';
                                            echo "<option value='" . $row["id"] . "' $selected>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>   
                            </div>
                            <div>
                                <label for="serviceSelect" class="form-label">Dịch vụ:</label>
                                <select name="service[]" class="select multiselect" id="multiService" multiple>
                                    <option value="" disabled>Dịch vụ</option>
                                    <?php
                                    $servicesql = "SELECT id, name FROM service";
                                    $serviceresult = mysqli_query($conn, $servicesql);
                                    if (mysqli_num_rows($serviceresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($serviceresult)) {
                                            $selected = in_array($row["id"], $service_array) ? 'selected' : '';
                                            echo "<option value='" . $row["id"] . "' $selected>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="note" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Ghi chú" value="<?php echo $note ?>">
                            </div>
                            <div>
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="2" <?php if ($Status == 2) {echo "selected";} ?>>Hủy đặt phòng</option>
                                    <option value="1" <?php if ($Status == 1) {echo "selected";} ?>>Đã thanh toán</option>
                                    <option value="0" <?php if ($Status == 0) {echo "selected";} ?>>Chưa thanh toán</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="reservation.php" class="btn btn-secondary">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary" name="guestdetailedit">Hoàn thành</button>
                    </div>
                </form>
            </div>
            <?php include 'footer.php'; ?>
