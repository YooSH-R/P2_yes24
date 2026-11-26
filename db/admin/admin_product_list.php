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
  <main class="admin_product_list">
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

      <!-- 상품 리스트 -->
      <div>
        <h2>상품 목록</h2>
        <table class="table table-striped table-hover mt-4 product_list  text-center">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>카테고리</th>
              <th>상품명</th>
              <th>상품 가격</th>
              <th>저자</th>
              <th>책소개</th>
              <th>목차</th>
              <th>상품 이미지</th>
              <th>등록일</th>
              <th>버튼</th>
            </tr>
          </thead>
          <tbody>
            <?php
            
              $sql = "SELECT * FROM product24";
              $result = mysqli_query($conn, $sql);

              while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td class='limited'>".$row['prd_no']."</td>";
                echo "<td class='limited'>".$row['prd_category']."</td>";
                echo "<td class='limited'>".$row['prd_name']."</td>";
                echo "<td class='limited'>".$row['prd_price']."</td>";
                echo "<td class='limited'>".$row['prd_author']."</td>";
                echo "<td class='limited'>".$row['prd_description']."</td>";
                echo "<td class='limited'>".$row['book_index']."</td>";
                echo "<td><img src='./prd_images/".$row['prd_picture']."' alt='상품 이미지' style='width:100px;'></td>";
                echo "<td>".$row['prd_datetime']."</td>";
                echo "<td><a href='admin_product_update.php?no=".$row['prd_no']."' title='' class='btn btn-sm text-primary'>수정</a><a href='admin_product_del.php?no=".$row['prd_no']."' title='' class='btn btn-sm text-danger' onclick='return deleteConfirm(".$row['prd_no'].")'>삭제</a><button class='btn btn-sm btn-more'>전체보기</button>
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

<!-- 제이쿼리 -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function(){
    $('.btn-more').click(function(){
      const $row = $(this).closest('tr');
      const $cells = $row.find('td.limited'); // tr 안의 limited td들을 찾음

      if($cells.length){
        // 펼치기: limited 클래스 제거
        $cells.removeClass('limited');
        $(this).text('접기');
      } else {
        // 접기: 동일한 td들(여기서는 모든 td에 다시 limited을 붙임)
        // 원래 limited을 붙였던 셀들만 정확히 다시 붙이려면 서버에서 data attribute로 정보 주는 게 좋음.
        $row.find('td').addClass('limited');
        $(this).text('전체보기');
      }
    });
  });
  
  // 삭제하기 전 확인을 위한 함수
  function deleteConfirm(no){ // 선택한 함수 no값
    if(window.confirm('해당 상품을 삭제하시겠습니까?')){
      
    }else{
      return false;
    }
  }
</script>
</body>
</html>