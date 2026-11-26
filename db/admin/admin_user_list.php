<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');

?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>상품목록</title>
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

  <!-- 메인영역 -->
  <main class="admin_user_list">
    <!-- 아우터 -->
    <div class="admin_outer">
      <!-- 좌측 내비게이션 -->
      <nav class="p-4 admin_nav">
        <h2 class="mb-5"><strong>대시보드</strong></h2>
        <ul>
          <li class="mb-4"><a href="./admin_product_add.php" title="상품 등록 / 수정">상품 등록</a></li>
          <li class="mb-4"><a href="./admin_product_list.php#" title="상품 목록">상품 목록 보기/수정</a></li>
          <li class="mb-4"><a href="#" title="주문 / 배송">주문 / 배송</a></li>
          <li class="mb-4"><a href="#" title="취소 / 반품 / 교환 / 환불">취소 / 반품 / 교환 / 환불</a></li>
          <li class="mb-4"><a href="#" title="공지사항">공지사항</a></li>
          <li class="mb-4"><a href="./admin_user_list.php" title="고객정">고객정보</a></li>
          <li class="mb-4"><a href="#" title="정산 / 결제 / PG">정산 / 결제 / PG</a></li>
          <li class="mb-4"><a href="#" title="설정 / 권한 / 감사로그">설정 / 권한 / 감사로그</a></li>
        </ul>
      </nav>

      <!-- 회원 목록 -->
      <div>
        <h2>회원 목록</h2>
        <table class="table table-striped table-hover mt-4 product_list  text-center">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>아이디</th>
              <th>비밀번호</th>
              <th>이름</th>
              <th>휴대폰 번호</th>
              <th>이메일</th>
              <th>주소</th>
              <th>등록일</th>
              <th>버튼</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
              $sql = "SELECT * FROM member24";
              $result = mysqli_query($conn, $sql);

              while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['mb_no']."</td>";
                echo "<td>".$row['mb_id']."</td>";
                echo "<td class='limited'>".$row['mb_password']."</td>";
                echo "<td>".$row['mb_name']."</td>";
                echo "<td>".$row['mb_phone']."</td>";
                echo "<td>".$row['mb_email']."</td>";
                echo "<td>".$row['ma_address']."</td>";
                echo "<td>".$row['mb_datetime']."</td>";
                echo "<td><a href='#' title='' class='btn btn-sm text-primary'>수정</a><a href='#' title='' class='btn btn-sm text-danger'>삭제</a>
                </td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </main>

<!-- 푸터 연결 -->
<?php include('./php/footer.php')?>

<script>
</script>
</body>
</html>