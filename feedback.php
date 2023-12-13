<?php include 'header.php' ?>

<?php
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header("Location:index.php");
}
//Thêm vào bảng reservation
if (isset($_POST['feedbackSubmit'])) {
    // $userID = $_POST['user'];
    $reservationId=$_GET["id"];
    $rate = $_POST['rate'];
    $content = $_POST['content'];
    $status = 0;

    $sql = "INSERT INTO feedback(user_id,reservation_id,rate,content,status)
                 VALUES ('$userID','$reservationId','$rate','$content',b'$status')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>swal({
                            title: 'Đánh giá thành công',
                            icon: 'success',
                        });
                    </script>";
        header("Location: reservation_history.php");
    } else {
        echo "<script>swal({
                                title: 'Xin vui lòng thử lại',
                                icon: 'error',
                            });
                    </script>";
    }
}
?>

<body>
    <div>
        <div class="modal-dialog" style="max-width:1200px; top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">ĐÁNH GIÁ DỊCH VỤ CỦA CHÚNG TÔI:</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form action="" method="POST">
                    <div class="p-3">
                        <table>
                            <tr>
                                <td>Đánh giá:</td>
                                <td>
                                    <select name="rate">
                                        <option value="1">1 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="5" selected>5 sao</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Nội dung:</td>
                                <td>
                                    <textarea name="content" style="width:600px;" cols="30" rows="5" required></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">

                        <a href="reservation_history.php" class="btn btn-secondary">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary" name="feedbackSubmit">Hoàn thành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include 'footer.php' ?>