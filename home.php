<?php

include 'config.php';
session_start();

// page redirect
$userID="";
$userID=$_SESSION['userID'];
if($userID == true){

}else{
  header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Sparrow Hotel</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <style>
      #guestdetailpanel #guestdetail{
        display: none;
      }
      #guestdetailpanel .middle{
        height: 540px;
      }
	  #guestdetail{
        display: none;
		height: 540px;
      }
	#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 1580px;
  height: 300px;
  padding: 12px;
	}
  #customers td, #customers th {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: center;
  background-color: #f2f2f2;
}



#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
 text-align: center;
  background-color: #007BFF;
  color: white;
}
table, th, td {
  border: 1px solid;
  padding: 12px;
}
.container {
    display: flex;
    justify-content: center; /* Căn giữa theo chiều ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
}
    </style>



</head>

<body>
  <nav class="header bg-white py-2" style="box-shadow: 0 10px 10px 0 rgba(200,200,200,0.3);">
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
      <p>SPARROW HOTEL</p>
    </div>
    <ul>
      <li><a href="#firstsection">Trang chủ</a></li>
      <li><a href="#secondsection">Phòng</a></li>
      <li><a href="#thirdsection">Trang thiết bị</a></li>
      <li><a href="#contactus">Liên hệ</a></li>
      <li><a href="./logout.php"><button class="btn btn-danger">Đăng xuất</button></a></li>
    </ul>
  </nav>

  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="carousel-image" src="./image/hotel1.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel2.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel3.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel4.jpg">
        </div>

        <div class="welcomeline">
          <h2 class="welcometag">Chào mừng đến với Sparrow Hotel</h2>
        </div>
<!--bookbox-->
     <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>ĐẶT PHÒNG</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
            </div>
            <div class="middle">
                <div class="reservationinfo">
                    <!-- <h4>Thông tin đặt phòng</h4> -->
			<div class="w-100 d-flex">
                      <div class="d-flex">
                        <div class="align-self-center">
                          SĐT liên hệ:&nbsp;
                        </div>
                      </div>
                      <input style="width:80%" type="text" name="Phone" value=" <?php echo $_SESSION['userPhone']; ?>">
                    </div>

                    <select name="RoomType" class="selectinput">
						<option value selected >Loại phòng</option>
                        <option value="Superior Room">SUPERIOR ROOM</option>
                        <option value="Deluxe Room">DELUXE ROOM</option>
						<option value="Guest House">GUEST HOUSE</option>
						<option value="Single Room">SINGLE ROOM</option>
                    </select>
                    <select name="Bed" class="selectinput">
						<option value selected >Số giường</option>
                        <option value="Đơn">Đơn</option>
                        <option value="Đôi">Đôi</option>
						            <option value="Ba">Ba</option>
                        <option value="Bốn">Bốn</option>
						          <!-- <option value="None">None</option> -->
                    </select>
                    <select name="NoofRoom" class="selectinput">
						<option value selected >Số phòng</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <select name="Meal" class="selectinput">
						<option value selected >Đặt bữa</option>
                        <option value="Room only">Room only</option>
                        <option value="Breakfast">Breakfast</option>
						<option value="Half Board">Half Board</option>
						<option value="Full Board">Full Board</option>
					</select>
                    <div class="datesection">
                        <span>
                            <label for="cin">Ngày đến</label>
                            <input name="cin" type ="date">
                        </span>
                        <span>
                            <label for="cin">Ngày đi</label>
                            <input name="cout" type ="date">
                        </span>
                    </div>
                    <input type="text" name="note" placeholder="Ghi chú">
                    <div style="margin-top: 10px;">
                      <span>Giá ước tính: </span><div id="price" style="display:inline-block;"></div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailsubmit">Hoàn thành</button>
            </div>
        </form>
		
		
        <!-- ==== room book php ====-->
        
        <?php       
            if (isset($_POST['guestdetailsubmit'])) {
                $Phone = $_POST['Phone'];
                $RoomType = $_POST['RoomType'];
                $NoofRoom = $_POST['NoofRoom'];
                $Bed = $_POST['Bed'];
                $Meal = $_POST['Meal'];
                $cin = $_POST['cin'];
                $cout = $_POST['cout'];
                $note = $_POST['note'];

                if($Phone == "" || $NoofRoom == "" || $RoomType == ""){
                    echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
                }
                else{
                    $sta = "NotConfirm";
                    $sql = "INSERT INTO reservation(user_id,phone,room_type,no_room,no_bed,check_in,check_out,no_day,meal,status,note) VALUES ('$userID','$Phone','$RoomType','$NoofRoom','$Bed','$cin','$cout',datediff('$cout','$cin'),'$Meal','$sta','$note')";
                    $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "<script>swal({
                                title: 'Đặt phòng thành công',
                                icon: 'success',
                            });
                        </script>";
                        } else {
                            echo "<script>swal({
                                    title: 'Xin vui lòng thử lại',
                                    icon: 'error',
                                });
                        </script>";
                        }
                }
            }
            ?>
          </div>

    </div>
  </section>
	<div class="container">
			<div class="check">
			
                    
						<span class="check-in-out-button">
                            <label for="cin">Nhận phòng</label>
                            
							<input name="cin" type ="date">
                        </span>
                        <span class="check-in-out-button">
                            <label for="cin"> Trả phòng</label>
							<input name="cout" type ="date">
                        </span>
		</div>
		<div class="check-in-out-button">
		<label >số phòng và số người</label>
		<select >
	
                        <option>1 phòng</option>
                        <option>2 phòng</option>
						<option>3 phòng</option>
						<option>4 phòng</option>
		
        </select>
		<select >
	
                        <option>1 người</option>
                        <option>2 người</option>
						<option>3 người</option>
						<option>4 người</option>
		
        </select>
		</div>
		<button class="btn btn-primary bookbtn">tìm</button>
	
	</div>
  <section id="secondsection"> 
    <!-- <img src="./image/homeanimatebg.svg"> -->
    <div class="ourroom">
      <h1 class="head"><< Phòng >></h1>
      <div class="roomselect">
        <div class="roombox">
          <div class="hotelphoto h1"></div>
          <div class="roomdata">
            <h2>Superior Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
              <i class="fa-solid fa-person-swimming"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openroombox()">Chi tiết</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h2"></div>
          <div class="roomdata">
            <h2>Delux Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openroombox()" >Chi tiết</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h3"></div>
          <div class="roomdata">
            <h2>Guest Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
            </div>
            <button class="btn btn-primary bookbtn"  onclick="openroombox()">Chi tiết</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h4"></div>
          <div class="roomdata">
            <h2>Single Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openroombox()">Chi tiết</button>
         
			</div>
        </div>
	</div>
	 
		<div class="d-flex justify-content-center">
    <button class="btn btn-primary bookbtn" onclick="openbookbox()">Đặt phòng</button>
	</div>
	<!--roombox-->
<div id="guestdetail" >
        <form action="" method="POST" class="guestdetailform">
            <div class="head" >
                <h3>chi tiết</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closebox1()"></i>
            </div>

            <table id="customers" border=1 align="center" >
				<tr>
					<th>room type</th>
					<th>room description</th>
					<th>room price</th>
				</tr>
				<?php
                        $sql ="SELECT * FROM room_type";
                        $result = $conn->query($sql) or die("Can't get recordset");
                        if($result->num_rows>=0){
                            while($row = $result->fetch_assoc()){
                                ?>
				<tr>
					<td><?php echo $row["name"];?></td>
                    <td><?php echo $row["description"];?></td>
                    <td><?php echo $row["price"];?> $</td>
				</tr>
				 <?php 
				   }
                        } else {
                            echo "<tr><td colspan=7>Tap ket qua rong</td></tr>";
                        }
                        $conn->close();
                   
                    ?>
			</table>
         
           
        </form>  
	</div>

	
  </section>

  <section id="thirdsection">
    <h1 class="head"><< Trang thiết bị >></h1>
    <div class="facility">
      <div class="box">
        <h2>Swiming pool</h2>
      </div>
      <div class="box">
        <h2>Spa</h2>
      </div>
      <div class="box">
        <h2>24*7 Restaurants</h2>
      </div>
      <div class="box">
        <h2>24*7 Gym</h2>
      </div>
      <div class="box">
        <h2>Heli service</h2>
      </div>
    </div>
  </section>

  <section id="contactus">
    <div class="social">
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-solid fa-envelope"></i>
    </div>
  </section>
</body>

<script>
var bookbox = document.getElementById("guestdetailpanel");

    openbookbox = () =>{
      bookbox.style.display = "flex";
    }
    closebox = () =>{
      bookbox.style.display = "none";
    }
var roombox = document.getElementById("guestdetail");

    openroombox = () =>{
      roombox.style.display = "flex";
    }
    closebox1 = () =>{
      roombox.style.display = "none";
    }


var price = 0;
function calculatePrice() {
  var meal = document.getElementsByName("Meal")[0].value;

  //Sử dụng câu lệnh switch để tính giá tiền tương ứng với từng loại đặt bữa
  switch (meal) {
    case "Room only":
      price = 0;
      break;
    case "Breakfast":
      price = 50;
      break;
    case "Half Board":
      price = 150;
      break;
    case "Full Board":
      price = 70;
      break;
    default:
      price = 0;
      break;
  }

  //Hiển thị giá tiền tính được
  document.getElementById("price").innerHTML = "$" + price.toFixed(2);
}

//thêm sự kiện onchange vào select "Meal"
document.getElementsByName("Meal")[0].onchange = calculatePrice;

</script>
</html>
