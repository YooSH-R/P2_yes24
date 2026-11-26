<?php

  include_once('../dbconn/dbconn.php');

  if($_SESSION['mb_id'] == 'admin'){ // 관리자 아이디로 로그인 되어있을 시
    $mb_name = $_SESSION['mb_name'] . '님 안녕하세요';
  }else{ // 관리자가 아니라면 메인페이지로 돌려보내기
    echo "<script>alert('관리자만 이용 가능한 페이지입니다.'); location.href='../../index.php'</script>";
    exit;
  }

?>
<!-- css 연결 -->
<link rel="stylesheet" href="../../css/layout.css">
<link rel="stylesheet" href="../../css/common.css">
<link rel="stylesheet" href="../../css/reset.css">

<header>
  <!-- 헤더 위쪽 아우터 -->
  <div class="header_outer_top">
    <!-- 헤더 위쪽 이너 -->
    <div class="header_inner_top">
      <!-- 상단로고 -->
      <h1 class="h_logo">
        <a href="dashboard.php" title="대시보드로 바로가기">
          <img src="../../images/logo/logo.png" alt="상단로고">
        </a>
      </h1>
      
      <!-- 상단 우측 내비게이션 (고객지원, 장바구니, 로그인) -->
      <ul class="h_right_nav">
        <!-- 고객지원 -->
        <li>
        </li>
        <!-- 메인페이지 -->
        <li class="w-100">
          <a href="../../index.php" title='로그인'>
            <i class="fa-solid fa-house"></i>
            <p>메인페이지</p>
          </a>
        </li>
        <!-- 로그인 -->
        <li class="w-100">
          <a href="../login/logout.php" title='로그인'>
            <i class="fa-solid fa-user"></i>
            <p>로그아웃</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>