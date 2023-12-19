<?php include('header.php')?>

<?php
    // session_start();
    // include '../config.php';

    // roombook
    $roombooksql ="Select * from room join chosen_room on chosen_room.room_id=room.id
                                      join reservation on chosen_room.reservation_id=reservation.id
                                      where reservation.status=0";
    $roombookre = mysqli_query($conn, $roombooksql);
    $roombookrow = mysqli_num_rows($roombookre);

    // reservation
    $reservationsql ="Select * from reservation";
    $reservationre = mysqli_query($conn, $reservationsql);
    $reservationrow = mysqli_num_rows($reservationre);

    // room
    $roomsql ="Select * from room where status <> 0";
    $roomre = mysqli_query($conn, $roomsql);
    $roomrow = mysqli_num_rows($roomre);

    // TODO: sửa các select - status, searchfun, chart,

?>
<!-- moriss profit -->
<?php 	
					$query = "SELECT payment.* FROM payment ORDER BY created_at";
					$result = mysqli_query($conn, $query);
					$chart_data = '';
					$tot = 0;
					while($row = mysqli_fetch_array($result))
					{
              $chart_data .= "{ date:'".date('d-m-Y', strtotime($row["created_at"]))."', profit:".$row["final_total"] ."}, ";
              $tot = $tot + $row["final_total"];
					}
					$chart_data = substr($chart_data, 0, -2);


          $query = "SELECT status, COUNT(*) as total FROM reservation GROUP BY status";
          $result = mysqli_query($conn, $query);
          
          $statusData = [];
          while ($row = mysqli_fetch_assoc($result)) {
              switch ($row['status']) {
                  case 0:
                      $statusData['Chưa thanh toán'] = $row['total'];
                      break;
                  case 1:
                      $statusData['Đã thanh toán'] = $row['total'];
                      break;
                  case 2:
                      $statusData['Hủy đặt phòng'] = $row['total'];
                      break;
                  default:
                      break;
              }
          }
          
?>

  <?php include('sidebar.php')?>
  <div class="main-content">
   <div class="databox">
        <div class="box roombookbox">
          <h3>Tổng số phòng được đặt</h3> 
          <h1><?php echo $roombookrow ?> / <?php echo $roomrow ?></h1>
        </div>
        <div class="box guestbox">
        <h3>Tổng số đơn đặt phòng</h3>  
          <h1><?php echo $reservationrow ?></h1>
        </div>
        <div class="box profitbox">
        <h3>Doanh thu</h3>  
          <h1><?php echo number_format("$tot")?> VNĐ</h1>
        </div>
    </div>
    <div class="chartbox">
      <div class="profitchart" >
        <div id="profitchart"></div>
        <h3 style="text-align: center;margin:10px 0;">Doanh thu</h3>
      </div>
      <div class="bookroomchart">
          <canvas id="bookroomchart"></canvas>
          <h3 style="text-align: center;margin:10px 0;">Tỉ lệ đặt phòng</h3>
      </div>
    </div>
  </div>
</body>



<script>
    const labels = Object.keys(<?php echo json_encode($statusData); ?>);

const data = {
    labels: labels,
    datasets: [{
        label: 'Số đơn đặt phòng',
        backgroundColor: [
            'rgba(51, 153, 225, 1)',
            'rgba(51, 255, 51, 1)',
            'rgba(255, 51, 51, 1)',
        ],
        borderColor: 'black',
        data: Object.values(<?php echo json_encode($statusData); ?>), 
    }]
};

const doughnutChart = {
    type: 'doughnut',
    data: data,
    options: {} 
};

const myChart = new Chart(
    document.getElementById('bookroomchart'),
    doughnutChart
);

</script>


<script>
Morris.Bar({
 element : 'profitchart',
 data:[<?php echo $chart_data;?>],
 xkey:'date',
 ykeys:['profit'],
 labels:['Profit'],
 hideHover:'auto',
 stacked:true,
 barColors:[
  'rgba(153, 102, 255, 1)',
 ]
});
</script>

</html>