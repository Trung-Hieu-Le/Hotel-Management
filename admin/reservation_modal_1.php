<?php
include '../config.php';

if (!isset($_REQUEST["cin"])) {
    $cin = "";
} else {
    $cin = $_REQUEST["cin"];
}
if (!isset($_REQUEST["cout"])) {
    $cout = "";
} else {
    $cout = $_REQUEST["cout"];
}
if (!isset($_REQUEST["no_guess"])) {
    $no_guess = "";
} else {
    $no_guess = $_REQUEST["no_guess"];
}
if (!isset($_REQUEST["total_price_room"])) {
    $total_price_room = 0;
} else {
    $total_price_room = $_REQUEST["total_price_room"];
}
if (!isset($_REQUEST["page"])) {
    $page = 1;
} else {
    $page = $_REQUEST["page"];
}
if (!isset($_REQUEST["modal1"])) {
    $modal1 = "";
} else {
    $modal1 = "modal1";
}


if (strtotime($cin) > strtotime($cout)) {
    echo "<script>alert('Ngày đặt phòng không được hơn ngày trả phòng.');";
    echo "window.location.href='reservation_modal_1.php';</script>";
    exit();
}
$room_ids = [];
$no_room = 0;
$total_bed = 0;
$sql = "SELECT room.id, room.name, room.no_bed, room_type.name as room_type, room_type.image, room_type.price 
    FROM room
    LEFT JOIN room_type ON room_type.id = room.type_id
    WHERE room.status = 1
    ORDER BY no_bed DESC, room.id";
$result = $conn->query($sql) or die($conn->error);
while ($row = mysqli_fetch_assoc($result)) {
    $total_bed += $row['no_bed'];
}
if ($no_guess > $total_bed) {
    echo "<script>alert('Xin lỗi, khách sạn hiện không đủ phòng cho " . $no_guess . " khách trong khoảng thời gian bạn chọn. Vui lòng chọn lại hoặc thay đổi số lượng khách.');";
    echo "window.location.href='reservation_modal_1.php?&cin=$cin&cout=$cout';</script>";
    exit();
}
$num_row_of_page = 10;
$num_page = ceil($result->num_rows / $num_row_of_page);
if ($page > $num_page) {
    $page = $num_page;
}
if ($page < 1) {
    $page = 1;
}

$sql2 = "SELECT room.id, room.name, room.no_bed, room_type.name as room_type, room_type.image, room_type.price
    FROM room
    LEFT JOIN room_type ON room_type.id = room.type_id
    WHERE room.status = 1
    ORDER BY no_bed DESC, room.id limit " . $num_row_of_page * ($page - 1) . "," . $num_row_of_page;
$result2 = $conn->query($sql2) or die($conn->error);

if (isset($_POST['nextModal2'])) {
    
    if (isset($_POST['selected_room']) && is_array($_POST['selected_room']) && count($_POST['selected_room']) > 0) {
        $room_ids = $_POST['selected_room'];
        header("Location: reservation_modal_2.php?cin=$cin&cout=$cout&no_guess=$no_guess&no_room=" . count($room_ids) . "&room_ids=" . implode(',', $room_ids) . "&total_price_room=$total_price_room");
    } else {
        echo "<script>alert('Vui lòng chọn ít nhất một phòng.');</script>";
    }
}
?>

<?php include 'header.php'; ?>

    <div>
        <div>
            <div>
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG - CHỌN PHÒNG:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="GET">
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3"><label for="cin" class="form-label">Ngày đến</label>
                                <input name="cin" type="date" class="form-control" value="<?php echo $cin; ?>" required>
                            </div>
                            <div class="col-3"><label for="cout" class="form-label">Ngày đi</label>
                                <input name="cout" type="date" class="form-control" value="<?php echo $cout; ?>" required>
                            </div>
                            <div class="col-3"><label for="no_guess" class="form-label">Số hành khách:</label>
                                <select name="no_guess" id="no_guess" class="form-select">
                                    <option value="" disabled>Chọn số hành khách</option>
                                    <?php
                                        for ($i = 1; $i <= 20; $i++) {
                                            $selected = ($no_guess == $i) ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-3 position-relative">
                                <div class="position-absolute bottom-0">
                                    <button type="submit" class="btn btn-primary" name="modal1">Tìm kiếm phòng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form action="" method="POST">
                <div id="availableRoomsList" class="ms-3">
                    <?php if ($modal1 <> "") { ?>
                        <br>
                        <table align=center width=100%>
                            <tr>
                                <th>Tên phòng</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số giường</th>
                                <th>Phân loại</th>
                                <th>Lựa chọn</th>
                            </tr>
                            <?php
                            while ($row = $result2->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><img src='../image/room_type/<?php echo $row["image"]; ?>' style="width:100px; margin-bottom:10px;"></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row["no_bed"]; ?></td>
                                    <td><?php echo $row["room_type"]; ?></td>
                                    <td><input type='checkbox' name='selected_room[]' value=<?php echo $row["id"]?> data-price='<?php echo $row["price"] ?>'></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </table>
                        <center>
                            <?php
                            for ($i = 1; $i <= $num_page; $i++) {
                                if ($i == $page) {
                                    echo (" " . $i . " ");
                                } else {
                                    echo " <a href=?page=$i&cin=$cin&cout=$cout&no_guess=$no_guess&modal1=modal1>$i</a> ";
                                }
                            }
                            ?>
                        </center>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <div>
                        <p class="text-danger mb-0">Tiền phòng: <span id="totalPriceRoom">0</span></p>
                        <input type="hidden" id="hiddenTotalRoom" name="total_price_room" value="">
                    </div>
                    <a href="reservation.php" class="btn btn-secondary">
                        Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary" name="nextModal2">Tiếp</button>
                </div>
            </form>
               
            </div>

        </div>
    </div>
</body>
<!-- <script src="./javascript/roombook.js"></script> -->
<script>
    const checkboxes = document.querySelectorAll('input[name="selected_room[]"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', updateTotalRoom);
    });

    function updateTotalRoom() {
        let totalRoom = 0;
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                totalRoom += parseInt(checkbox.getAttribute('data-price'));
            }
        });
        document.getElementById('totalPriceRoom').textContent = totalRoom;
        document.getElementById('hiddenTotalRoom').value = totalRoom;
    }
</script>
</html>
