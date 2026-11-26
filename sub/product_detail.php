<?php include_once '../php/doctype.php'; ?>
  <!-- 해당 페이지 서식 -->
  <link href="../css/product_detail.css" rel="stylesheet" type="text/css">
  <?php
        // 고유 번호 받아오기
    $prd_no = mysqli_real_escape_string($conn, $_GET['no']);

    // 고유 번호로 상품 정보 불러오기
    $sql = "SELECT * FROM product24 WHERE prd_no = '$prd_no'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $prd_no = $row['prd_no'];
    $prd_category = $row['prd_category'];
    $prd_name = $row['prd_name'];
    $prd_price = $row['prd_price'];
    $prd_picture = $row['prd_picture'];
    $prd_author = $row['prd_author'];
    $prd_description = $row['prd_description'];
    $author_description = $row['author_description'];
    $book_index = $row['book_index'];

    // 아이디로 찜 정보 불러오기
    $jjim_sql = "SELECT * FROM jjim WHERE mb_id = '$userid' AND prd_no = '$prd_no'";
    $jjim_result = mysqli_query($conn, $jjim_sql);
    $jjim = mysqli_fetch_array($jjim_result);

  ?>

  <!-- 헤더 연결 -->
  <?php include '../php/header.php'; ?>

  <!-- 메인콘텐츠영역 -->
  <main id="product_detail">
    <!-- 1198px로 감싸기 -->
    <div class="product_detail_outer">

      <!-- 콘텐츠1: 좌 - 책표지 & 우 - 설명 -->
      <section class="con1">

        <!-- 좌 - 책표지 -->
        <div>
          <img src="../db/admin/prd_images/<?= $row['prd_picture']?>" alt="<?= $row['prd_name'] ?>">
        </div>

        <!-- 우 - 설명 -->
        <div>
          <h2><?= $row['prd_name'] ?></h2>

          <p><?= $row['prd_author'] ?><span><i class="fa-solid fa-star text-end"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>(142)</span></p>

          <!-- 가격, 공유, 찜 버튼 -->
          <div>
            <p><?= number_format($row['prd_price']).'원' ?></p>
            <!-- 공유, 찜 버튼 -->
            <div>
              <!-- 공유 버튼 -->
              <i class="fa-solid fa-share-nodes"></i>

              <!-- 찜 버튼 -->
              <input type="checkbox" id="jjim_btn" class="jjim_btn" <?= $jjim['is_jjim'] == 1 ? 'checked' : '' ?>>
              <label for="jjim_btn" class="jjim_btn_label">
                <i class="fa-solid fa-heart" id="heart-btn"></i>
              </label>
            </div>
          </div>

          <!-- 배송 시간 -->
          <p>내일(<span class="tomorrow_day"></span>) <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>

          <form>
            <!-- 구매 수량, 가격 -->
            <div>
              <!-- 구매 수량 조절 박스 -->
              <div>
                <i class="fa-solid fa-minus" id="minus"></i><i id="ea">&nbsp;</i><i class="fa-solid fa-plus" id="plus"></i>
              </div>

              <!-- 구매 수량 데이터 -->
              <input type="hidden" name="quantity" id="quantity_input">
              
              <!-- 가격 -->
              <p id="price_input">&nbsp;</p>
            </div>
            
            <!-- 장바구니, 구매하기 버튼 -->
            <div>
              <div>
                <input type="submit" value="장바구니" id="add_cart_btn">
                <a href='#' title='구매하기' onclick="sendPost()">구매하기</a>
              </div>
            </div>
          </form>

          <!-- 구매하기 클릭시 같이 넘어가는 값  -->
          <form id="payForm" action="payment.php?title=결제하기" method="POST" style="display:none;">
            <input type="hidden" name="mode" value="direct">
            <input type="hidden" name="prd_no" value="<?= $row['prd_no'] ?>">
          </form>

          <!-- 결제혜택, 배송안내 -->
          <div>
            <p>결제혜택<span>카드/간편결제 혜택을 확인하세요</span></p>
            <p>배송안내<span>OO시 OO구 OO로 oo(OOO동, OOO빌딩)</span></p>
          </div>
        </div>
      </section>

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

      <!-- 탭메뉴 - 누르면 콘텐츠3/4/5로 이동 -->
      <nav class="book_nav">
        <ul>
          <li data-target="con3">도서정보</li>
          <li data-target="con4">리뷰(142)</li>
          <li data-target="con5" id="con5_nav">&nbsp;</li>
        </ul>
      </nav>

      <!-- 콘텐츠3: 도서정보 -->
      <section class="con3">
        <div>
          <h2>도서정보</h2>
        </div>

        <!-- 책소개 박스 -->
        <article>
          <div>
            <h3>책소개</h3>
          </div>
          <p id="intro_box">&nbsp;</p>
        </article>

        <!-- 저자소개 박스 -->
        <article>
          <!-- 저자소개 이너박스 -->
          <div>
            <h3>저자소개</h3>
            <!-- 펼쳐보기 / 접기 나오는 곳 -->
            <p class="author_box box_open"></p>
          </div>
          
          <!-- 누르면 나오는 저자소개 내용 -->
          <div>
            <p id="author"></p>
          </div>
        </article>

        <!-- 목차 박스 -->
        <article>
          <!-- 목차 이너박스 -->
          <div>
            <h3>목차</h3>
            <!-- 펼쳐보기 / 접기 나오는 곳 -->
            <p class="index_box box_open"></p>
          </div>
          
          <!-- 누르면 나오는 목차 내용 -->
          <div>
            <p id="index"></p>
          </div>
        </article>
      </section>

      <!-- 콘텐츠4: 리뷰 -->
      <section class="con4">
        <div>
          <h2>리뷰(142)</h2>
        </div>
        <!-- 큰박스(좌:이미지, 우:별점, 제목 등)-->
        <article>
          <div>
            <!-- 좌: 이미지 -->
            <img src="../images/items/review1.jpg" alt="">
  
            <!-- 우: 상(별점), 하(제목 등)이 있는 박스 -->
            <div>
              <!-- 상(별점) -->
              <span><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
    
              <!-- 하[박스(좌 - 제목, 내용,  우 - 아이디, 날짜)]  -->
              <div>
                <!-- 좌 - 제목, 내용 -->
                <div class="text-wrap">
                  <h3>미래 흐름을 읽는 10가지 키워드</h3>
                  <p class="text">트렌드 코리아 2026"은 김난도 교수와 서울대 소비트렌드분석센터 연구진이 함께 쓴 책으로, 다가오는 한 해의 변화를 예측하고 미래의 방향성을 제시합니다. 이번 책의 핵심 키워드는 ‘HORSE POWER’로, 기술이 주도하는 시대 속에서 인간의 역할과 가치가 어디에 놓여야 하는지를 묻습니다.</p>
                  <button class="btn-more">더보기 <i class="fa-solid fa-angle-down"></i></button>
                </div>
    
                <!-- 우 - 아이디, 날짜 -->
                <div>
                  <p>d******i</p>
                  <p>2025-10-09</p>
                </div>
              </div>
            </div>
          </div>
        </article>
        <!-- 큰박스(좌:이미지, 우:별점, 제목 등)-->
        <article>
          <div>
            <!-- 좌: 이미지 -->
            <img src="../images/items/review2.jpg" alt="">
  
            <!-- 우: 상(별점), 하(제목 등)이 있는 박스 -->
            <div>
              <!-- 상(별점) -->
              <span><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></span>
    
              <!-- 하[박스(좌 - 제목, 내용,  우 - 아이디, 날짜)]  -->
              <div>
                <!-- 좌 - 제목, 내용 -->
                <div class="text-wrap">
                  <h3>이미 산업보고서 등에서 언급된 내용들의 짜집기</h3>
                  <p class="text">1. 통찰력이 없는 취합<br>2. 글로벌 트랜드와 먼 이야기<br>3. 사회구조적 변화에 대한 고찰이 없음<br>4. 실생활 경험이 미천한 교수들이 쓴 책은 피하라는 말이 있었는데 잊고 산 내 잘못이 젤 크다<br>5. 글로벌 CEO들의 인터뷰나 글로벌 언론사들의 야야기를 듣는 것이 트랜드 파악에 젤 좋음</p>
                  <button class="btn-more">더보기 <i class="fa-solid fa-angle-down"></i></button>
                </div>
    
                <!-- 우 - 아이디, 날짜 -->
                <div>
                  <p>y*****5</p>
                  <p>2025-10-18</p>
                </div>
              </div>
            </div>
          </div>
        </article>
        <!-- 큰박스(좌:이미지, 우:별점, 제목 등)-->
        <article>
          <div>
            <!-- 좌: 이미지 -->
            <img src="../images/items/review3.jpg" alt="">
  
            <!-- 우: 상(별점), 하(제목 등)이 있는 박스 -->
            <div>
              <!-- 상(별점) -->
              <span><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
    
              <!-- 하[박스(좌 - 제목, 내용,  우 - 아이디, 날짜)]  -->
              <div>
                <!-- 좌 - 제목, 내용 -->
                <div class="text-wrap">
                  <h3>매년 기다리는 책!</h3>
                  <p class="text">2026년은 어떤해가 될지 기대하고 구입했어요~ 올 한해 우리는 너무도 힘들고 지친 어수선한 날들을 보냈기에 26년은 부디 모두가 희망을 가질수 있는 해가 되기를 바라는 마음으로 읽고 싶네요. 매년 읽어보는 트랜드코리아 넘 재밌고 유익합니다~</p>
                  <button class="btn-more">더보기 <i class="fa-solid fa-angle-down"></i></button>
                </div>
    
                <!-- 우 - 아이디, 날짜 -->
                <div>
                  <p>j*****e</p>
                  <p>2025-09-24</p>
                </div>
              </div>
            </div>
          </div>
        </article>
      </section>

      <!-- 콘텐츠5: 배송/반품/교환 안내 -->
      <section class="con5">
        <div>
          <h2>배송/반품/교환 안내</h2>
        </div>

        <!-- 배송 안내 박스 -->
        <article>
          <!-- 배송 안내  이너박스 -->
          <div>
            <h3>배송 안내</h3>
            <!-- 펼쳐보기 / 접기 나오는 곳 -->
            <p class="delivery_box box_open"></p>
          </div>
          
          <!-- 누르면 나오는 배송 안내 내용 -->
          <div>
            <p id="delivery"></p>
          </div>
        </article>

          <!-- 반품/교환 안내 박스 -->
        <article>
          <!-- 반품/교환 안내 이너박스 -->
          <div>
            <h3>반품/교환 안내</h3>
            <!-- 펼쳐보기 / 접기 나오는 곳 -->
            <p class="refund_box box_open"></p>
          </div>
          
          <!-- 누르면 나오는 반품/교환 안내 내용 -->
          <div>
            <p id="refund"></p>
          </div>
        </article>

      </section>
    </div>

    <!-- 장바구니 클릭하면 나오는 모달 -->
    <div class="cart_modal" id="cart_modal">
      <div class="cart_modal_box">
        <p>선택한 상품을 장바구니에 담았습니다.</p>
        <div class="cart_modal_btn_box">
          <button id="go_cart">장바구니로 이동</button>
          <button id="continue_shop">계속 쇼핑하기</button>
        </div>
      </div>
    </div>
  </main>

  <!-- 하단푸터영역 -->
  <?php include '../php/footer.php'; ?>

  <!-- 메인토글js -->
  <script src='../script/main_toggle.js'></script>

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

    // 결제하기 버튼 클릭시 넘기기
    function sendPost() {
      const form = document.getElementById('payForm');
      const qty = document.getElementById('quantity_input').value;

      // hidden input 생성
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'qty';
      input.value = qty;

      // form에 추가
      form.appendChild(input);

      // 제출
      form.submit();
    }


    // 책소개 내용들
    const book_intro = `
      <?= $prd_description ?>
    `
    const author = `
      <?= $author_description ?>
    `
    const index =`
      <?= $book_index ?>
    `

    // 배송/반품/교환 안내 내용
    const delivery = `
      <table>
        <tr>
          <th>배송 구분</th>
          <td>
            <ul>
              <li>예스24 배송</li>
              <li>배송비 : 무료배송</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>포장 안내</th>
          <td>
            <ul>
              <li>안전하고 정확한 포장을 위해 CCTV를 설치하여 운영하고 있습니다.</li>
              <li>고객님께 배송되는 모든 상품을 CCTV로 녹화하고 있으며, 철저한 모니터링을 통해 작업 과정에 문제가 없도록 최선을 다 하겠습니다.</li>
              <li>목적 : 안전한 포장 관리</li>
              <li>촬영범위 : 박스 포장 작업</li>
            </ul>
          </td>
        </tr>
      </table>
    `
    const refund = `
      <table>
        <tr>
          <th>반품/교환 방법</th>
          <td>
            <ul>
              <li>마이페이지 > 반품/교환 신청 및 조회, 1:1 문의, 고객만족센터(1544-3800), 중고샵(1566-4295)</li>
              <li>판매자 배송 상품은 판매자와 반품/교환이 협의된 상품에 한해 가능합니다.</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>반품/교환 가능기간</th>
          <td>
            <ul>
              <li>출고 완료 후 10일 이내의 주문 상품</li>
              <li>중고상품의 경우 출고 완료일로부터 6일 이내의 상품 (구매확정 전 상태)</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>반품/교환 비용</th>
          <td>
            <ul>
              <li>고객의 단순변심 및 착오구매일 경우 상품 반송비용은 고객 부담임</li>
              <li>직수입양서/직수입일서중 일부는 변심 또는 착오로 취소시 해외주문취소수수료 20%를 부과할수 있음</li>
              <li>직수입 음반/영상물/기프트 중 일부는 변심 또는 착오로 취소 시 해외주문취소수수료 30%를 부과할 수 있음</li>
              <li>박스 포장은 택배 배송이 가능한 규격과 무게를 준수하며, 고객의 단순변심 및 착오구매일 경우 상품의 반송비용은 박스 당 부과됩니다.</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>반품/교환 불가사유</th>
          <td>
            <ul>
              <li>소비자의 책임 있는 사유로 상품 등이 손실 또는 훼손된 경우</li>
              <li>소비자의 사용, 포장 개봉에 의해 상품 등의 가치가 현저히 감소한 경우 : 예) 화장품, 식품, 가전제품, 전자책 단말기 등</li>
              <li>복제가 가능한 상품 등의 포장을 훼손한 경우 : 예) CD/LP, DVD/Blu-ray, 소프트웨어, 만화책, 잡지, 영상 화보집</li>
              <li>소비자의 요청에 따라 개별적으로 주문 제작되는 상품의 경우</li>
              <li>중고상품이 구매확정(자동 구매확정은 출고완료일로부터 7일)된 경우</li>
              <li>시간의 경과에 의해 재판매가 곤란한 정도로 가치가 현저히 감소한 경우</li>
              <li>전자상거래 등에서의 소비자보호에 관한 법률이 정하는 소비자 청약철회 제한 내용에 해당되는 경우</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>소비자 피해보상</th>
          <td>
            <ul>
              <li>상품의 불량에 의한 반품, 교환, A/S, 환불, 품질보증 및 피해보상 등에 관한 사항은 소비자분쟁해결기준(공정거래위원회 고시)에 준하여 처리됨</li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>환불 지연에 따른 배상</th>
          <td>
            <ul>
              <li>대금 환불 및 환불 지연에 따른 배상금 지급 조건, 절차 등은 전자상거래 등에서의 소비자 보호에 관한 법률에 따라 처리</li>
            </ul>
          </td>
        </tr>
      </table>
    `
    
    // 제이쿼리 시작
    $(document).ready(function(){

      // 찜버튼
      $('#jjim_btn').click(function(){
        // 로그인 유효성 검사
        if(<?= $userid ? 'true' : 'false' ?> === false){
            alert("로그인이 필요한 서비스입니다.");
            $(this).prop('checked', false); // UI 되돌리기
            location.href="../db/login/login.php";
            return;
        }

        // 고유번호, 찜 유무 변수
        let prd_no = <?= $prd_no ?>;
        let is_jjim = $(this).prop('checked') ? 1 : 0;

        // 비동기 통신
        $.ajax({
          url: "./ajax/jjim_list.php",
          type: "POST",
          data: {
            prd_no: prd_no,
            is_jjim: is_jjim
          }
        });
      });

      // 구매 수량 조절 박스
      let n=1;
      let price = <?= $prd_price ?>;
      $('#ea').text(n);
      $('#quantity_input').val(n);
      $('#price_input').text('<?= number_format($prd_price); ?>원');
      // (-) 클릭시 
      $('#minus').click(function(){
        if(n>1){
          n-=1;
        }else{
          n=1;
        }
        $('#ea').text(n);
        $('#price_input').text((price * n).toLocaleString() + "원");
        $('#quantity_input').val(n);
      });

      // (+) 클릭시
      $('#plus').click(function(){
        n=n+1;
        $('#ea').text(n);
        $('#price_input').text((price * n).toLocaleString() + "원");
        $('#quantity_input').val(n);
      });

      // 장바구니에 추가(AJAX)
      $('#add_cart_btn').on('click', function(e){
        e.preventDefault(); // 기본 form제출 막기

        if(<?= $userid ? 'true' : 'false' ?> === false){
          alert('로그인이 필요한 서비스입니다.');
          location.href = '../db/login/login.php';
          return;
        }

        let qty = $('#quantity_input').val();
        $.ajax({
          url: "./ajax/cart_insert.php",
          type: "POST",
          data: {
            no: <?= $prd_no ?>,
            quantity: qty
          },
          success: function(res){
            console.log(res);
            showCartModal();
          }
        });

        // 장바구니 뱃지 최신화
        $.ajax({
          url: "./ajax/cart_total.php",
          type: "POST",
          success: function(total) {
            $('.h_cart_howmany').text(total);
            console.log(total)
          }
        })
      });


      // 모달 나오기
      function showCartModal(){
        $('#cart_modal').fadeIn(200);
      }


      // 모달 닫기
      $('#cart_modal').on('click', function(e){
        if(e.target === this){
          $('#cart_modal').fadeOut(200);
        }
      });

      // 장바구니로 이동
      $('#go_cart').on('click', function(){
        location.href = 'cart.php?title=장바구니';
      });

      // 계속 쇼핑하기
      $('#continue_shop').on('click', function(){
        $('#cart_modal').fadeOut(200);
      });

      // 도서정보, 리뷰, 배송 내비게이션
      $('.book_nav li').on('click', function () { // 내비게이션 클릭시
        // 타겟 변수로 지정
        const targetId = $(this).data('target');
        const targetOffset = $('.' + targetId).offset().top;

        // 타겟으로 스크롤
        $('html, body').animate({
          scrollTop: targetOffset
        }, 500); // 0.5초
      });

      // 모바일 해상도에서 내비게이션 제목 바꾸기
      function mobileNav(){
        if($(window).width() <=767){
          $('#con5_nav').text('배송·반품/교환')
        }else{
          $('#con5_nav').text('배송/반품/교환 안내')
        }
      }

      mobileNav();

      $(window).on('resize',mobileNav)

      // 도서정보 내용 입력
      $('#intro_box').html(book_intro);
      $('#author').html(author);
      $('#index').html(index);
      $('#delivery').html(delivery);
      $('#refund').html(refund);
      $('.box_open').html('펼쳐보기 <i class="fa-solid fa-angle-down"></i>');

      $(".author_box").click(function(){ // 저자소개 펼쳐보기 버튼 누르기
        // 저자소개 나옴
        $('#author').slideToggle(400);

        if($(this).hasClass('box_open')){
          // 접기
          $(this)
          .html('접기 <i class="fa-solid fa-angle-up"></i>')
          .removeClass('box_open');
          $(this).parent().addClass('open_margin')
        }else{
          // 펼치기
          $(this)
          .html('펼쳐보기 <i class="fa-solid fa-angle-down"></i>')
          .addClass('box_open');
          setTimeout(() => {
            $(this).parent().removeClass('open_margin');
          }, 340);
                }
      });

      $(".index_box").click(function(){ // 목차 펼쳐보기 버튼 누르기
        // 목차 나옴
        $('#index').slideToggle(400);

        if($(this).hasClass('box_open')){
          // 접기
          $(this)
          .html('접기 <i class="fa-solid fa-angle-up"></i>')
          .removeClass('box_open');
          $(this).parent().addClass('open_margin')
        }else{
          // 펼치기
          $(this)
          .html('펼쳐보기 <i class="fa-solid fa-angle-down"></i>')
          .addClass('box_open');
          setTimeout(() => {
            $(this).parent().removeClass('open_margin');
          }, 340);
        }
      });

      $(".delivery_box").click(function(){ // 배송 안내 펼쳐보기 버튼 누르기
        // 배송 안내 나옴
        $('#delivery').slideToggle(400);

        if($(this).hasClass('box_open')){
          // 접기
          $(this)
          .html('접기 <i class="fa-solid fa-angle-up"></i>')
          .removeClass('box_open');
          $(this).parent().addClass('open_margin')
        }else{
          // 펼치기
          $(this)
          .html('펼쳐보기 <i class="fa-solid fa-angle-down"></i>')
          .addClass('box_open');
          setTimeout(() => {
            $(this).parent().removeClass('open_margin');
          }, 380);
        }
      });

      $(".refund_box").click(function(){ // 반품/교환 안내 펼쳐보기 버튼 누르기
        // 반품/교환 안내 나옴
        $('#refund').slideToggle(400);

        if($(this).hasClass('box_open')){
          // 접기
          $(this)
          .html('접기 <i class="fa-solid fa-angle-up"></i>')
          .removeClass('box_open');
          $(this).parent().addClass('open_margin')
        }else{
          // 펼치기
          $(this)
          .html('펼쳐보기 <i class="fa-solid fa-angle-down"></i>')
          .addClass('box_open');
          setTimeout(() => {
            $(this).parent().removeClass('open_margin');
          }, 380);
        }
      });
      
      // 리뷰 3줄 초과 여부로 더보기 버튼 활성화 / 비활성화 함수
      $('.text-wrap').each(function(){
        // 변수 저장
        const $text = $(this).find('.text');
        const $btn = $(this).find('.btn-more');

        const lineHeight = parseFloat($text.css('line-height'));
        const maxLines = 3;
        const maxHeight = lineHeight * maxLines;

        if($text[0].scrollHeight <= $text.outerHeight()){
          $btn.hide();
        }else{
          $btn.show();
        }
      });

      // 버튼 클릭 시 펼치기/접기
      $('.btn-more').click(function(){
        const $text = $(this).siblings('.text');

        if ($text.hasClass('expanded')) {
            // 접기
            $text.removeClass('expanded');
            $(this).html('더보기 <i class="fa-solid fa-angle-down"></i>');
        } else {
            // 펼치기
            $text.addClass('expanded');
            $(this).html('접기 <i class="fa-solid fa-angle-up"></i>');
        }
      });

    });
  </script>
</body>
</html>