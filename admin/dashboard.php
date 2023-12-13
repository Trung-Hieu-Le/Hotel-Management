<?php
    session_start();
    include '../config.php';

    // roombook
    $roombooksql ="Select * from room join chosen_room on chosen_room.room_id=room.id
                                      join reservation on chosen_room.reservation_id=reservation.id
                                      where reservation.status=0";
    $roombookre = mysqli_query($conn, $roombooksql);
    $roombookrow = mysqli_num_rows($roombookre);

    // staff
    $staffsql ="Select * from staff";
    $staffre = mysqli_query($conn, $staffsql);
    $staffrow = mysqli_num_rows($staffre);

    // room
    $roomsql ="Select * from room";
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
				
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- morish bar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <title>Sparrow Hotel - Admin</title>
</head>
<body>
   <div class="databox">
        <div class="box roombookbox">
          <h2>Tổng số phòng được đặt</h1>  
          <h1><?php echo $roombookrow ?> / <?php echo $roomrow ?></h1>
        </div>
        <div class="box guestbox">
        <h2>Tổng số nhân viên</h1>  
          <h1><?php echo $staffrow ?></h1>
        </div>
        <div class="box profitbox">
        <h2>Doanh thu</h1>  
          <h1>$<?php echo $tot?></h1>
        </div>
    </div>
    <div class="chartbox">
        <!-- <div class="bookroomchart">
            <canvas id="bookroomchart"></canvas>
            <h3 style="text-align: center;margin:10px 0;">Các phòng được đặt</h3>
        </div> -->
        <div class="profitchart" >
            <div id="profitchart"></div>
            <h3 style="text-align: center;margin:10px 0;">Doanh thu</h3>
        </div>
    </div>
</body>



<!-- <script>
        const labels = [
          'Superior Room',
          'Deluxe Room',
          'Guest House',
          'Single Room',
        ];
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'My First dataset',
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderColor: 'black',
            data: [<?php echo $chartroom1row ?>,<?php echo $chartroom2row ?>,<?php echo $chartroom3row ?>,<?php echo $chartroom4row ?>],
          }]
        };
  
        const doughnutchart = {
          type: 'doughnut',
          data: data,
          options: {}
        };
        
      const myChart = new Chart(
      document.getElementById('bookroomchart'),
      doughnutchart);
</script> -->

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