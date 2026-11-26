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
    if ($row3 = mysqli_fetch_assoc($result3)) {
        $cart_total = (int)$row3['total'];
    }
  }else{
    echo "<script>alert('로그인이 필요한 서비스입니다.');</script>";
    echo "<script>location.replace('../db/login/login.php');</script>";
    exit;
  }


  // 제목 변수 값이 없으면 기본값은 메인페이지
  $yes24_title = $_GET['title'] ?? '메인페이지';




  $sql = "SELECT * FROM member24 WHERE mb_id = '$mb_id'";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "오류 발생: " . mysqli_error($conn);
    exit;
  }

    $row = mysqli_fetch_assoc($result);

    if(trim($row['mb_address'])==''){
        $address_btn = '등록';
        $address = '';
    } else {
        $address = $row['mb_address'];
        $address_btn = '수정';
    }
    $_SESSION['address_btn'] = $address_btn;
    $phone = $row['mb_phone'];
    // 전화번호에 하이픈 넣기
    $phone_format = substr($phone, 0, 3) . '-' . substr($phone, 3, 4) . '-' . substr($phone, 7, 4);

    $mode = $_POST['mode'] ?? 'cart';
    if($mode === 'cart'){
      //총 금액
      $sql2 = "SELECT SUM(money) FROM temp24 WHERE mb_id = '$mb_id' and checked = 1";
      $result2 = mysqli_query($conn, $sql2);
      $sum = mysqli_fetch_array($result2);

      $sql_total = "SELECT SUM(count) AS total_quantity, COUNT(*) AS total_items FROM temp24 WHERE mb_id = '$mb_id' AND checked = 1";
      $result_total = mysqli_query($conn, $sql_total);
      $total = mysqli_fetch_array($result_total);
      
      $items[] = [
        'money' => $sum[0],
        'count' => $total['total_quantity'],
        'kind'  => $total['total_items']
    ];


    }else if ($mode === 'direct'){
      $kind = 1;
      $prd_no = intval($_POST['prd_no']);
      $qty = intval($_POST['qty']);

      
      $sql2 = "SELECT prd_price FROM product24 WHERE prd_no = '$prd_no'";
      $result2 = mysqli_query($conn, $sql2);

      if ($row2 = mysqli_fetch_assoc($result2)) {
        $row2['count'] = $qty;
        $row2['money'] = $row2['prd_price'] * $qty;
        $row2['kind'] = $kind;
        $items[] = $row2;

      } else {
          echo "<script>alert('상품 정보를 찾을 수 없습니다.'); history.back();</script>";
          exit;
      }
    }

    $total_price = 0;
    foreach ($items as $item) {
    $total_price += $item['money'];
    }
?>

  <!-- 독타입 head -->
  <?php include '../php/doctype2.php'; ?>

  <!-- patment서식 -->
  <link href="../css/payment.css" rel="stylesheet" type="text/css">
  <link href="../css/payment_box.css" rel="stylesheet" type="text/css">
  
  <!-- head 닫기 body header -->
  <?php include '../php/header_2.php'; ?>

  <!-- 메인콘텐츠 영역 -->
  <main>
    <!-- 다른결제수단 체크박스 -->
    <input type="checkbox" id="other" />
    <div class="payment_inner">
      <!-- 결제하기 제목 -->
      <div class='payment_title_outer'>
        <div class="payment_title">
          <h2>결제하기</h2>
          <!-- 경로 -->
          <ul class="path">
            <li>장바구니</li>
            <li><i class="fa-solid fa-angle-right"></i></li>
            <li>결제하기</li>
            <li><i class="fa-solid fa-angle-right"></i></li>
            <li>결제완료</li>
          </ul>
        </div>
    </div>

      <form name="결제하기 폼" method="post" action="../db/sub_check/payment_fin.php" onsubmit="return pay_form_check();" class="payment_form">
        <fieldset>
        <legend class="payment_form_t">결제하기 폼</legend>
        </fieldset>
        <!-- 결제하기 항목 -->
        <div class="payment_list">

          <!-- 배송지 | 고객명(수정해야함 PHP) -->
          <section class="delivery_address">
            <!-- 숨기기 -->
            <h3 class="payment_t_none">배송지</h3>
            <!-- 제목영역 -->
            <div class="payment_list_title">
              <h3>배송지 <span class="g_line">| </span><?php echo $name; ?></h3>
              <button type="button" aria-haspopup="dialog" class="modal_btn">배송지 <?php echo $address_btn; ?></button>
            </div>
            <!-- 컨텐츠 -->
            <div class="cont payment_cont1">
              <!-- php로 배송지 등록 -->
              <p class="address cont_center">
                <!-- 배송지(php)<br/> -->
                <?php 
                  if($address == ''){
                    echo '배송지를 등록해주세요';
                  }else{
                    echo $address .'<br/>';
                    echo '휴대폰: ' . $phone_format;
                  }
                ?>

                <!-- 휴대폰: (php) -->
              </p>
            </div>
          </section>

          <!-- 배송 요청 사항 -->
          <section class="request">
            <!-- 숨기기 -->
            <h3 class="payment_t_none">배송 요청사항</h3>
            <!-- 제목영역 -->
            <div class="payment_list_title">
              <label for="de_request">배송 요청사항</label>
            </div>
            <!-- 컨텐츠 -->
            <div class="cont payment_cont1">
              <p class="cont_center">
                
                <input type="text" id="de_request" name="de_request" placeholder="ex) 문 앞에 놔주세요" />
              </p>
            </div>
          </section>

          <!-- 결제수단 -->
          <section class="payment_method">
            <!-- 숨기기 -->
            <h3 class="payment_t_none">결제수단</h3>
            <!-- 제목영역 -->
            <div class="payment_list_title">
              <h3>결제수단</h3>
            </div>

            <!-- 컨텐츠 -->
            <div class="cont payment_cont2">
              <!-- 신용카드 -->
              <div class="cont_center">
                <p class="pay_method">
                  <input type="radio" name="payment_methods" id="card" value="카드" checked />
                  <label for="card">신용/체크카드</label>
                </p>
                <p class="pay_method">
                  <input type="radio" name="payment_methods" id="account" value="계좌이체" />
                  <label for="account">계좌이체</label>
                </p>
              </div>
            </div>
            
            <!-- 다른 결제 수단 -->
            <div class="other_payment">
              <label for="other">다른 결제 수단 <i class="fa-solid fa-angle-down"></i></label>
              <div class="other_pay_list">
                <p class="pay_method">
                  <input type="radio" name="payment_methods" id="phone" value="휴대폰" />
                  <label for="phone">휴대폰</label>
                </p>

                <p class="pay_method">
                  <input type="radio" name="payment_methods" id="bank" value="무통장입금" />
                  <label for="bank">무통장입금(가상계좌)</label>
                </p>
                
                <p class="pay_method">
                  <input type="radio" name="payment_methods" id="c_card" value="법인카드" />
                  <label for="c_card">법인카드</label>
                </p>
              </div>
            </div>
          </section>

          <!-- 현금영수증 -->
          <section class="receipt">
            <!-- 숨기기 -->
            <h3 class="payment_t_none">현금영수증</h3>
            <!-- 제목영역 -->
            <div class="payment_list_title">
              <h3>현금영수증</h3>
            </div>
            <!-- 컨텐츠 -->
            <div class="cont payment_cont1">
              <div class="cont_center">
                <p class="receipt_method">
                  <input type="radio" name="receipt" id="receipt1" value="소득공제" />
                  <label for="receipt1">소득공제</label>
                </p>

                <p class="receipt_method">
                  <input type="radio" name="receipt" id="receipt2" value="지출증빙" />
                  <label for="receipt2">지출증빙</label>
                </p>
              </div>
            </div>
          </section>

          <!-- 배송 -->
          <section class="delivery">
            <!-- 숨기기 -->
            <h3 class="payment_t_none">배송</h3>
            <!-- 제목영역 -->
            <div class="payment_list_title">
              <h3>배송</h3>
            </div>
            <!-- 컨텐츠 -->
            <div class="cont payment_cont3">
              <div class="cont_center">
                <p class="del_method">
                  내일(<span class="tomorrow_day"></span>) <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상
                </p>
              </div>
            </div>
          </section>
        </div>

        <!-- 주문예상 금액 상자 -->
        <div class="payment_box"> 
          <section class="payment_box_inner">
            <h3 class="payment_t_none">주문 예상 금액</h3>
            <!-- 제목 -->
            <div class="p_box_title">
              <h3>주문 예상 금액</h3>
            </div>
            <!-- 총금액 계산 -->
            <div class="p_box_count">
              <div>
                <!-- 총 상품 가격 -->                
                <dl class="p_box_cont">
                  <dt>총 상품 가격</dt>
                  <dd><?= number_format($total_price); ?>원</dd>
                </dl>
                
                <!-- 총 할인 금액 -->
                <dl class="p_box_cont">
                  <dt>총 할인 금액</dt>
                  <dd class="sale">-0원</dd>
                </dl>

                  <!-- 총 배송비 -->
                <dl class="p_box_cont">
                  <dt>총 배송비</dt>
                  <dd>0원</dd>
                </dl>
              </div>
            </div>

            <!-- 총 금액(php) -->
            <div class="result_pay">
              <p><?= number_format($total_price) ?><span class="g_txt">원</span></p>
              <input type="submit" value="결제하기">
            </div>
          </section>
        </div>

        <!-- 모바일 주문 예상 금액 상자 -->
        <div class='m_payment_box'>
            <div class='m_payment'>
              <div class='m_payment_inner'>
                <dl>
                  <dt>총 상품 가격</dt>
                  <dd><?= number_format($total_price).'원' ?></dd>
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
                <?php
                  foreach ($items as $it) :
                ?>
                  <span>총 <?= $it['kind']; ?>종 (<?= $it['count']; ?>개)</span>
                <?php endforeach; ?>
                  <i class="fa-solid fa-angle-up"></i>
                </div>
                <p><?= number_format($total_price) . '원' ?></p>
              </div>
              <input type="submit" value="결제하기">
            </div>
        </div>
      </form>
    </div>
  </main>

  <!-- 하단푸터영역 -->

  <?php include '../php/footer.php'; ?>

  <script src='../script/main_toggle_sub.js'></script>
  
  <script>
    // 결제하기 폼 유효성 검사 
    const address = <?= json_encode($address) ?>;

    function pay_form_check() {
      if (!address || address.trim() === '') {
        alert('주소지를 입력해주세요');
        return false;
      }
      return true;
    }

    // 모달 배송지입력 유효성 검사 
    function m_form_check() {

      const name   = $('#modal_name').val().trim();
      const phone  = $('#modal_phone').val().trim();
      const addr   = $('#modal_address').val().trim();
      const detail = $('#modal_detail').val().trim();

      if (!name) {
        alert('받는 분을 입력해주세요.');
        $('#modal_name').focus();
        return false;
      }

      if (!phone || phone.length !== 11) {
        alert('휴대폰 번호 11자리를 입력해주세요.');
        $('#modal_phone').focus();
        return false;
      }

      if (!addr) {
        alert('주소를 입력해주세요.');
        $('#modal_address').focus();
        return false;
      }

      return true;
    }

    // 모달 HTML 템플릿
    const del_modal = `
      <div class='del_modal_bg'>
        <div class='modal'>
          <div class='modal_inner'>
            <div class='modal_title'>
              <h3>배송지 정보</h3>
              <i class="fa-solid fa-x"></i>
            </div>
            <form name='배송지 정보폼' method='post' action='../db/sub_check/address_input.php' onsubmit='return m_form_check();'>
              <fieldset>
                <legend>배송지 정보폼</legend>
                <p>
                  <label for='modal_name'>받는 분</label>
                </p>
                <p>
                  <input type='text' id='modal_name' name='modal_name' placeholder='ex) 홍길동' maxlength='10' value='<?php echo $name; ?>' />
                </p>

                <p>
                  <label for='modal_phone'>휴대폰 번호</label>
                </p>
                <p>
                  <input type='text' id='modal_phone' name='modal_phone' placeholder='ex) 01012341234' maxlength="11" minlength='11' pattern="\\d{11}" value='<?php echo $phone; ?>' />
                </p>

                <p>
                  <label for='modal_address'>주소</label>
                </p>
                <p>
                  <input type='text' id='modal_address' name='modal_address' placeholder='ex) 서울 종로구 관수동 20' maxlength="100" />
                </p>

                <p>
                  <label for='modal_detail'>상세주소</label>
                </p>
                <p>
                  <input type='text' id='modal_detail' name='modal_detail' placeholder='ex) 국일관드림팰리스 2층'>
                </p>

                <p>
                  <input type='submit' value='저장'>
                </p>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    `;

    function closeModal() {
      $('.del_modal_bg').fadeOut(200, function () {
        $(this).remove();
      });
    }

    // ✅ 딱 한 번만 쓰는 document.ready
    $(document).ready(function () {
      // === 1. 다른 결제 수단 화살표 ===
      const pay_arrow = $('.other_payment > label > i');

      $("#other").on('change', function () {
        if ($(this).is(':checked')) {
          pay_arrow.attr('class', 'fa-solid fa-angle-up');
        } else {
          pay_arrow.attr('class', 'fa-solid fa-angle-down');
        }
      });

      // === 2. 결제하기 박스 고정 ===
      const box = $('.payment_box');
      let boxTop, boxLeft, boxWidth;

      function updateBoxBase() {
        // 원래 위치 기준으로 다시 계산
        box.removeClass('fixed').css({
          left: '',
          width: ''
        });

        boxTop   = box.offset().top;
        boxLeft  = box.offset().left;
        boxWidth = box.outerWidth();
      }

      // 처음 1회 계산
      updateBoxBase();

      // 리사이즈 시 기준 다시 계산 + 스크롤 로직 재적용
      $(window).on('resize', function () {
        updateBoxBase();
        $(this).trigger('scroll');
      });

      // 스크롤에 따라 고정
      $(window).on('scroll', function () {
        const scrollT = $(this).scrollTop();

        if (scrollT >= boxTop - 50) {
          box.addClass('fixed').css({
            left: boxLeft,
            width: boxWidth
          });
        } else {
          box.removeClass('fixed').css({
            left: '',
            width: ''
          });
        }
      });

      // === 3. 배송지 입력 모달 열기 ===
      $('.modal_btn').on('click', function () {
        $('body').prepend(del_modal);
        $('.del_modal_bg').hide().fadeIn(200);
      });

      // === 4. X 버튼 클릭 시 모달 닫기 ===
      $(document).on('click', '.modal_title .fa-x', function () {
        closeModal();
      });
    });
  </script>

</body>
</html>