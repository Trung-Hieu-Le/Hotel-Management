<?php include 'header.php'; ?>

<?php
//Xóa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // TODO: sửa delete, statusroom=1
    $sql_delete_room = "UPDATE room JOIN chosen_room ON chosen_room.room_id = room.id
                            JOIN reservation ON chosen_room.reservation_id = reservation.id
                            SET room.status= 1 WHERE reservation.id = '$id' AND reservation.status = 0";
    $result_delete_room = mysqli_query($conn, $sql_delete_room);
    
    $deletesql = "DELETE FROM reservation WHERE id = $id";
    $result = mysqli_query($conn, $deletesql);

    $deletesql = "DELETE FROM chosen_room WHERE reservation_id = $id";
    $result = mysqli_query($conn, $deletesql);
    
    $deletesql = "DELETE FROM chosen_service WHERE reservation_id = $id";
    $result = mysqli_query($conn, $deletesql);
    header("Location:reservation.php");
}

?>


    <!-- ================================================= -->
<?php include('sidebar.php')?>
  <div class="main-content">
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="Nhập từ khóa tìm kiếm..." onkeyup="searchFun()">
        <a href="reservation_modal_1.php" class="btn btn-primary">
            Đặt phòng
        </a>
    </div>


        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Chọn phương thức thanh toán</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="paymentForm" action="payment.php" method="GET">
                            <input type="hidden" name="add" id="reservationIDInput">
                            <input type="hidden" name="method" id="methodInput">
                            <label for="paymentMethod">Chọn phương thức thanh toán:</label>
                            <select name="paymentMethod" id="paymentMethod" class="form-select mb-3">
                                <option value="Tiền mặt">Tiền mặt</option>
                                <option value="Chuyển khoản">Chuyển khoản</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="room">

        <?php
        $roombooktablesql = "SELECT reservation.*, user.name AS username, user.phone, GROUP_CONCAT(service.name SEPARATOR ', ') AS listservice
    FROM reservation
    JOIN user ON reservation.user_id = user.id
    -- JOIN room_type ON reservation.room_type = room_type.id
    LEFT JOIN chosen_service ON reservation.id = chosen_service.reservation_id
    LEFT JOIN service ON chosen_service.service_id = service.id
    GROUP BY reservation.id ORDER BY reservation.id DESC";
        $roombookresult = mysqli_query($conn, $roombooktablesql);
        // $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên khách</th>
                    <!-- <th scope="col">Email</th> -->
                    <!-- <th scope="col">Địa chỉ</th> -->
                    <th scope="col">SĐT</th>
                    <!-- <th scope="col">Loại phòng</th> -->
                    <th scope="col">Số phòng</th>
                    <th scope="col">Số hành khách</th>
                    <th scope="col">Dịch vụ</th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col" class="action">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($roombookresult)) {
                ?>
                    <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['phone'] ?></td>
                        <td><?php echo $res['no_room'] ?></td>
                        <td><?php echo $res['no_guess'] ?></td>
                        <td>
                            <?php
                            if (isset($res['listservice'])) {
                                echo $res['listservice'];
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                        <td><?php echo date('d-m-Y', strtotime($res['check_in'])) ?></td>
                        <td><?php echo date('d-m-Y', strtotime($res['check_out'])) ?></td>
                        <td><?php echo $res['no_day'] ?></td>
                        <td>
                            <?php
                            if ($res['status'] == 0) echo 'Chưa thanh toán';
                            elseif ($res['status'] == 1) echo 'Đã thanh toán';
                            elseif ($res['status'] == 2) echo 'Hủy đặt phòng';
                            else echo 'Chưa rõ trạng thái';
                            ?>
                        </td>
                        <td><?php echo $res['note'] ?></td>
                        <td class="action">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal" onclick="setReservationID(<?php echo $res['id']; ?>)">
                                Bill
                            </button>
                            <a href="reservationedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="reservation.php?delete=<?php echo $res['id'] ?>" onclick="return confirm('Bạn có chắc không?')"><button class='btn btn-danger'>Xóa</button></a>
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
<script>
    let reservationID = null;

    function setReservationID(id) {
        reservationID = id;
        document.getElementById('reservationIDInput').value = id;
    }

    function redirectToPayment() {
        const selectedMethod = document.getElementById('paymentMethod').value;
        document.getElementById('methodInput').value = selectedMethod;
    }
    document.getElementById('paymentForm').addEventListener('submit', redirectToPayment);
</script>
