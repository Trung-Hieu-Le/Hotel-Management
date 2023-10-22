<?php

include '../config.php';

$id = $_GET['id'];

$roomdeletesql = "DELETE FROM reservation WHERE id = $id";

$result = mysqli_query($conn, $roomdeletesql);

header("Location:room.php");

?>