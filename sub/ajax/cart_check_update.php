<?php

  // cart_check_update.php

  // db연결
  include_once "../../db/dbconn/dbconn.php";

  if(!isset($_POST['cart_id']) || !isset($_SESSION['mb_id'])){
    exit("잘못된 접근입니다.");
  }

  // 장바구니에서 넘어온 고유번호와 체크유무
  $cart_id = $_POST['cart_id'];
  $checked = $_POST['checked'];

  // 체크유무 업데이트
  $sql = "UPDATE temp24 SET checked = $checked WHERE prd_no = '$cart_id'";

  // 쿼리문 실행, 종료
  mysqli_query($conn, $sql);
  mysqli_close($conn);

?>