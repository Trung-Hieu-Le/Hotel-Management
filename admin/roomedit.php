<?php include 'header.php'; ?>
<?php

// fetch room data
$id = $_GET['id'];

$sql = "SELECT * FROM room WHERE id = '$id'";
$re = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($re)) {
    $Name = $row['name'];
    $RoomType = $row['type_id'];
    $Bed = $row['no_bed'];
    $Status = $row['status'];
    $Note = $row['note'];
}

if (isset($_POST['roomdetailedit'])) {
    $EditName = $_POST['Name'];
    $EditRoomType = $_POST['RoomType'];
    $EditBed = $_POST['Bed'];
    $EditStatus = $_POST['Status'];
    $EditNote = $_POST['Note'];

    // if (empty($EditUserID) || empty($EditNoofRoom) || empty($EditRoomType)) {
    //     echo "<script>swal({
    //         title: 'Hãy nhập đầy đủ thông tin và ngày đi không được trước ngày đến',
    //         icon: 'error',
    //     });
    //     </script>";
    // }
    // else {
    $check_query = "SELECT * FROM room WHERE name = '$EditName' AND id <> $id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Phòng đã tồn tại');</script>";
    } else {
    $sql = "UPDATE room SET name = '$EditName', type_id = '$EditRoomType', no_bed = '$EditBed', status = '$EditStatus', note = '$EditNote' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:room.php");
        echo "<script>alert('Sửa phòng thành công');</script>";
    } else {
        echo "<script>alert('Lỗi khi sửa phòng');</script>";
    }
}
}

?>

<?php include('sidebar.php')?>
  <div class="main-content">
    <div style="max-width:1000px; border: 1px solid black; margin: 50px auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">SỬA THÔNG TIN PHÒNG:</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <form action="" method="POST">
            <div class="row modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="name">Tên:</label>
                        <input type="text" name="Name" class="form-control" id="phone-input" value="<?php echo $Name ?>" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Loại phòng:</label>
                        <select name="RoomType" class="form-control">
                            <option disabled>Loại phòng</option>
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
                    </div>
                    <div class="col-lg-4">
                        <label for="image">Số giường:</label>
                        <select name="Bed" class="form-control">
                            <option disabled>Số giường</option>
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                $selected = "";
                                if ($Bed == $i) {
                                    $selected = "selected";
                                }
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="phone">Ghi chú :</label>
                        <input type="text" name="Note" class="form-control" id="phone-input" value="<?php echo $Note ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Trạng thái :</label>
                        <select name="Status" class="form-control">
                            <option disabled>Trạng thái</option>
                            <option value="2" <?php if ($Status == 2) {
                                                    echo "selected";
                                                } ?>>Đã đặt</option>
                            <option value="1" <?php if ($Status == 1) {
                                                    echo "selected";
                                                } ?>>Phòng trống</option>
                            <option value="0" <?php if ($Status == 0) {
                                                    echo "selected";
                                                } ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="room.php" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary" name="roomdetailedit">Hoàn thành</button>
            </div>
        </form>
    </div>
  </div>
    <?php include 'footer.php'; ?>