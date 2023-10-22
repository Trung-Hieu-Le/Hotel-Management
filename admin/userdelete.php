<?php

include '../config.php';

$id = $_GET['id'];

$userdeletesql = "DELETE FROM user WHERE id = $id";

$result = mysqli_query($conn, $userdeletesql);

header("Location:user.php");

?>