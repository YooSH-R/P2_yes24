<?php
  // 세션정보 확인
  include('../db/dbconn/dbconn.php');
  
  // 카트 개수 변수
  $cart_total = 0;

  // 세션 아이디가 있을경우
  if(isset($_SESSION['mb_id'])){    //세션 아이디가 있으면
    $userid = $_SESSION['mb_id'];   // 변수에 세션 id저장
    $name = $_SESSION['mb_name'];   // 변수에 세션 name을 저장
    $log_nav = '로그아웃'; 
    $log_href = 'logout.php';
    $log_icon = "fa-solid fa-arrow-right-from-bracket";
    $sql_id = "SELECT COUNT(*) AS total FROM temp24 WHERE mb_id = '$userid'";
    $result_id = mysqli_query($conn, $sql_id);
    if ($row_id = mysqli_fetch_assoc($result_id)) {
        $cart_total = (int)$row_id['total'];
    }
  }else{
    $userid = '';                   // id 없음
    $name = '';                     // 닉네임 없음
    $log_nav = '로그인';
    $log_href = 'login.php';
    $log_icon = "fa-solid fa-user";
  }

  // 제목 변수 값이 없으면 기본값은 메인페이지
  $yes24_title = $_GET['title'] ?? '메인페이지';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 메타 태그 -->
  <meta name="description" content="YES24">
  <meta name="keywords" content="책, 온라인서점, 문화공간">
  <meta name="author" content="Upgrade³">
  <meta name="og:title" content="<?= $yes24_title ?>">
  <!-- 제목 -->
  <title>2차 프로젝트 YES24리뉴얼 - <?= $yes24_title; ?></title>
  <!-- 파비콘 -->
  <link rel="icon" href="../images/favi/favicon.ico" type="image/x-icon">
  <!-- 폰트 어썸 서식 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
  <!-- 슬라이드 서식 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <!-- 초기화 -->
  <link href="../css/reset.css" rel="stylesheet" type="text/css">
  <!-- 공통서식 -->
  <link href="../css/common.css" rel="stylesheet" type="text/css">
  <!-- 레이아웃 서식 -->
  <link href="../css/layout.css" rel="stylesheet" type="text/css">