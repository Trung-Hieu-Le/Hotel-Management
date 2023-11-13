<?php
session_start();
include '../config.php';
?>
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
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    // TODO: Tránh trùng service
    $sql = "INSERT INTO service(name,price,description,status) VALUES ('$name', '$price','$description','$status')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: service.php");
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
    <style>
        .roombox {
            background-color: #d1d7ff;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <div class="h-100 py-2">
                <div class="row h-100">
                    <div class="col-4">
                        <label for="name">Tên dịch vụ :</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="price">Giá :</label>
                        <input type="text" name="price" class="form-control" pattern="{0,9}+">
                    </div>
                    <div class="col-4">
                        <label for="description">Mô tả :</label>
                        <input type="text" name="description" class="form-control">
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

                    <div class="col-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success" name="addservice">Thêm dịch vụ</button>
                    </div>
                </div>
            </div>
        </form>


    </div>


    <div class="room">
        <?php
        $sql = "select * from service";
        $re = mysqli_query($conn, $sql)
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên</th>
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
                        <td><?php echo $res['price'] ?></td>
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

</body>

</html>