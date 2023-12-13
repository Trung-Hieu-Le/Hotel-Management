<?php include 'header.php' ?>
<?php
if (isset($_GET['cancel'])) {
    $reservationID = $_GET['cancel'];
    $userID = $_GET['id'];

    $sql = "UPDATE reservation SET status = 2 WHERE id = '$reservationID' AND user_id = '$userID'";
    $result = mysqli_query($conn, $sql);
    $update_sql = "UPDATE room
                    INNER JOIN reservation ON room.id = '$room_id' AND reservation.id = '$id'
                    SET room.status = 1";
    $result2 = mysqli_query($conn, $update_sql);
    if ($result & $result2) {
        echo "<script>
                        swal({
                            title: 'Cập nhật thành công',
                            icon: 'success',
                        }).then(function() {
                            window.location.href = 'reservation_history.php?id=$userID';
                        });
                    </script>";
    } else {
        echo "<script>
                        swal({
                            title: 'Cập nhật thành công',
                            icon: 'success',
                        }).then(function() {
                            window.location.href = 'reservation_history.php?id=$userID';
                        });
                    </script>";
    }
}
?>
<body>
    <div class="container" style="margin-top:100px;">
    <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Số phòng</th>
                    <th scope="col">Số khách</th>
                    <th scope="col">Ngày nhận phòng</th>
                    <th scope="col">Ngày trả phòng</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="action">Hành động</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "select * from reservation where user_id='$userID'";
                $re = mysqli_query($conn, $sql);
                while ($res = mysqli_fetch_array($re)) {
                ?>
                    <tr style="height:80px;">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['no_room'] ?></td>
                        <td><?php echo $res['no_guess'] ?></td>
                        <td><?php echo $res['check_in'] ?></td>
                        <td><?php echo $res['check_out'] ?></td>
                        <td>
                            <?php 
                                if ($res['status']==0) echo 'Chưa thanh toán';
                                elseif ($res['status']==1) echo 'Đã thanh toán';
                                else echo 'Hủy đặt phòng';
                            ?>
                        </td> 
                        <td class="action">
                            <?php if($res['status']==1){ ?>
                            <a href="feedback.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Đánh giá</button></a>
                            <?php } elseif ($res['status']==0) { ?>
                            <a href="reservation_history.php?id=<?php echo $userID ?>&cancel=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc hủy đặt phòng này không?')"><button class="btn btn-primary">Hủy đặt phòng</button></a>
                            <?php } ?>    
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<?php include 'footer.php' ?>