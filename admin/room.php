<?php
session_start();
include '../config.php';
?>
<?php
                // Xử lý xóa phòng
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $roomdeletesql = "DELETE FROM room WHERE id = $id";
                    $result = mysqli_query($conn, $roomdeletesql);
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
            // TODO: Kiểm tra tên phòng
            $sql = "INSERT INTO room(type_id,name,no_bed,note,status) VALUES ('$typeofroom','$name','$typeofbed','$note','$status')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: room.php");
            }
        }
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
                        <?php
                        $roomtypesql = "SELECT id, name FROM room_type";
                        $roomtyperesult = mysqli_query($conn, $roomtypesql);
                        if (mysqli_num_rows($roomtyperesult) > 0) {
                            while ($row = mysqli_fetch_assoc($roomtyperesult)) {
                                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                            }
                        }
                        ?>
                        </select>                        
                    </div>
                    <div class="col-4">
                        <label for="bed">Số giường:</label>
                        <select name="bed" class="form-control">
                            <option value selected></option>
                            <option value="1">Đơn</option>
                            <option value="2">Đôi</option>
                            <option value="3">Ba</option>
                            <option value="4">Bốn</option>
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
    </div>

    <div class="room">
        <?php
        $sql = "select room.*, room_type.name as roomtype from room JOIN room_type ON room.type_id = room_type.id ORDER BY id";
        $re = mysqli_query($conn, $sql)
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên phòng</th>
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
                    <tr style="height:80px;">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['roomtype'] ?></td>
                        <td><?php echo $res['no_bed'] ?></td>
                        <td><?php echo $res['status'] == 0 ? 'Không hoạt động' : 'Hoạt động'; ?></td> 
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

</body>

</html>