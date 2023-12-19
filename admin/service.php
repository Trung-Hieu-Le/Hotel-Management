<?php include 'header.php'; ?>

<?php
//Xóa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $servicedeletesql = "DELETE FROM service WHERE id = $id";
    $result = mysqli_query($conn, $servicedeletesql);
    if (!$result) {
        die('Lỗi MySQL: ' . mysqli_error($conn));
    }
    if ($result) {
        header("Location: service.php");
    } else {
        echo "Lỗi trong quá trình xóa dịch vụ.";
    }
}
//Thêm
if (isset($_POST['addservice'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $check_query = "SELECT * FROM service WHERE name = '$name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Dịch vụ đã tồn tại');</script>";
    } else {
        $sql = "INSERT INTO service(name,image,price,description,status) VALUES ('$name','$image','$price','$description',b'$status')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: service.php");
        } else {
            echo "<script>alert('Lỗi khi thêm dịch vụ');</script>";
        }
    }
}
?>
<?php include('sidebar.php')?>
  <div class="main-content">
<div class="searchsection">
    <input type="text" name="search_bar" id="search_bar" placeholder="Nhập từ khóa tìm kiếm..." onkeyup="searchFun()">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        Thêm dịch vụ
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:750px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm dịch vụ</h5>
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
                    <button type="submit" class="btn btn-primary" name="addservice">Thêm dịch vụ</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="room">
    <?php
    $sql = "select * from service";
    $re = mysqli_query($conn, $sql)
    ?>
    <table class="table table-bordered" id="table-data">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Mô tả</th>
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
                    <td><img src='../image/service/<?php echo $res["image"]; ?>' style="width:100px; height:100px;"></td>
                    <td><?php echo number_format($res['price']) ?></td>
                    <td><?php echo $res['description'] ?></td>
                    <td><?php echo $res['status'] == 0 ? 'Không hoạt động' : 'Hoạt động'; ?></td>
                    <td class="action">
                        <a href="serviceedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                        <a href="service.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
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