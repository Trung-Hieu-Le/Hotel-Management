<?php include 'header.php'; ?>

<?php
// Xử lý xóa phòng
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $roomdeletesql = "DELETE FROM room WHERE id = $id";
    $result = mysqli_query($conn, $roomdeletesql) or die($conn->error);
    if ($result) {
        header("Location: room.php");
    }
}

// Xử lý thêm phòng
if (isset($_POST['addroom'])) {
    $typeofroom = $_POST['troom'];
    $name = $_POST['name'];
    $typeofbed = $_POST['bed'];
    $status = $_POST['status'];
    $note = $_POST['note'];

    $check_query = "SELECT * FROM room WHERE name = '$name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Phòng đã tồn tại');</script>";
    } else {
        $sql = "INSERT INTO room(type_id,name,no_bed,note,status) VALUES ('$typeofroom','$name','$typeofbed','$note','$status')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: room.php");
        } else {
            echo "<script>alert('Lỗi khi thêm phòng');</script>";
        }
    }
}
?>

<?php include('sidebar.php')?>
  <div class="main-content">
<div class="searchsection">
    <input type="text" name="search_bar" id="search_bar" placeholder="Nhập từ khóa tìm kiếm..." onkeyup="searchFun()">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
        Thêm phòng
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:750px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row h-100">
                        <div class="col-lg-4">
                            <label for="name">Tên :</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="image">Loại phòng:</label>
                            <select name="troom" class="form-control" required>
                                <option disabled>Loại phòng</option>
                                <?php
                                $roomtypesql = "SELECT id, name FROM room_type WHERE status = 1 ";
                                $roomtyperesult = mysqli_query($conn, $roomtypesql);
                                if (mysqli_num_rows($roomtyperesult) > 0) {
                                    while ($row = mysqli_fetch_assoc($roomtyperesult)) {
                                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="price">Số giường :</label>
                            <select name="bed" class="form-control" required>
                                <option disabled>Số giường</option>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                    </div>

                    <div class="row h-100">
                        <div class="col-lg-6">
                            <label for="description">Ghi chú:</label>
                            <input type="text" name="note" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="status">Trạng thái:</label>
                            <select name="status" class="form-control">
                                <option value="2">Đã đặt</option>
                                <option value="1" selected>Phòng trống</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addroom">Thêm phòng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="room">
    <?php
    $sql = "select room.*, room_type.name as roomtype from room JOIN room_type ON room.type_id = room_type.id ORDER BY id";
    $re = mysqli_query($conn, $sql)
    ?>
    <table class="table table-bordered " id="table-data">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Loại phòng</th>
                <th scope="col">Số giường</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ghi chú</th>
                <th scope="col" class="action">Hành động</th>
                <!-- <th>Delete</th> -->
            </tr>
        </thead>

        <tbody>
            <?php
            while ($res = mysqli_fetch_array($re)) {
            ?>
                <tr>
                    <td><?php echo $res['id'] ?></td>
                    <td><?php echo $res['name'] ?></td>
                    <td><?php echo $res['roomtype'] ?></td>
                    <td><?php echo $res['no_bed'] ?></td>
                    <?php
                    $status = $res['status'];
                    if ($status == 0) {
                        echo '<td>Không hoạt động</td>';
                    } elseif ($status == 1) {
                        echo '<td>Phòng trống</td>';
                    } elseif ($status == 2) {
                        echo '<td>Đã đặt</td>';
                    } else {
                        echo '<td>Trạng thái không xác định</td>';
                    }
                    ?>
                    <td><?php echo $res['note'] ?></td>
                    <td class="action">
                        <a href="roomedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                        <a href="room.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
  </div>
<?php include 'footer.php'; ?>
