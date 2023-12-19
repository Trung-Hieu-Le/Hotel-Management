<?php

include 'config.php';
session_start();

// page redirect
$userID = "";
if (isset($_SESSION['userID'])) {
  $userID = $_SESSION['userID'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/home.css">
  <title>Khách sạn Xanh</title>
  <!-- boot -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- fontowesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./admin/css/roombook.css">
  <style>
    #guestdetailpanel {
      display: none;
    }

    #guestdetailpanel .middle {
      height: 540px;
    }
  </style>
</head>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo2.png" alt="logo">
      <p>KHÁCH SẠN XANH</p>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav mr-auto float-end mb-2">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Trang chủ</a>
        </li>
        <?php if ($userID == true) : ?>
          <li class="nav-item">
            <a class="nav-link" href="reservation_modal_1.php">Đặt phòng</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="./index.php" onclick="return confirm('Vui lòng đăng nhập để có thể đặt phòng')">Đặt phòng</a>
          </li>
        <?php endif; ?>
        
        <!-- <li class="nav-item">
          <a class="nav-link" href="#secondsection">Phòng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#thirdsection">Trang thiết bị</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#fourthsection">Đánh giá</a>
        </li> -->
        <?php if ($userID == true) : ?>
          <li class="dropdown">
            <a class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tài khoản
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile.php">Xem hồ sơ cá nhân</a>
              <a class="dropdown-item" href="reservation_history.php">Xem lịch sử đặt phòng</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="./logout.php">Đăng xuất</a>
            </div>
          </li>
        <?php else : ?>
          <li><a href="./index.php"><button class="btn btn-primary">Đăng nhập</button></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>

