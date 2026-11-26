<?php
  include_once '../db/dbconn/dbconn.php';
  
  // 카트 개수 변수
  $cart_total = 0;

  if(isset($_SESSION['mb_id'])){    //세션 아이디가 있으면
    $mb_id = $_SESSION['mb_id'];   // 변수에 세션 id저장
    $name = $_SESSION['mb_name'];   // 변수에 세션 name을 저장
    $log_nav = '로그아웃'; 
    $log_href = 'logout.php';
    $log_icon = "fa-solid fa-arrow-right-from-bracket";
    $sql3 = "SELECT COUNT(*) AS total FROM temp24 WHERE mb_id = '$mb_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($row = mysqli_fetch_assoc($result3)) {
        $cart_total = (int)$row['total'];
    }
  }else{
    echo "<script>alert('로그인이 필요한 서비스입니다.');</script>";
    echo "<script>location.replace('../db/login/login.php');</script>";
    exit;
  }

  // 제목 변수 값이 없으면 기본값은 메인페이지
  $yes24_title = $_GET['title'] ?? '메인페이지';



  // db에 일치하는 사용자가 있는지 확인
  $sql = "SELECT * FROM temp24 WHERE mb_id = '$mb_id'";
  $result = mysqli_query($conn,$sql);
  if(!$result){
      echo "오류 발생: " . mysqli_error($conn);
      exit;
    }

  // 총 금액
  $sql2 = "SELECT SUM(money) FROM temp24 WHERE mb_id = '$mb_id' AND checked = '1'";
  $result2 = mysqli_query($conn, $sql2);
  $sum = mysqli_fetch_array($result2);

?>

  <!-- 독타입 헤더 열기 -->
  <?php include_once '../php/doctype2.php'; ?>
  
  <!-- 해당 페이지 서식 -->
  <link href="../css/cart.css" rel="stylesheet" type="text/css">

  <!-- 헤더 연결 -->
  <?php include '../php/header_2.php'; ?>

  <!-- 메인콘텐츠영역 -->
  <main id="cart">
    <div class="cart_outer">
      <!-- 제목, 장바구니>결제하기>결제완료-->
      <div class="payment_title">
        <h2>장바구니</h2>
        <!-- 경로 -->
        <ul class="path">
          <li>장바구니</li>
          <li><i class="fa-solid fa-angle-right"></i></li>
          <li>결제하기</li>
          <li><i class="fa-solid fa-angle-right"></i></li>
          <li>결제완료</li>
        </ul>
      </div>
      
      <!-- 콘텐츠1: 장바구니 -->
      <section class="con1">
        <?php $has_times = mysqli_num_rows($result) > 0; // 장바구니 비어있지 않다면
          if($has_times){
        ?>
          <!-- 전체선택|선택삭제 -->
          <p>
            <input type="checkbox" id="check_all"><label for="check_all">전체 선택</label>
            <input type="button" id="delete_checked" value="선택 삭제"><label for="delete_checked"></label>
            <a href="../index.php">쇼핑 계속하기 &#62;</a>
          </p>
        <?php }?>

        <!-- 좌: 장바구니 상품 & 우: 주문 예상 금액 -->
        <div>
          <!-- 좌: 장바구니 상품 묶음 -->
          <div class="cart_product_box">
            <?php
              if($has_times){
                // 다시 실행해야 하므로 결과 재조회
                $sql = "SELECT * FROM temp24 WHERE mb_id = '$mb_id'";
                $result = mysqli_query($conn, $sql);

                // 데이터베이스에서 자료 가져와서 출력하기
                while($row = mysqli_fetch_array($result)){
            ?>

            <!-- 개별 상품 -->
            <div class="cart_product" data-id="<?= $row['prd_no'] ?>">
              <!-- 닫기 버튼 -->
              <a href="#" class="del-btn" title="해당 제품 삭제하기"><i class="fas fa-times"></i></a>
              <!-- 선택 버튼 -->
              <!-- checked 열의 값이 1이면 체크되어있음 -->
              <input type="checkbox" id="item_chk_<?= $row['prd_no'] ?>" class="item_chk" <?= ($row['checked'] == 1 ? "checked" : "") ?>><label for="item_chk_<?= $row['prd_no']?>" class="item_title"><?= $row['prd_name'] ?></label>
  
              <!-- 책 이미지 -->
              <img src="../images/items/<?= $row['prd_picture'] ?>" alt="" class="">
  
              <!-- 제목, 저자 등 -->
              <div>
                <h3><?= htmlspecialchars($row['prd_name']) ?></h3>
  
                <p><?= $row['prd_author']?></p>

                <p><?= number_format($row['prd_price']).'원' ?></p>
  
                <p>내일(<span class="tomorrow_day"></span>) <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>

                <!-- 가격 -->
                <p class="price_input" data-total="<?= $row['money'] ?>" data-count="<?= $row['count'] ?>"></p>

                <!-- 수량 조절 박스 -->
                <div class="qty_box">
                  <i class="fa-solid fa-minus minus-btn"></i>
                  <i class="ea"><?= $row['count'] ?></i>
                  <i class="fa-solid fa-plus plus-btn"></i>
                </div>
                
              </div>
            </div>

            <?php
                }
              }else{
            ?>

            <!-- 만약 장바구니가 비어있다면 -->
            <div class="cart_empty">
              <p>장바구니가 비었습니다.</p>
              <a href="../index.php">상품 보러가기</a>
            </div>
            <?php } ?>
          </div>

          <!-- 우: 주문예상 금액 -->
          <div class="payment_box"> 
            <section class="payment_box_inner">
              <!-- 제목 -->
              <div class="p_box_title">
                <h3>주문 예상 금액</h3>
              </div>
              <!-- 총금액 계산 -->
              <div class="p_box_count">
                <dl>
                  <div class="p_box_cont">
                    <!-- 총 상품 가격 -->
                    <dt>총 상품 가격</dt>
                    <dd><?= number_format($sum[0]) ?>원</dd>
                  </div>
                  
                  <div class="p_box_cont">
                    <!-- 총 할인 금액 -->
                    <dt>총 할인 금액</dt>
                    <dd class="sale">-0원</dd>
                  </div>

                  <div class="p_box_cont">
                    <!-- 총 배송비 -->
                    <dt>총 배송비</dt>
                    <dd>0원</dd>
                  </div>
                </dl>
              </div>

              <!-- 총 금액(php) -->
              <div class="result_pay">
                <p><?= number_format($sum[0]) ?><span class="g_txt">원</span></p>
                <a href='payment.php?title=결제하기' title='결제하기' class='pay_btn pb'>결제하기</a>
              </div>
            </section>
            <a href="../index.php">쇼핑 계속하기 &#62;</a>
          </div>
        </div>
      </section>


      <?php mysqli_close($conn); ?>
  
      <!-- 콘텐츠2: 함께보면 좋은 상품 -->
      <section class="con2">
        <div>
          <h2>함께보면 좋은 상품</h2>
        </div>
        <ul>
          <li>
            <a href="#" title="달리기를 말할 때 내가 하고 싶은 이야기"><img src="../images/items/yes24_product_best2.jpg" alt=""></a>
            <h3>달리기를 말할 때 내가 하고 싶은 이야기</h3>
            <p>13,050원</p>
          </li>
          <li>
            <a href="#" title="위버멘쉬"><img src="../images/items/yes24_product_best3.jpg" alt=""></a>
            <h3>위버멘쉬</h3>
            <p>16,020원</p>
          </li>
          <li>
            <a href="#" title="대형주 추세추종 투자법칙"><img src="../images/items/yes24_product_best4.jpg" alt=""></a>
            <h3>대형주 추세추종 투자법칙</h3>
            <p>19,800원</p>
          </li>
          <li>
            <a href="#" title="절창"><img src="../images/items/yes24_product_best5.jpg" alt=""></a>
            <h3>절창</h3>
            <p>16,200원</p>
          </li>
          <li>
            <a href="#" title="박곰희 연금 부자 수업"><img src="../images/items/yes24_product_best6.jpg" alt=""></a>
            <h3>박곰희 연금 부자 수업</h3>
            <p>18,900원</p>
          </li>
        </ul>
      </section>
  
      <!-- 콘텐츠3: 위 상품을 고매한 고객이 함께 구매한 상품 -->
      <section class="con3">
        <div>
          <h2>위 상품을 고매한 고객이 함께 구매한 상품</h2>
        </div>
        <ul>
          <li>
            <a href="#" title="단 한 줄만 내 마음에 새긴다고 해도"><img src="../images/items/yes24_product_best8.jpg" alt=""></a>
            <h3>단 한 줄만 내 마음에 새긴다고 해도</h3>
            <p>21,420원</p>
          </li>
          <li>
            <a href="#" title="탁! 깨달음의 대화"><img src="../images/items/yes24_product_best9.jpg" alt=""></a>
            <h3>탁! 깨달음의 대화</h3>
            <p>15,300원</p>
          </li>
          <li>
            <a href="#" title="다크 심리학"><img src="../images/items/yes24_product_best10.jpg" alt=""></a>
            <h3>다크 심리학</h3>
            <p>19,710원</p>
          </li>
          <li>
            <a href="#" title="혼모노"><img src="../images/items/yes24_product_best11.jpg" alt=""></a>
            <h3>혼모노</h3>
            <p>16,200원</p>
          </li>
          <li>
            <a href="#" title="호의에 대하여"><img src="../images/items/yes24_product_best12.jpg" alt=""></a>
            <h3>호의에 대하여</h3>
            <p>16,920원</p>
          </li>
        </ul>
      </section>
    </div>

    <!-- 모바일 주문 예상 금액 상자 -->
    <div class='m_payment_box'>
        <div class='m_payment'>
          <div class='m_payment_inner'>
            <dl>
              <dt>총 상품 가격</dt>
              <dd class='mb_result_pay'><?= number_format($sum[0]) . '원' ?></dd>
            </dl>  

            <dl>
              <dt>총 할인 금액</dt>
              <dd class='sale'>-0원</dd>
            </dl>  

            <dl>
              <dt>총 배송비</dt>
              <dd>0,000원</dd>
            </dl>
          </div>
        </div>
        <div class='m_payment_down'>
          <div class='m_result_box'>
            <div class='m_result'>
              <span id='checked_total'>총 0개</span>
              <i class="fa-solid fa-angle-up"></i>
            </div>
            <p class='mb_result_pay'><?= number_format($sum[0]) . '원' ?></p>
          </div>
          <a href='payment.php' title='결제하기' class='mb_pay_btn pb'>결제하기</a>
        </div>
    </div>
  </main>

  <!-- 하단푸터영역 -->
  <?php include '../php/footer.php'; ?>

  <!-- 제이쿼리 -->
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <!-- 메인토글서브js -->
  <script src="../script/main_toggle_sub.js"></script>

  <script>
    // 스크롤시 헤더(검색바) 고정
    $(document).ready(function(){
      $(window).on('scroll', function(){
        if($(window).scrollTop() > 150){  // 150px 이상 내려가면
          $('.header_scroll').css('display','block');
        }else{
          $('.header_scroll').css('display','none');
        }
      });
    });

    // ********************제이쿼리********************
    $(document).ready(function(){
      // 결제하기 클릭시 장바구니에 물건이 없으면 안넘어가지게
      $('.pb').click(function(e){
        const noprd = updateTotalPrice();
        if(noprd.itemCount === 0){
          e.preventDefault();
          alert('장바구니에 담긴 상품이 없습니다.');
        }
      });


      // 장바구니 상품들 전부 선택되어있으면 전체선택 선택되게
      function totalChecked(){
        const total = $('.item_chk').length;
        const checkedCount = $('.item_chk:checked').length;

        $('#check_all').prop('checked', total > 0 && total === checkedCount);
      }

      // 함수 실행
      totalChecked()
      
      // 전체 선택
      $(document).on('change','#check_all',(e) => {
        const checked = $(e.target).prop('checked');
        $('.item_chk').prop('checked', checked);

        // 총 가격 업데이트
        updateTotalPrice();
      });

      // 개별상품 선택
      $(document).on('change','.item_chk',() => {
        const total = $('.item_chk').length;
        const checkedCount = $('.item_chk:checked').length;

        // 전부 선택되어있으면 전체선택에 체크
        $('#check_all').prop('checked', total === checkedCount);

        // 총 가격 업데이트
        updateTotalPrice();
      });

      // 선택 삭제 버튼 클릭
      $('#delete_checked').on('click', function(){
        // 선택된 체크박스들 찾기
        let ids = [];
        $('.item_chk:checked').each(function(){
          let id = $(this).closest('.cart_product').data('id');
          ids.push(id);
        });

        // 아무것도 선택되지 않았을 때
        if(ids.length ===0){
          return;
        }

        // AJAX 요청
        $.ajax({
          url: './ajax/cart_delete_checked.php',
          type: 'POST',
          data: {ids:ids},
          success: function(response){
            console.log(response);

            // 선택된 상품 화면에서 삭제
            $('.item_chk:checked').each(function(){
              $(this).closest('.cart_product').remove();
            });

            // 총가격 다시계산
            updateTotalPrice();

            // 장바구니가 비었을 때
            if($('.cart_product').length==0){
              $('.cart_product_box').html(`
                <div class="cart_empty">
                  <p>장바구니가 비었습니다.</p>
                  <a href="../index.php">상품 보러가기</a>
                </div>
              `);

              // 전체선택, 선택삭제 숨기기
              $('#check_all').parent().hide();
            }
          }
        });
      });

      // 개별선택항목 선택유무 데이터베이스와 연동하기
      $(document).on('change', '.item_chk', function(){
        // 체크되어있으면 checked 항목 값 = 1 로 설정하는 변수
        const checked = $(this).prop('checked') ? 1 : 0;

        const parent = $(this).closest('.cart_product');
        const cartId = parent.data('id');

        $.ajax({
          url : "./ajax/cart_check_update.php",
          type : "POST",
          data : {cart_id:cartId, checked:checked}
        });
      });

      // 전체선택 클릭시 선택유무 데이터베이스와 연동하기
      $(document).on('change', '#check_all', function(){
        // 체크되어있으면 checked 항목 값 = 1 로 설정하는 변수
        const checked = $(this).prop('checked') ? 1 : 0;

        $('.item_chk').each(function(){
          $(this).prop('checked', checked);

          const parent = $(this).closest('.cart_product');
          const cartId = parent.data('id');

          $.ajax({
            url : "./ajax/cart_check_update.php",
            type : "POST",
            data : {cart_id:cartId, checked:checked}
          });
        });
      });

      // 개별 삭제 (x버튼)
      $(document).on('click', '.del-btn', function(e){
        e.preventDefault();

        const parent = $(this).closest('.cart_product');
        const cartId = parent.data('id');

        // ajax요청
        $.ajax({
          url: "./ajax/cart_delete_single.php",
          type: "POST",
          data: {cart_id:cartId},
          success: function(response){
            console.log(response);

            // 화면에서 삭제
            parent.remove();

            // 총 금액 재계산
            updateTotalPrice();

            // 장바구니가 비었을 때
            if($('.cart_product').length==0){
              $('.cart_product_box').html(`
                <div class="cart_empty">
                  <p>장바구니가 비었습니다.</p>
                  <a href="../index.php">상품 보러가기</a>
                </div>
              `);

              // 전체선택, 선택삭제 숨기기
              $('#check_all').parent().hide();
            }
          }
        })
      })

      // 가격, 수량표시
      // 페이지 로드 시 초기 세팅
      $('.cart_product').each(function(){
        const priceBox = $(this).find('.price_input');
        const count = parseInt(priceBox.data('count'));
        const total = parseInt(priceBox.data('total'));
        const unitPrice = total / count;

        // 수량 표시
        $(this).find('.ea').text(count);

        // 가격 표시
        priceBox.text((unitPrice * count).toLocaleString() + '원');

        // unitPrice를 저장해두기
        priceBox.data('unit', unitPrice);
      });

      // 플러스 버튼 클릭
      $(document).on('click', '.plus-btn', function(){
        var parent = $(this).closest('.cart_product');
        var eaBox = parent.find('.ea');
        var priceBox = parent.find('.price_input');

        var n = parseInt(eaBox.text());
        var unitPrice = parseInt(priceBox.data('unit'));

        n++;  // 수량 증가
        eaBox.text(n); // 수량 표시
        priceBox.text((unitPrice * n).toLocaleString() + "원"); // 가격 표시

        // DB수정
        $.ajax({
          url: "./ajax/cart_update.php",
          type : "POST",
          data: {
            cart_id : parent.data('id'),
            count: n
          },
          success: function(response){
            console.log('DB수정 완료');
            updateTotalPrice(); // ← 총합 다시 계산
          },
        });
      });

      // 마이너스 버튼 클릭
      $(document).on('click', '.minus-btn', function(){
        const parent = $(this).closest('.cart_product');
        const eaBox = parent.find('.ea');
        const priceBox = parent.find('.price_input');

        let n = parseInt(eaBox.text());
        let unitPrice = parseInt(priceBox.data('unit'));

        if(n > 1){
          n--; // 1 미만으로 내려가지 않게 설정
        }

        eaBox.text(n);
        priceBox.text((unitPrice * n).toLocaleString() + "원");

        // DB수정
        $.ajax({
          url: "./ajax/cart_update.php",
          type : "POST",
          data: {
            cart_id : parent.data('id'),
            count: n
          },
          success: function(response){
            console.log('DB수정 완료');
            updateTotalPrice(); // ← 총합 다시 계산
          }
        });
      });


      // 총가격
      function updateTotalPrice() {
          let total = 0;
          let itemCount = 0;
          let total_count = 0;
          $('.cart_product').each(function(){

            const checkbox = $(this).find('.item_chk');

            // 체크된 항목만 계산
            if(checkbox.prop('checked')){
              itemCount++;
              const priceBox = $(this).find('.price_input');
              let text = priceBox.text().replace(/[^0-9]/g,"");
              total += parseInt(text);

              const t_count = $(this).find('.ea');
              let count = t_count.text().replace(/[^0-9]/g,"");
              total_count += parseInt(count);
            }
          });

          
          // 총 상품 가격 출력
          $('.p_box_cont').eq(0).find('dd').text(total.toLocaleString() + "원");

          // result_pay 영역 숫자만 교체
          $('.result_pay > p').html(total.toLocaleString() + '<span class="g_txt">원</span>');
          $('.mb_result_pay').text(total.toLocaleString() + '원');

          // 모바일 총 개수 / 총 금액
          $('#checked_total').text(`총 ${itemCount}종 (${total_count}개)`);
          $('.m_result_box p').text(total.toLocaleString() + "원");

          return { itemCount, total_count, total };
      }

      updateTotalPrice()
      // 모바일해상도에서 상품 제목 label로 하기
      function mobileLabel(){
        if($(window).width() <= 767){
          $('.item_title').css({'display':'block'});
        }else{
          $('.item_title').css({'display':'none'});
        }
      }

      mobileLabel();
      
      $(window).on('resize',mobileLabel);

    });
  </script>
</body>
</html>