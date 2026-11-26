<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');

  // 세션정보 받아와서 상품명 받아오기
  $prd_name = $_SESSION['prd_name'];

?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>상품목록 수정</title>
  <!-- 부트스트랩 서식 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- 폰트어썸 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <!-- 초기화 -->
  <link rel="stylesheet" href="../../css/reset.css">
  <!-- 레이아웃 -->
  <link rel="stylesheet" href="../../css/admin_layout.css">

</head>
<body>
  <!-- 헤더 연결 -->
  <?php include('./php/header_2.php');
  
  // 해당상품 정보 받아오기
  $no = $_GET['no'];
  
  // DB에서 상품 행 찾기
  $sql = "SELECT * FROM product24 where prd_no = $no";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

  ?>

  <!-- 메인영역 -->
  <main class="admin_product_add">
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
      <form name="product_add" method="post" action="admin_product_add_check.php" enctype="multipart/form-data" onsubmit="return form_check();">

        <!-- 수정 모드인거 알려주기 -->
        <input type="hidden" name="mode" value="update">

        <h2 class="text-center mb-4">상품목록 수정</h2>
        <div>
          <label for="prd_category" class="form-label">*카테고리</label>
          <select name="prd_category" id="prd_category" class="form-select">
            <option value="">----------</option>
            <option value="BEST"
            <?= ($row['prd_category'] == 'BEST') ? 'selected' : '' ?>>
            BEST
            </option>
            <option value="만화"
            <?= ($row['prd_category'] == '만화') ? 'selected' : '' ?>>
            만화
            </option>
            <option value="소설"
            <?= ($row['prd_category'] == '소설') ? 'selected' : '' ?>>
            소설
            </option>
          </select>
        </div>
        
        <div>
          <label for="prd_name" class="form-label mt-4">*상품명</label>
          <input type="text" name="prd_name" id="prd_name" class="form-control" value="<?php echo $row['prd_name']?>" readonly>
        </div>

        <div>
          <label for="prd_price" class="form-label mt-4">*상품가격</label>
          <input type="text" name="prd_price" id="prd_price" class="form-control" placeholder="(숫자만 입력)" value="<?php echo $row['prd_price']?>">
        </div>

        <div>
          
          <label for="prd_picture" class="form-label mt-4">*상품사진</label>
          <input type="file" name="prd_picture" id="prd_picture" class="form-control form-control-lg" >
          <input type="hidden" name="prd_picture1" id="prd_picture1" value="<?= $row['prd_picture']?>">
          </div>

        <div>
          <label for="prd_author" class="form-label mt-4">*저자</label>
          <input type="text" name="prd_author" id="prd_author" class="form-control" value="<?php echo $row['prd_author']?>">
        </div>

        <div>
          <label for="prd_description" class="form-label mt-4">*책소개</label>
          <textarea name="prd_description" id="prd_description" rows="6" class="form-control"><?php echo $row['prd_description']?></textarea>
        </div>

        <div>
          <label for="author_description" class="form-label mt-4">*저자소개</label>
          <textarea name="author_description" id="author_description" rows="6" class="form-control"><?php echo $row['author_description']?></textarea>
        </div>

        <div>
          <label for="book_index" class="form-label mt-4">*목차</label>
          <textarea name="book_index" id="book_index" rows="6" class="form-control"><?php echo $row['book_index']?></textarea>
        </div>

        <div>
          <input type="submit" name="action" class="btn btn-primary w-100 mt-4" value="제출하기">
        </div>
      </form>
    </div>
  </main>

<!-- 푸터 연결 -->
<?php include('./php/footer.php')?>

  <script>
    // 유효성 검사
    function form_check(){
      if(document.getElementById('prd_category').value==''){
        alert('카테고리를 선택하십시오.');
        document.getElementById('prd_category').focus();
        return false;
      }

      if(document.getElementById('prd_name').value==''){
        alert('상품명을 입력하십시오.');
        document.getElementById('prd_name').focus();
        return false;
      }

      if(document.getElementById('prd_price').value==''){
        alert('상품가격을 입력하십시오.');
        document.getElementById('prd_price').focus();
        return false;
      }

        if(document.getElementById('prd_picture').value=='' && document.getElementById('prd_picture1').value==''){
          alert('상품사진을 첨부하십시오.');
          document.getElementById('prd_picture').focus();
          return false;
        }

      if(document.getElementById('prd_author').value==''){
        alert('저자를 입력하십시오.');
        document.getElementById('prd_author').focus();
        return false;
      }

      if(document.getElementById('prd_description').value==''){
        alert('책소개를 입력하십시오.');
        document.getElementById('prd_description').focus();
        return false;
      }

      if(document.getElementById('author_description').value==''){
        alert('저자소개를 입력하십시오.');
        document.getElementById('author_description').focus();
        return false;
      }

      if(document.getElementById('book_index').value==''){
        alert('목차를 입력하십시오.');
        document.getElementById('book_index').focus();
        return false;
      }
    }
  </script>
</body>
</html>