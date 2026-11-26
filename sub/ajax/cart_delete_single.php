<?php

  // cart_delete_single.php

  include_once "../../db/dbconn/dbconn.php";

  if(!isset($_POST['cart_id']) || !isset($_SESSION['mb_id'])){
    exit("잘못된 접근입니다.");
  }

  $mb_id = $_SESSION['mb_id'];
  $cart_id = intval($_POST['cart_id']);

  $sql = "DELETE FROM temp24 WHERE prd_no = '$cart_id' AND mb_id = '$mb_id'";
  mysqli_query($conn, $sql);

  mysqli_close($conn);


?>