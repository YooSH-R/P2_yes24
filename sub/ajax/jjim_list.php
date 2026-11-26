<?php

  // jjim_list.php

  // db연결
  include_once "../../db/dbconn/dbconn.php";

  $mb_id = $_SESSION['mb_id'];

  // 유효성 검사
  if(!isset($_POST['prd_no']) || !isset($mb_id)){
    echo "invalid";
    exit;
  }

  // 고유번호랑 찜버튼 체크유무 받아오기
  $prd_no = $_POST['prd_no'];
  $is_jjim = $_POST['is_jjim'];

  // 찜 목록 있는지 확인
  $check = "SELECT * FROM jjim WHERE mb_id = '$mb_id' AND prd_no = '$prd_no'";
  $check_result = mysqli_query($conn,$check);

  // 찜 목록 있으면
  if(mysqli_num_rows($check_result) > 0){
    // 찜버튼 체크유무 업데이트
    $sql = "UPDATE jjim SET is_jjim = $is_jjim WHERE prd_no = '$prd_no' AND mb_id ='$mb_id'";
    $result = mysqli_query($conn, $sql);
  }else{
    // 찜버튼 체크유무 추가
    $sql = "INSERT INTO jjim VALUES('$mb_id', '$prd_no', '$is_jjim')";
  }

  // 쿼리문 실행, 종료
  mysqli_query($conn, $sql);
  mysqli_close($conn);

?>