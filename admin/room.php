<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueBird - Admin</title>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/room.css">
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <div class="h-100 py-2">
                <div class="row h-100">
                    <div class="col-4">
                        <label for="name">Tên phòng:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <!-- TODO: Kiểu phòng là Varchar -->
                    <div class="col-4">
                        <label for="troom">Loại phòng :</label>
                        <select name="troom" class="form-control">
                            <option value selected></option>
                            <option value="Superior Room">SUPERIOR ROOM</option>
                            <option value="Deluxe Room">DELUXE ROOM</option>
                            <option value="Guest House">GUEST HOUSE</option>
                            <option value="Single Room">SINGLE ROOM</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="bed">Số giường:</label>
                        <select name="bed" class="form-control">
                            <option value selected></option>
                            <option value="Đơn">Đơn</option>
                            <option value="Đôi">Đôi</option>
                            <option value="Ba">Ba</option>
                            <option value="Bốn">Bốn</option>
                            <!-- <option value="Triple">None</option> -->
                        </select>
                    </div>
                </div>
                <div class="row h-100">
                <div class="col-4">
                        <label for="status">Trạng thái:</label>
                        <select name="status" class="form-control">
                            <option value="1" selected>Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="note">Ghi chú (nếu có):</label>
                        <input type="text" name="note" class="form-control">
                    </div>
                    <div class="col-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success" name="addroom">Thêm phòng</button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addroom'])) {
            $typeofroom = $_POST['troom'];
            $name = $_POST['name'];
            $typeofbed = $_POST['bed'];
            $status = $_POST['status'];
            $note = $_POST['note'];
            // TODO: Kiểm tra tên phòng
            $sql = "INSERT INTO room(type,name,no_bed,note,status) VALUES ('$typeofroom','$name','$typeofbed','$note','$status')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: room.php");
            }
        }
        ?>
    </div>

    <div class="room">
        <?php
        $sql = "select * from room";
        $re = mysqli_query($conn, $sql)
        ?>
        <?php
        while ($row = mysqli_fetch_array($re)) {
            $roomType = $row['type'];
            $beds = "Giường " . $row['no_bed'];
            if ($row['status'] == 1) {
                $nameColor = "text-success";
            } else {
                $nameColor = "text-danger";
            }
            $roombox = "<div class='text-center no-boder'>
                                <i class='fa-solid fa-bed fa-4x mb-2'></i>
                                <h3 class='fw-bolder " . $nameColor . "'>" . $row['name'] . "</h3>
                                <h3>" . $row['type'] . "</h3>
                                <div class='mb-1'>" . $beds . "</div>
                                <a href=''><button class='btn btn-primary'>Sửa</button></a>
                                <a href='roomdelete.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Xóa</button></a>
                            </div>";
            if ($roomType == "Superior Room") {
                echo "<div class='roombox roomboxsuperior'>" . $roombox . "</div>";
            } else if ($roomType == "Deluxe Room") {
                echo "<div class='roombox roomboxdelux'>" . $roombox . "</div>";
            } else if ($roomType == "Guest House") {
                echo "<div class='roombox roomboguest'>" . $roombox . "</div>";
            } else if ($roomType == "Single Room") {
                echo "<div class='roombox roomboxsingle'>" . $roombox . "</div>";
            }
        }
        ?>
    </div>

</body>

</html>