  <?php include 'header.php' ?>

  <body>
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
          <div>
          <h2 class="welcometag">Chào mừng đến với Sparrow Hotel</h2>
          </div>
          <div class="welcometag2">
          <form action="reservation_modal_1.php" method="GET">
          <div class="row">
            <div class="col-3">
              <label for="cin" class="form-label">Ngày nhận phòng</label>
              <input name="cin" type="date" class="form-control" value="" required="">
            </div>
            <div class="col-3">
              <label for="cout" class="form-label">Ngày trả phòng</label>
              <input name="cout" type="date" class="form-control" value="" required="">
            </div>
            <div class="col-3">
              <label for="no_guess" class="form-label">Số hành khách:</label>
              <select name="no_guess" id="no_guess" class="form-select" required>
                    <option value="" disabled selected>Chọn số hành khách</option>
                    <?php for ($i = 1; $i <= 20; $i++) : ?>
                        <option value="<?php echo $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-3 position-relative">
              <div class="position-absolute bottom-0">
                <button type="submit" class="btn btn-primary" name="modal1">Tìm kiếm phòng</button>
              </div>
            </div>
          </div>
          </form>
          </div>
        </div>

      </div>

      </div>
    </section>

    <section id="secondsection">
      <!-- <img src="./image/homeanimatebg.svg"> -->
      <div class="ourroom">
        <h1 class="head">
          << Phòng>>
        </h1>
        <!-- TODO: Chi tiết -->
        <!-- <div class="roomselect">
          <div class="roombox">
            <div class="hotelphoto h1" style="background-image: url(./image/hotel1photo.webp);"></div>
            <div class="roomdata">
              <h2>Superior Room</h2>
              <div class="services">
                <i class="fa-solid fa-wifi"></i>
                <i class="fa-solid fa-burger"></i>
                <i class="fa-solid fa-spa"></i>
                <i class="fa-solid fa-dumbbell"></i>
                <i class="fa-solid fa-person-swimming"></i>
              </div>
              <button class="btn btn-primary bookbtn">Chi tiết</button>
            </div>
          </div>
          <div class="roombox">
            <div class="hotelphoto h2" style="background-image: url(./image/hotel2photo.jpg);"></div>
            <div class="roomdata">
              <h2>Delux Room</h2>
              <div class="services">
                <i class="fa-solid fa-wifi"></i>
                <i class="fa-solid fa-burger"></i>
                <i class="fa-solid fa-spa"></i>
                <i class="fa-solid fa-dumbbell"></i>
              </div>
              <button class="btn btn-primary bookbtn">Chi tiết</button>
            </div>
          </div>
          <div class="roombox">
            <div class="hotelphoto h3" style="background-image: url(./image/hotel3photo.avif);"></div>
            <div class="roomdata">
              <h2>Guest Room</h2>
              <div class="services">
                <i class="fa-solid fa-wifi"></i>
                <i class="fa-solid fa-burger"></i>
                <i class="fa-solid fa-spa"></i>
              </div>
              <button class="btn btn-primary bookbtn">Chi tiết</button>
            </div>
          </div>
          <div class="roombox">
            <div class="hotelphoto h4" style="background-image: url(./image/hotel4photo.jpg);"></div>
            <div class="roomdata">
              <h2>Single Room</h2>
              <div class="services">
                <i class="fa-solid fa-wifi"></i>
                <i class="fa-solid fa-burger"></i>
              </div>
              <button class="btn btn-primary bookbtn">Chi tiết</button>
            </div>
          </div>
        </div> -->
        <div class=" owl-carousel owl-theme p-3">
          <?php
          $sql = "SELECT * FROM room_type WHERE status = 1";
          $result = $conn->query($sql) or die($conn->error);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <div class="card">
                <img class="card-img" src="./image/room_type/<?php echo $row["image"]; ?>" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                  <h3 class="card-title"><?php echo $row['name']; ?></h3>
                  <a href="roomtype.php?id=<?php echo $row['id'] ?>" class="btn btn-primary card-btn">Chi tiết</a>
                </div>
              </div>

          <?php
            }
          }
          ?>
        </div>
        <div class="d-flex justify-content-center">
          <?php if ($userID == true) : ?>
            <a href="reservation_modal_1.php">
              <button class="btn btn-success">Đặt phòng</button>
            </a>
          <?php else : ?>
            <a href="index.php" onclick="return confirm('Vui lòng đăng nhập để có thể đặt phòng')"><button class='btn btn-success bookbtn'>Đặt phòng</button></a>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section id="thirdsection">
      <h1 class="head">
        << Dịch vụ>>
      </h1>
      <div class=" owl-carousel owl-theme p-3">
        <?php
        $sql = "SELECT * FROM service WHERE status = 1";
        $result = $conn->query($sql) or die($conn->error);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <div class="item bg-light" style="background-image: url(./image/service/<?php echo $row["image"]; ?>); height:320px;">
              <p class="bg-dark text-center text-light py-2"><?php echo $row['name']; ?></p>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </section>
    <section id="fourthsection">
      <h1 class="head">
        << Đánh giá của khách hàng>>
      </h1>
      <div class="owl-carousel owl-theme p-3">
        <?php
        $sql = "SELECT *, user.name FROM feedback JOIN user ON user.id=feedback.user_id WHERE status = 1";
        $result = $conn->query($sql) or die($conn->error);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <div class="item bg-light py-4 px-3">
              <div class="fs-3">
                <?php
                $rating = $row['rate'];
                for ($i = 0; $i < $rating; $i++) {
                  echo '<span class="text-warning">★</span>';
                }
                ?>
              </div>
              <p class="text-muted fst-italic mb-0">
                <?php $timestamp = strtotime($row['created_at']);
                echo date('H:i:s d/m/Y', $timestamp); ?></p>
              <p class="text-muted fst-italic mb-0"><?php echo $row['name']; ?></p>
              <h5>"<?php echo $row['content']; ?>"</h5>
            </div>
        <?php
          }
        }
        ?>
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
  <script src="./javascript/home.js"></script>

  </html>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: false,
      autoplay: true,
      autoplayTimeout: 3000,
      center: false, //Set true?
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 4
        }
      }
    })
  </script>