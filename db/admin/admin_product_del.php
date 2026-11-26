<?php

  include_once '../dbconn/dbconn.php';

  $prd_no = $_GET['no'];


  // sql쿼리문을 작성하여 no값에 해당하는 자료 삭제하기
  $sql = "DELETE FROM product24 WHERE prd_no = '$prd_no'";
  $result = mysqli_query($conn, $sql);

  if($result){ // 데이터가 성공적으로 삭제되면
    echo "<script>alert('데이터가 정상적으로 삭제되었습니다.');</script>";
    echo "<script>location.replace('admin_product_list.php')</script>;";
  }

  mysqli_close($conn);
  exit;

?>