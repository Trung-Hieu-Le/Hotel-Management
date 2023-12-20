<?php include 'header.php' ?>

<?php
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
  }
  else{ 
    header("Location:index.php");
  }
//Thêm vào bảng reservation
if (isset($_POST['reservationSubmit'])) {
    // $userID = $_POST['user'];
    
    $note = $_POST['note'];
    $noRoom = $_GET['no_room'];
    $noGuess = $_GET['no_guess'];
    $cin = $_GET['cin'];
    $cout = $_GET['cout'];
    $status = 0;

            $sql = "INSERT INTO reservation(user_id,no_room,no_guess,check_in,check_out,no_day,status,note)
                 VALUES ('$userID','$noRoom','$noGuess','$cin','$cout',datediff('$cout','$cin')+1,$status,'$note')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $reservationId = mysqli_insert_id($conn);

            if (isset($_GET['room_ids'])) {
                $room_ids = $_GET['room_ids'];
                $room_ids_array = explode(',', $room_ids);
                foreach ($room_ids_array as $room_id) {
                    $sql = "INSERT INTO chosen_room (reservation_id, room_id) VALUES ('$reservationId', '$room_id')";
                    $result2 = mysqli_query($conn, $sql);
                    if (!$result2) {
                        echo "<script>alert('Có lỗi xảy ra khi thêm phòng');</script>";
                    } else {
                        $update_status_sql = "UPDATE room
                                              JOIN chosen_room ON room.id = chosen_room.room_id
                                              SET room.status = 2
                                              WHERE room.id = '$room_id' AND chosen_room.reservation_id = $reservationId";
                        $update_status_result = mysqli_query($conn, $update_status_sql);
                        if (!$update_status_result) {
                            echo "<script>alert('Có lỗi xảy ra khi cập nhật trạng thái phòng');</script>";
                        }
                    }
                }
            }
            if (isset($_POST['service']) && is_array($_POST['service'])) {
                foreach ($_POST['service'] as $service_id) {
                    $sql = "INSERT INTO chosen_service (reservation_id, service_id) VALUES ('$reservationId', '$service_id')";
                    $result3 = mysqli_query($conn, $sql);
                    if (!$result3) {
                        // Handle the error, for example, log it or display a message
                        echo "<script>alert('Có lỗi xảy ra khi thêm dịch vụ');</script>";
                    }
                }
            }
            
            echo "<script>
                        swal({
                            title: 'Đặt phòng thành công',
                            icon: 'success',
                        }).then(function() {
                            window.location.href = 'home.php';
                        });
                    </script>";
                    // header("Location: home.php");

        } else {
            echo "<script>alert('Có lỗi xảy ra');</script>";

        }
}
?>

<body>
    <div>
        <div class="modal-dialog" style="max-width:1200px; top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐẶT PHÒNG - ĐIỀN THÔNG TIN:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="POST">
                    <div class="row modal-body">
                        <div class="col">
                            <h4><u>Thông tin khách hàng:</u></h4>
                            <?php 
                                $sql = "SELECT * FROM user WHERE id = $userID";
                                $result = $conn->query($sql) or die($conn->error);
                                if (mysqli_num_rows($result) > 0) {
                                        // echo "<p>Tên:</p>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<p>Họ tên: " . $row["name"] . "</p>";
                                        echo "<p>Số điện thoại: " . $row["phone"] . "</p>";
                                        echo "<p>Địa chỉ: " . $row["address"] . "</p>";
                                        echo "<p>Email: " . $row["email"] . "</p>";
                                    }
                                } else {
                                    echo "Không tìm thấy thông tin người dùng";
                                }                        
                            ?>
                        </div>


                        <div class="col">
                            <h4><u>Thông tin chi tiết đặt phòng:</u></h4>
                            <?php 
                                echo "<p>Ngày nhận phòng: ".date('d-m-Y', strtotime($_GET["cin"]))."</p>";
                                echo "<p>Ngày trả phòng: ".date('d-m-Y', strtotime($_GET["cout"]))."</p>";
                                echo "<p>Số hành khách: ".$_GET["no_guess"]."</p>";
                                echo "<p>Số phòng: ".$_GET["no_room"]."</p>";
                            ?>
                            <!-- Dropdown Dịch vụ -->
                            <div>
                                <label for="serviceSelect" class="form-label">Dịch vụ:</label>
                                <select name="service[]" class="select multiselect" id="multiService" style="width:100%;"
                                multiple multiselect-search="true" multiselect-select-all="true">
                                    <?php
                                    $servicesql = "SELECT id, name, price FROM service WHERE status = 1";
                                    $serviceresult = mysqli_query($conn, $servicesql);
                                    if (mysqli_num_rows($serviceresult) > 0) {
                                        while ($row = mysqli_fetch_assoc($serviceresult)) {
                                            echo "<option value='" . $row["id"] . "' data-price='" . $row["price"] . "'>" . $row["name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="note" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Ghi chú">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <!-- <div class="float-left">
                        <p class="text-danger mb-0">Tiền phòng: <span><?php echo $_GET["total_price_room"] ?></span>VNĐ</p>
                        <p class="text-danger mb-0">Tiền dịch vụ: <span id="totalPriceService">0</span>VNĐ</p>
                        <hr style="margin: 0.25rem 0; color:red;">
                        <p class="text-danger mb-0">Tổng tiền dự tính: <span id="totalPrice">0</span>VNĐ</p>
                    </div> -->
                        <a href="reservation_modal_1.php" class="btn btn-secondary">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary" name="reservationSubmit">Hoàn thành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- <script>
    const totalRoom = parseInt("<?php echo $_GET['total_price_room']; ?>");
    const multiService = document.getElementById('multiService');
    let total = totalRoom;
    document.getElementById('totalPrice').textContent = total;
    multiService.addEventListener('change', updateTotalService);

    function updateTotalService() {
        const selectedServices = multiService.selectedOptions;
        let totalService = 0;
        for (const option of selectedServices) {
        totalService += parseInt(option.getAttribute('data-price'));
        }
        const noGuess = parseInt("<?php echo $_GET['no_guess']; ?>");
        const totalServiceWithGuest = totalService * noGuess;
        console.log(totalServiceWithGuest);
        const total = totalRoom + totalServiceWithGuest;
        document.getElementById('totalPriceService').textContent = totalServiceWithGuest;
        document.getElementById('totalPrice').textContent = total;
}
</script> -->
<?php include 'footer.php' ?>