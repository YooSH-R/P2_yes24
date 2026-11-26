<?php

  // cart_delete_checked.php

  include_once "../../db/dbconn/dbconn.php";

  // 선택된 상품 넘어왔나 확인
  if(!isset($_POST['ids'])){
    exit('잘못된 접근입니다.');
  }

  $mb_id = $_SESSION['mb_id'];

  $ids = $_POST['ids'];

  // 배열을 SQL IN 구문 형태로 변환
  $id_list = implode(',', array_map('intval',$ids));

  // id와 고유번호로 한해 삭제
  $sql = "DELETE FROM temp24 WHERE mb_id = '$mb_id' AND prd_no IN ($id_list)";
  mysqli_query($conn, $sql);

  mysqli_close($conn);

?>