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
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/roombook.css">
    <title>Sparrow Hotel - Admin</title>
</head>

<body>
    <!-- guestdetailpanel -->

    <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform" style="height: 665px;">
            <div class="head">
                <h3>ĐẶT PHÒNG</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adduserclose()"></i>
            </div>
            <div class="middle" style="height: 550px;">
                <div class="reservationinfo">
                    <!-- <h4>Thông tin đặt phòng</h4> -->
                    <select name="User" class="selectinput" onchange="updatePhone()">
                        <option value selected>Người đặt phòng</option>
                        <?php
                        $usersql = "SELECT id, name, phone FROM user";
                        $userresult = mysqli_query($conn, $usersql);
                        if (mysqli_num_rows($userresult) > 0) {
                            while ($row = mysqli_fetch_assoc($userresult)) {
                                echo "<option value='" . $row["id"] . "' data-phone='" . $row["phone"] . "'>" . $row["name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="w-100 d-flex">
                        <div class="d-flex">
                            <div class="align-self-center">
                                SĐT liên hệ:
                            </div>
                        </div>
                        <input style="width:80%" type="text" name="Phone" id="phone-input">
                    </div>

                    <select name="RoomType" class="selectinput">
                        <option value selected>Loại phòng</option>
                        <option value="Superior Room">SUPERIOR ROOM</option>
                        <option value="Deluxe Room">DELUXE ROOM</option>
                        <option value="Guest House">GUEST HOUSE</option>
                        <option value="Single Room">SINGLE ROOM</option>
                    </select>
                    <select name="Bed" class="selectinput">
                        <option value selected>Số giường</option>
                        <option value="Đơn">Đơn</option>
                        <option value="Đôi">Đôi</option>
                        <option value="Ba">Ba</option>
                        <option value="Bốn">Bốn</option>
                        <!-- <option value="None">None</option> -->
                    </select>
                    <select name="NoofRoom" class="selectinput">
                        <option value selected>Số phòng</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <select name="Meal" class="selectinput">
                        <option value selected>Đặt bữa</option>
                        <option value="Room only">Room only</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Half Board">Half Board</option>
                        <option value="Full Board">Full Board</option>
                    </select>
                    <div class="datesection">
                        <span>
                            <label for="cin">Ngày đến</label>
                            <input name="cin" type="date">
                        </span>
                        <span>
                            <label for="cin">Ngày đi</label>
                            <input name="cout" type="date">
                        </span>
                    </div>
                    <input type="text" name="note" placeholder="Ghi chú">
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailsubmit">Hoàn thành</button>
            </div>
        </form>

        <?php
        // <!-- room availablity start-->

        $rsql = "select * from room";
        $rre = mysqli_query($conn, $rsql);
        $r = 0;
        $sc = 0;
        $gh = 0;
        $sr = 0;
        $dr = 0;

        while ($rrow = mysqli_fetch_array($rre)) {
            $r = $r + 1;
            $s = $rrow['type'];
            if ($s == "Superior Room") {
                $sc = $sc + 1;
            }
            if ($s == "Guest House") {
                $gh = $gh + 1;
            }
            if ($s == "Single Room") {
                $sr = $sr + 1;
            }
            if ($s == "Deluxe Room") {
                $dr = $dr + 1;
            }
        }

        $csql = "select * from payment";
        $cre = mysqli_query($conn, $csql);
        $cr = 0;
        $csc = 0;
        $cgh = 0;
        $csr = 0;
        $cdr = 0;
        while ($crow = mysqli_fetch_array($cre)) {
            $cr = $cr + 1;
            $cs = $crow['RoomType'];

            if ($cs == "Superior Room") {
                $csc = $csc + 1;
            }

            if ($cs == "Guest House") {
                $cgh = $cgh + 1;
            }
            if ($cs == "Single Room") {
                $csr = $csr + 1;
            }
            if ($cs == "Deluxe Room") {
                $cdr = $cdr + 1;
            }
        }
        // room availablity
        // Superior Room =>
        $f1 = $sc - $csc;
        if ($f1 <= 0) {
            $f1 = "NO";
        }
        // Guest House =>
        $f2 =  $gh - $cgh;
        if ($f2 <= 0) {
            $f2 = "NO";
        }
        // Single Room =>
        $f3 = $sr - $csr;
        if ($f3 <= 0) {
            $f3 = "NO";
        }
        // Deluxe Room =>
        $f4 = $dr - $cdr;
        if ($f4 <= 0) {
            $f4 = "NO";
        }
        //total available room =>
        $f5 = $r - $cr;
        if ($f5 <= 0) {
            $f5 = "NO";
        }
        ?>
        <!-- room availablity end-->

        <!-- ==== room book php ====-->
        <?php
        if (isset($_POST['guestdetailsubmit'])) {
            $userID = $_POST['User'];
            $Phone = $_POST['Phone'];
            $RoomType = $_POST['RoomType'];
            $NoofRoom = $_POST['NoofRoom'];
            $Bed = $_POST['Bed'];
            $Meal = $_POST['Meal'];
            $cin = $_POST['cin'];
            $cout = $_POST['cout'];
            $note = $_POST['note'];
            if ($Phone == "" || $NoofRoom == "" || $RoomType == "") {
                echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
            } else {
                $sta = "NotConfirm";
                $sql = "INSERT INTO reservation(user_id,phone,room_type,no_room,no_bed,check_in,check_out,no_day,meal,status,note) VALUES ('$userID','$Phone','$RoomType','$NoofRoom','$Bed','$cin','$cout',datediff('$cout','$cin'),'$Meal','$sta','$note')";
                $result = mysqli_query($conn, $sql);

                // if($f1=="NO")
                // {
                //     echo "<script>swal({
                //         title: 'Superior Room is not available',
                //         icon: 'error',
                //     });
                //     </script>";
                // }
                // else if($f2=="NO")
                // {
                //     echo "<script>swal({
                //         title: 'Guest House is not available',
                //         icon: 'error',
                //     });
                //     </script>";
                // }
                // else if($f3 == "NO")
                // {
                //     echo "<script>swal({
                //         title: 'Si Room is not available',
                //         icon: 'error',
                //     });
                //     </script>";
                // }
                // else if($f4 == "NO")
                // {
                //     echo "<script>swal({
                //         title: 'Deluxe Room is not available',
                //         icon: 'error',
                //     });
                //     </script>";
                // }
                // else if($result = mysqli_query($conn, $sql))
                // {
                if ($result) {
                    echo "<script>swal({
                                title: 'Reservation successful',
                                icon: 'success',
                            });
                        </script>";
                } else {
                    echo "<script>swal({
                                    title: 'Something went wrong',
                                    icon: 'error',
                                });
                        </script>";
                }
                // }
            }
        }
        ?>
    </div>


    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button id="adduser" class="adduser btn btn-success" onclick="adduseropen()">Đặt phòng</button>
        <!-- <button class="adduser" id="adduser" onclick="adduseropen()"> Add</button> -->
        <!-- <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form> -->
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
        $roombooktablesql = "SELECT reservation.*, user.name FROM reservation JOIN user ON reservation.user_id = user.id";
        $roombookresult = mysqli_query($conn, $roombooktablesql);
        $nums = mysqli_num_rows($roombookresult);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên</th>
                    <!-- <th scope="col">Email</th> -->
                    <!-- <th scope="col">Địa chỉ</th> -->
                    <th scope="col">SĐT</th>
                    <th scope="col">Loại phòng</th>
                    <th scope="col">Số phòng</th>
                    <th scope="col">Số giường</th>
                    <th scope="col">Đặt bữa</th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col" class="action">Hành động</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
                <?php
                while ($res = mysqli_fetch_array($roombookresult)) {
                ?>
                    <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['phone'] ?></td>
                        <td><?php echo $res['room_type'] ?></td>
                        <td><?php echo $res['no_room'] ?></td>
                        <td><?php echo $res['no_bed'] ?></td>
                        <td><?php echo $res['meal'] ?></td>
                        <td><?php echo $res['check_in'] ?></td>
                        <td><?php echo $res['check_out'] ?></td>
                        <td><?php echo $res['no_day'] ?></td>
                        <td><?php echo $res['status'] ?></td>
                        <td><?php echo $res['note'] ?></td>
                        <td class="action">
                            <?php
                            if ($res['status'] == "Confirm") {
                                echo " ";
                            } else {
                                echo "<a href='roomconfirm.php?id=" . $res['id'] . "'><button class='btn btn-success'>Confirm</button></a>";
                            }
                            ?>
                            <a href="roombookedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                            <a href="roombookdelete.php?id=<?php echo $res['id'] ?>"><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./javascript/roombook.js"></script>



</html>