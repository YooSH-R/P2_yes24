<?php

  // cart_total.php

  // db연결
  include('../../db/dbconn/dbconn.php');

  $userid = $_SESSION['mb_id'];

  $sql_total = "SELECT COUNT(*) AS total FROM temp24 WHERE mb_id = '$userid'";
  $result_total = mysqli_query($conn, $sql_total);
  $row_total = mysqli_fetch_assoc($result_total);

  $cart_total = (int)$row_total['total'];

  echo $cart_total;

?>