<?php include 'header.php'; ?>

<?php
if (isset($_GET['showHandle'])) {
    $id = $_GET['showHandle'];
    $status = $_GET['status'];
    if ($status==1) {$statussql = "UPDATE feedback SET status = 0 WHERE id = $id";}
    else {$statussql = "UPDATE feedback SET status = 1 WHERE id = $id";}
    $result = mysqli_query($conn, $statussql) or die($conn->error);
    if ($result) {
        header("Location: feedback.php");
    }
    else {
        echo "<script>alert('Lỗi khi hiển thị đánh giá');</script>";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deletesql = "DELETE FROM feedback WHERE id = $id";
    $result = mysqli_query($conn, $deletesql) or die($conn->error);
    if ($result) {
        header("Location: feedback.php");
    }
}

?>
<?php include('sidebar.php')?>
  <div class="main-content">
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="Nhập từ khóa tìm kiếm..." onkeyup="searchFun()">
    </div>
    <div class="room">
        <?php
        $sql = "select feedback.*, user.name as username from feedback JOIN user ON feedback.user_id = user.id ORDER BY feedback.id DESC";
        $re = mysqli_query($conn, $sql);

        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id đặt phòng</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Đánh giá</th>
                    <th scope="col">Nội dung</th>
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
                        <td><?php echo $res['reservation_id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['rate'] ?></td>
                        <td><?php echo $res['content'] ?></td>
                        <td><?php echo $res['status'] == 0 ? 'Ẩn' : 'Hiện'; ?></td>
                        <td class="action">
                            <a href="feedback.php?showHandle=<?php echo $res['id'] ?>&status=<?php echo $res['status'] ?>"><button class="btn btn-primary">
                            <?php echo $res['status'] == 0 ? 'Hiện' : 'Ẩn'; ?>
                            </button></a>
                            <a href="feedback.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
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
