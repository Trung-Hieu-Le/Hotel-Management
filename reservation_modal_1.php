<?php include 'header.php' ?>

<?php
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header("Location:index.php");
}
// if (!isset($_SESSION["products_error"])) {
//     $_SESSION["products_error"] = "";
// }
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
if (!isset($_REQUEST["modal1"])) {
    $modal1 = "";
} else {
    $modal1 = "modal1";
}


if (strtotime($cin) > strtotime($cout)) {
    echo "<script>alert('Ngày nhận phòng không được hơn ngày trả phòng.');";
    echo "window.location.href='reservation_modal_1.php';</script>";
}
$room_ids = [];
$no_room = 0;
$total_bed = 0;
$sql_count_beds = "SELECT SUM(room.no_bed) AS total_beds
    FROM room
    LEFT JOIN room_type ON room_type.id = room.type_id
    WHERE room.status = 1";
$result_count_beds = $conn->query($sql_count_beds) or die($conn->error);
$total_bed_row = $result_count_beds->fetch_assoc();
$total_bed = $total_bed_row['total_beds'];

if ($no_guess > $total_bed) {
    echo "<script>alert('Xin lỗi, khách sạn hiện không đủ phòng cho " . $no_guess . " khách trong khoảng thời gian bạn chọn. Vui lòng chọn lại hoặc thay đổi số lượng khách.');";
    echo "window.location.href='reservation_modal_1.php?&cin=$cin&cout=$cout';</script>";
    exit();
}

$sql = "SELECT room.id, room.name, room.no_bed, room_type.name as room_type, room_type.image, room_type.price 
    FROM room
    LEFT JOIN room_type ON room_type.id = room.type_id
    WHERE room.status = 1
    ORDER BY no_bed DESC, price DESC, room.name";
$result = $conn->query($sql) or die($conn->error);

if (isset($_POST['nextModal2'])) {
    if (isset($_POST['selected_room']) && is_array($_POST['selected_room']) && count($_POST['selected_room']) > 0) {
        $room_ids = $_POST['selected_room'];
        $total_selected_beds = 0;
        foreach ($room_ids as $room_id) {
            // Thực hiện truy vấn để lấy số giường từng phòng
            $sql_bed_count = "SELECT no_bed FROM room WHERE id = $room_id";
            $result_bed_count = $conn->query($sql_bed_count) or die($conn->error);
            $row_bed_count = $result_bed_count->fetch_assoc();
            $total_selected_beds += $row_bed_count['no_bed'];
        }

        if ($total_selected_beds < $no_guess) {
            echo "<script>alert('Số giường bạn chọn ít hơn số hành khách đã chọn. Vui lòng chọn thêm phòng hoặc giảm số hành khách.');</script>";
        } else {
            header("Location: reservation_modal_2.php?cin=$cin&cout=$cout&no_guess=$no_guess&no_room=" . count($room_ids) . "&room_ids=" . implode(',', $room_ids) . "&total_price_room=$total_price_room");
        }
    } else {
        echo "<script>alert('Vui lòng chọn ít nhất một phòng.');</script>";
    }
}
?>

<body>
    <div>
        <div class="modal-dialog" style="max-width:1200px; top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG - CHỌN PHÒNG:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="GET">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <label for="cin" class="form-label">Ngày nhận phòng</label>
                                <input name="cin" type="date" class="form-control" value="<?php echo $cin; ?>" <?php echo ($modal1) ? 'readonly' : 'required'; ?>>
                            </div>
                            <div class="col-3">
                                <label for="cout" class="form-label">Ngày trả phòng</label>
                                <input name="cout" type="date" class="form-control" value="<?php echo $cout; ?>" <?php echo ($modal1) ? 'readonly' : 'required'; ?>>
                            </div>
                            <div class="col-3">
                                <label for="no_guess" class="form-label">Số hành khách:</label>
                                <select name="no_guess" id="no_guess" class="form-select" <?php echo ($modal1) ? 'disabled' : 'required'; ?>>
                                    <option value="" disabled <?php echo (!$no_guess) ? 'selected' : ''; ?>>Chọn số hành khách</option>
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
                                    <?php if (!$modal1) { ?>
                                        <button type="submit" class="btn btn-primary" name="modal1">Tìm kiếm phòng</button>
                                    <?php } else { ?>
                                        <a href="reservation_modal_1.php" class="btn btn-primary">Quay lại</a>
                                    <?php } ?>
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
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["name"] ?></td>
                                        <td><img src='./image/room_type/<?php echo $row["image"]; ?>' style="width:100px; margin-bottom:10px;"></td>
                                        <td><?php echo $row["price"]; ?></td>
                                        <td><?php echo $row["no_bed"]; ?></td>
                                        <td><?php echo $row["room_type"]; ?></td>
                                        <td><input type='checkbox' name='selected_room[]' value=<?php echo $row["id"] ?> data-price='<?php echo $row["price"] ?>'></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </table>

                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <p class="text-danger mb-0">Tiền phòng: <span id="totalPriceRoom">0</span>VNĐ</p>
                            <input type="hidden" id="hiddenTotalRoom" name="total_price_room" value="">
                        </div>
                        <a href="home.php" class="btn btn-secondary">
                            Quay lại trang chính
                        </a>
                        <button type="submit" class="btn btn-primary" name="nextModal2">Tiếp</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</body>
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
<?php include 'footer.php' ?>