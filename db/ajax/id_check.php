<?php

  // db연결
  include_once '../dbconn/dbconn.php';

  // 입력된 id값 저장
  $mb_id = trim($_POST['mb_id']);

  // sql쿼리문 작성하여 mb_id조회
  $sql = "SELECT * FROM member24 WHERE mb_id = '$mb_id'";

  // 쿼리문 조회 결과를 변수에 저장
  $result = mysqli_query($conn, $sql);

  // id가 일치하는 자료 있을 시
  if(mysqli_num_rows($result)>0){
    echo 'fail';
  }else{
    echo 'ok';
  }

  // 쿼리문 종료
  mysqli_close($conn);


?>