<?php

  // db연결위한 정보
  include('../dbconn/dbconn.php');

  // 입력한 id, pw, 이름 받아오기
  $mb_id = trim($_POST['mb_id']);
  $mb_password = trim($_POST['mb_password']);

  // db목록에서 입력한 아이디가 있는지 조회하는 쿼리문
  $sql = "SELECT * FROM member24 WHERE mb_id = '$mb_id'";

  // 변수에 담기
  $result = mysqli_query($conn, $sql);

  // 데이터를 연관배열로 담기
  $row = mysqli_fetch_assoc($result);

  if(!$row){ // 결과값 없는 경우
    echo "<script>alert('존재하지 않는 아이디입니다.'); history.back();</script>";
    exit;
  }
  
  // db에서 입력한 아이디의 id, pw가져오기
  $mb_dbid = $row['mb_id'];
  $mb_dbpassword = $row['mb_password'];
  $mb_name = $row['mb_name'];

  // 입력한 pw가 저장된 pw인지 체크 
  if(password_verify($mb_password, $mb_dbpassword)){
    // 패스워드가 일치하면(로그인 성공시)
    $_SESSION['mb_id'] = $mb_id; // 세션아이디 저장
    $_SESSION['mb_name'] = $mb_name; // 세션이름 저장
    
    // 만약 아이디가 관리자 아이디라면 관리자 페이지로 이동
    if(($mb_dbid==='admin')){
      echo "<script>location.replace('../admin/dashboard.php');</script>";
    }else{ // 일반 아이디라면 메인페이지로 이동
      echo "<script>location.replace('../../index.php');</script>";
    }
  }else{
    // 패스워드가 일치하지 않으면
    echo "<script>alert('비밀번호가 틀렸습니다.');history.back();</script>";
  }
  
  // 아이디 저장 체크박스가 체크되었는지 확인
  if(isset($_POST['save_id'])){
      // 7일 동안 쿠키 저장
      setcookie('saved_id', $mb_id, time() + 86400*7, "/");
  }else{
      // 체크하지 않았으면 쿠키 삭제
      if(isset($_COOKIE['saved_id'])){
          setcookie('saved_id', '', time() - 3600, "/");
      }
  }

?>