<?php
session_start();
include '../config.php';
?>
<?php
                // Xử lý xóa phòng
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $roomdeletesql = "DELETE FROM room_type WHERE id = $id";
                    $result = mysqli_query($conn, $roomdeletesql) or die($conn->error);
                    if ($result) {
                        header("Location: roomtype.php");
                    }
                }

// Xử lý thêm phòng
        if (isset($_POST['addroomtype'])) {
            $name = $_POST['name'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $status = $_POST['status'];

            $check_query = "SELECT * FROM room_type WHERE name = '$name'";
            $check_result = mysqli_query($conn, $check_query);
            
            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('Loại phòng đã tồn tại');</script>";
            } else {
            $sql = "INSERT INTO room_type(name,image,description,price,status) VALUES ('$name','$image','$description','$price',b'$status')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: roomtype.php");
            }
            else {
                echo "<script>alert('Lỗi khi thêm loại phòng');</script>";
            }
        }
        }
        ?>

<?php include 'header.php'; ?>

<div class="searchsection">
    <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
        Thêm loại phòng
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:750px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm loại phòng</h5>
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
                            <label for="image">Hình ảnh :</label>
                            <input type="text" name="image" class="form-control" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="price">Giá :</label>
                            <input type="text" name="price" class="form-control" pattern="[0-9]+" title="Nhập số từ 0-9" required>
                        </div>

                    </div>
                    
                    <div class="row h-100">
                        <div class="col-lg-6">
                            <label for="description">Mô tả :</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="status">Trạng thái:</label>
                            <select name="status" class="form-control" required>
                                <option value="1" selected>Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addroomtype">Thêm loại phòng</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="room">
        <?php
        $sql = "select room_type.* from room_type";
        $re = mysqli_query($conn, $sql)
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="action">Hành động</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($re)) {
                ?>
                    <tr style="height:80px;">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><img src='../image/room_type/<?php echo $res["image"]; ?>' style="width:100px; height:100px;"></td>
                        <td><?php echo $res['description'] ?></td>
                        <td><?php echo $res['price'] ?></td>
                        <td><?php echo $res['status'] == 0 ? 'Không hoạt động' : 'Hoạt động'; ?></td> 
                        <td class="action">
                            <a href="roomtypeedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="roomtype.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
