<?php

  //cart_update.php 

  include_once '../../db/dbconn/dbconn.php';

  if(!isset($_POST['cart_id']) || !isset($_POST['count'])){
    exit('잘못된 접근입니다.');
  }

  $cart_id = intval($_POST['cart_id']); // 장바구니 상품의 고유 no
  $count = intval($_POST['count']); // 수량

  if($count < 1){ $count = 1;}

  // 상품 가격 가져오기
  $sql = "SELECT prd_price FROM temp24 WHERE prd_no = '$cart_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $unit_price = $row['prd_price'];
  $money = $unit_price * $count;

  // 수량, 가격 수정하기
  $sql2 = "
    UPDATE temp24
    SET count = '$count', money = '$money'
    WHERE prd_no = '$cart_id'
  ";
  mysqli_query($conn, $sql2);

  echo json_encode([
    'result' => 'success',
    'money' => $money
  ]);

?>