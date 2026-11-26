<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');

?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>대시보드</title>
  <!-- 파비콘 -->
  <link rel="icon" href="../../images/favi/favicon.ico" type="image/x-icon">
  <!-- 부트스트랩 서식 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- 폰트어썸 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <!-- 초기화 -->
  <link rel="stylesheet" href="../../css/reset.css">
  <!-- 관리자 레이아웃 -->
  <link rel="stylesheet" href="../../css/admin_layout.css">

</head>
<body>
  <!-- 헤더 연결 -->
  <?php include('./php/header_2.php')?>

  <!-- 메인 영역 -->
  <main class="admin_dashboard">
    <!-- 아우터 -->
    <div class="admin_outer">
      <!-- 좌측 내비게이션 -->
      <nav class="p-4 admin_nav">
        <h2 class="mb-5"><strong>대시보드</strong></h2>
        <ul>
          <li class="mb-4"><a href="./admin_product_add.php" title="상품 등록 / 수정">상품 등록</a></li>
          <li class="mb-4"><a href="./admin_product_list.php#" title="상품 목록">상품 목록 보기/수정</a></li>
          <li class="mb-4"><a href="./admin_product_list.php#" title="상품 목록">상품 목록</a></li>
          <li class="mb-4"><a href="#" title="주문 / 배송">주문 / 배송</a></li>
          <li class="mb-4"><a href="#" title="취소 / 반품 / 교환 / 환불">취소 / 반품 / 교환 / 환불</a></li>
          <li class="mb-4"><a href="#" title="공지사항">공지사항</a></li>
          <li class="mb-4"><a href="./admin_user_list.php" title="고객정">고객정보</a></li>
          <li class="mb-4"><a href="#" title="정산 / 결제 / PG">정산 / 결제 / PG</a></li>
          <li class="mb-4"><a href="#" title="설정 / 권한 / 감사로그">설정 / 권한 / 감사로그</a></li>
        </ul>
      </nav>

      <section>
        <h3 style="display:none;">바로가기 모음</h3>
        <article>
          <a href="./admin_product_add.php" title="상품 등록 / 수정"><h2>상품 등록 바로가기<i class="fa-solid fa-angle-right ms-1"></i></h2></a>
        </article>
        <article>
          <a href="./admin_product_list.php" title="상품 목록"><h2>상품 목록 바로가기<i class="fa-solid fa-angle-right ms-1"></i></h2></a>
        </article>
        <article>
          <a href="#" title="공지사항"><h2>공지사항 바로가기<i class="fa-solid fa-angle-right ms-1"></i></h2></a>
        </article>
        <article>
          <a href="./admin_user_list.php" title="고객 정보"><h2>고객 정보 바로가기<i class="fa-solid fa-angle-right ms-1"></i></h2></a>
        </article>
      </section>

    </div>
  </main>

<!-- 푸터 연결 -->
<?php include('./php/footer.php')?>

<script>
  // 삭제하기 전 확인을 위한 함수
  function deleteConfirm(no){ // 선택한 함수 no값
    if(window.confirm('해당 상품을 삭제하시겠습니까?')){
      location.replace('admin_product_del.php')
    }else{
      return false;
    }
  }
</script>
</body>
</html>