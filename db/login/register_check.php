<?php

  // db연결
  include('../dbconn/dbconn.php');

  // 데이터값을 받아 변수에 저장
  $mb_id = trim($_POST['mb_id']);
  $mb_password = trim($_POST['mb_password']);
  $mb_name = trim($_POST['mb_name']);
  $mb_phone = trim($_POST['mb_phone']);
  $mb_email = trim($_POST['mb_email']);
  
  // 비밀번호 암호화
  $mb_password = password_hash($mb_password, PASSWORD_DEFAULT);


  // 쿼리문 변수
  $sql = "insert into member24(mb_id, mb_password, mb_name, mb_phone, mb_email) values ('$mb_id', '$mb_password', '$mb_name','$mb_phone', '$mb_email')";

  // 쿼리문 실행
  $result = mysqli_query($conn, $sql);

  if($result){ // 이상없을시
    echo "<script>alert('회원가입이 완료되었습니다.');</script>";
    echo "<script>location.replace('login.php');</script>";
    mysqli_close($conn);
    exit;
  }else{ // 이상발생시
    echo "오류가 발생하였습니다.".mysqli_error($conn);
    mysqli_close($conn);
  }

?>