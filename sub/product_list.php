<?php include '../php/doctype.php'; ?>
  <!-- css -->
  <link href="../css/product_list.css" rel="stylesheet" type="text/css"> 
<!-- 헤더 -->
<?php include '../php/header.php'; ?>

<?php 
  $sql = "SELECT * FROM product24 WHERE prd_category='BEST'";
  $result = mysqli_query($conn, $sql);
  $review_num = 100;
?>
<main>

  <!-- 장바구니 버튼 클릭 시 뜨는 모달 -->
    <div class="cart_modal" id="cart_modal">
      <div class="cart_modal_box">
        <p>선택한 상품을 장바구니에 담았습니다.</p>
        <div class="cart_modal_btn_box">
          <button id="go_cart">장바구니로 이동</button>
          <button id="continue_shop">계속 쇼핑하기</button>
        </div>
      </div>
    </div>

  <!-- 좌측 제목+사이드네비게이션  -->
  <div class="title_side_box">
    <h2>베스트셀러</h2>
    
    <div class="left_box">
      <!-- 사이드 네비게이션 -->
      <nav class="side">
        <ul class="side_nav">
          <li><a href="#" title="국내도서">국내도서</a>
            <ul class="cate2">
              <li><a href="#" title="소설">소설</a></li>
              <li><a href="#" title="시/에세이">시/에세이</a></li>
              <li><a href="#" title="여행">여행</a></li>
              <li><a href="#" title="역사">역사</a></li>
              <li><a href="#" title="교육참고서">교육참고서</a></li>
              <li><a href="#" title="유아">유아</a></li>
            </ul>
          </li>

          <li><a href="#" title="해외도서">해외도서</a>
            <ul class="cate2">
              <li><a href="#" title="문학 소설">문학 소설</a></li>
              <li><a href="#" title="경제 경영">경제 경영</a></li>
              <li><a href="#" title="인문 사회">인문 사회</a></li>
            </ul>
          </li>

          <li><a href="#" title="소설">소설</a>
            <ul class="cate2">
              <li><a href="#" title="단편 소설">단편 소설</a></li>
              <li><a href="#" title="장편 소설">장편 소설</a></li>
              <li><a href="#" title="SF">SF</a></li>
              <li><a href="#" title="추리">추리</a></li>
            </ul>
          </li>
          
          <li><a href="#" title="만화">만화</a>
            <ul class="cate2">
              <li><a href="#" title="유아">유아</a></li>
              <li><a href="#" title="학습">학습</a></li>
              <li><a href="#" title="해외">해외</a></li>
            </ul>
          </li>

          <li><a href="#" title="수험서">수험서</a>
            <ul class="cate2">
              <li><a href="#" title="공무원">공무원</a></li>
              <li><a href="#" title="자격증">자격증</a></li>
              <li><a href="#" title="수능">수능</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <!-- 사이드를 제외한 나머지 묶음 -->
  <div class="main_cont">
  <!-- 우측 메인, 전체 상품목록 (날짜별 베스트) -->
  <div class="main_tap">
    <!-- 날짜별 선택 가능한 카테고리 -->
    <ul role="tablist">
      <li class="product_tab act1" aria-controls="product_panel1" id="product_tab1" role="tab" aria-selected="true">일별</li>
      <li class="product_tab" aria-controls="product_panel2" id="product_tab2" role="tab" aria-selected="false">주별</li>
      <li class="product_tab" aria-controls="product_panel3" id="product_tab3" role="tab" aria-selected="false">월별</li>
      <li class="product_tab" aria-controls="product_panel4" id="product_tab4" role="tab" aria-selected="false">년별</li>
    </ul>
  </div>

  <div class="main_product">
    <!-- 일별 상품 내용 박스 모음 -->
    <!-- 일별 상품 내용 박스 모음 -->
    <div class="product_panel product_act1" id="product_panel1" aria-labelledby="product_tab1" role="tabpanel">
        <!-- 상품 내용 박스 반복실행 1/4 -->
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
          <?php $review_num += 100; ?>
          <!-- 찜 버튼 데이터베이스 연결 -->
          <?php
            $prd_no = $row['prd_no'];
            $jjim_sql = "SELECT * FROM jjim WHERE mb_id = '$userid' AND prd_no = '$prd_no'"; 
            $jjim_result = mysqli_query($conn, $jjim_sql);
            $jjim=mysqli_fetch_assoc($jjim_result);
            $jjim_chk = ($jjim && $jjim['is_jjim'] == 1) ? 'checked' : '';
          ?>
        <div class="product_box" data-id="<?= $row['prd_no'] ?>">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="#" title="상품페이지로 이동하기" data-no="<?= $row['prd_no'] ?>" class='go_prd_detail'>
                <img src="../images/items/<?php echo $row['prd_picture'] ?>" alt="<?php echo $row['prd_name']?>"></a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동" data-no="<?= $row['prd_no'] ?>" class='go_prd_detail'><?php echo $row['prd_name']?></a></h3>
              <p class="writer"><?php echo $row['prd_author']?></p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>(<?php echo $review_num; ?>)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'><?= number_format($row['prd_price']) ?>원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form action="add_cart.php" method="POST">
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼 -->
                <input type="checkbox" id="jjim_<?php echo $row['prd_no'] ?>" class="jjim" data-no="<?= $row['prd_no']; ?>" <?= $jjim_chk ?>>
                <label for="jjim_<?php echo $row['prd_no'] ?>" class="jjim_box">
                  <span>찜하기</span>
                  <i class="fa-solid fa-heart"></i>
                </label>
                <!-- 장바구니 -->
                <input type="submit" value="장바구니" class="add_cart_btn">
              </form>

              <form action="payment.php?title=결제하기" method="POST">
                <!-- 값 넘기기 -->
                <input type="hidden" name="mode" value="direct">
                <input type="hidden" name="prd_no" value="<?= $row['prd_no'] ?>">
                <input type="hidden" name="qty" value="1">

                
                <!-- 구매하기 -->
                <button type="submit">구매하기</button>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>

        <!-- 상품 내용 박스 일별 (5/8) -->
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
            <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best5.jpg" alt="상품사진"  >
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">절창</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>구병모</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>16,200원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart1" class="jjim" data-no="" >
                  <label for="red_heart1" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 일별 (6/8) -->
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best6.jpg" alt="상품사진" >
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">박곰희 연금 부자 수업</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>박곰희</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,900원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart2" class="jjim" data-no="" >
                  <label for="red_heart2" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 일별 (7/8) -->
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best7.jpg" alt="상품사진" >
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">어른의 행복은 조용하다</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>태수</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>13,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart3" class="jjim" data-no="" >
                  <label for="red_heart3" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 일별 (8/8) -->
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best8.jpg" alt="상품사진" >
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">단 한 줄만 내 마음에 새긴다고 해도</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>나민애</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>21,420원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart4" class="jjim" data-no="" >
                  <label for="red_heart4" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

    </div>

    <!-- 주별 상품 내용 박스 모음 -->
    <div class="product_panel" id="product_panel2" aria-labelledby="product_tab2" role="tabpanel" hidden>

        <!-- 상품 내용 박스 주별 (1/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best3.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">위버멘쉬</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>프리드리히 니체</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>17,800원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart5" class="jjim" data-no="" >
                  <label for="red_heart5" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (2/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best2.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">달리기를 말할 때 내가 하고 싶은 이야기</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>무라카미 하루키</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>14,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart6" class="jjim" data-no="" >
                  <label for="red_heart6" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (3/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best5.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">절창</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>구병모</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>16,200원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart7" class="jjim" data-no="" >
                  <label for="red_heart7" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (4/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best4.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">대형주 추세추종 투자법칙</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>이종호</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>22,000원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart8" class="jjim" data-no="" >
                  <label for="red_heart8" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (5/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best6.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">박곰희 연금 부자 수업</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>박곰희</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,900원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart9" class="jjim" data-no="" >
                  <label for="red_heart9" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (6/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best7.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">어른의 행복은 조용하다</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>태수</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>13,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart10" class="jjim" data-no="" >
                  <label for="red_heart10" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (7/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best1.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">트랜드 코리아2025</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>김난도, 전미영, 최지혜, 권정윤, 한다혜 저 외 7명</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,000원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart11" class="jjim" data-no="" >
                  <label for="red_heart11" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 주별 (8/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best8.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">단 한 줄만 내 마음에 새긴다고 해도</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>나민애</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>21,420원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart12" class="jjim" data-no="" >
                  <label for="red_heart12" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

    </div>

    <!-- 월별 상품 내용 박스 모음 -->
    <!-- 월별 상품 내용 박스 모음 -->
    <div class="product_panel" id="product_panel3" aria-labelledby="product_tab3" role="tabpanel" hidden>
        <!-- 상품 내용 박스 월별 (1/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best9.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">탁! 깨달음의 대화</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동">법륜</a></p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>15,300원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart13" class="jjim" data-no="" >
                  <label for="red_heart13" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (2/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best10.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">다크 심리학</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동">다크 사이드 프로젝트</a></p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>19,710원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart28" class="jjim" data-no="" >
                  <label for="red_heart28" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (3/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best8.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">단 한 줄만 내 마음에 새긴다고 해도</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>나민애</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>21,420원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart14" class="jjim" data-no="" >
                  <label for="red_heart14" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (4/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best6.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">박곰희 연금 부자 수업</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>박곰희</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,900원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart15" class="jjim" data-no="" >
                  <label for="red_heart15" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (5/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best5.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">절창</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>구병모</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>16,200원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart16" class="jjim" data-no="" >
                  <label for="red_heart16" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (6/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best3.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">위버멘쉬</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>프리드리히 니체</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>17,800원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart17" class="jjim" data-no="" >
                  <label for="red_heart17" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (7/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best1.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">트랜드 코리아2025</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>김난도, 전미영, 최지혜, 권정윤, 한다혜 저 외 7명</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,000원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart18" class="jjim" data-no="" >
                  <label for="red_heart18" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 월별 (8/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best7.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">어른의 행복은 조용하다</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>태수</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>13,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart19" class="jjim" data-no="" >
                  <label for="red_heart19" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>
        
        

    </div>

    <!-- 년별 상품 내용 박스 모음 -->
    <!-- 년별 상품 내용 박스 모음 -->
    <div class="product_panel" id="product_panel4" aria-labelledby="product_tab4" role="tabpanel" hidden>
        <!-- 상품 내용 박스 년별 (1/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best2.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">달리기를 말할 때 내가 하고 싶은 이야기</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>무라카미 하루키</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>14,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart20" class="jjim" data-no="" >
                  <label for="red_heart20" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (2/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best1.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">트랜드 코리아2025</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>김난도, 전미영, 최지혜, 권정윤, 한다혜 저 외 7명</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>18,000원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart21" class="jjim" data-no="" >
                  <label for="red_heart21" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (3/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best10.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">다크 심리학</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동">다크 사이드 프로젝트</a></p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>19,710원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart22" class="jjim" data-no="" >
                  <label for="red_heart22" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (4/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best9.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">탁! 깨달음의 대화</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동">법륜</a></p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>15,300원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart23" class="jjim" data-no="" >
                  <label for="red_heart23" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (5/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best3.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">위버멘쉬</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>프리드리히 니체</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>17,800원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart24" class="jjim" data-no="" >
                  <label for="red_heart24" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (6/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best5.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">절창</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>구병모</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>16,200원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart25" class="jjim" data-no="" >
                  <label for="red_heart25" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (7/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best7.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">어른의 행복은 조용하다</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>태수</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>13,500원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart26" class="jjim" data-no="" >
                  <label for="red_heart26" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>

        <!-- 상품 내용 박스 년별 (8/8) -->
        
        <div class="product_box">
          <!-- 왼쪽 50%크기 박스 -->
          <div class="product_left">
          <!-- 상품 사진 -->
            <div class="image_box">
              <a href="상품페이지" title="상품페이지로 이동하기">
                <img src="../images/items/yes24_product_best8.jpg" alt="상품사진" loading="lazy">
              </a>
            </div>
          </div>

          <!-- 오른쪽 50%크기 박스 -->
          <div class="product_right">
            <!-- 상품 제목+저자 박스 -->
            <div class="product_title">
              <h3><a href="#" title="상품 상세페이지로 이동">단 한 줄만 내 마음에 새긴다고 해도</a></h3>
              <p><a href="#" title="상품 상세페이지로 이동"></a>나민애</p>
            </div>
            <!-- 상품 정보 박스 -->
            <div class="product_info">
              <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> (200)</p>
              <p class="delivery">내일(<span class="tomorrow_day"></span>) 
                <span class="tomorrow_date"></span> 새벽 7시 전 도착 보상</p>
              <p class='price'>21,420원</p>
            </div>

            <!-- 상품 버튼들 -->
            <div class="product_btn">
              <form>
                <!-- 구매 수량 데이터 n=1 -->
                <input type="hidden" name="quantity" class="quantity_input" value="1">
                <!-- 찜버튼, 장바구니, 구매하기-->
                  <input type="checkbox" id="red_heart27" class="jjim" data-no="" >
                  <label for="red_heart27" class="jjim_box">
                    <span>찜하기</span>
                    <i class="fa-solid fa-heart"></i>
                  </label>
                  <input type="submit" value="장바구니" class="add_cart_btn">
                  <button type="submit" formaction="payment.php" formmethod="POST">구매하기</button>
              </form>
            </div>
          </div>
        </div>
        
        </div>
    </div>
  </div>

    <!-- 메인콘텐츠 끝 main_product -->
  
</main>
<!-- 푸터 -->
<?php include '../php/footer.php'; ?>
<script src='../script/main_toggle.js'></script>
<script>
const tabs = document.querySelectorAll('.product_tab');
const panels = document.querySelectorAll('.product_panel');

tabs.forEach(tab =>{
  tab.addEventListener("click", function (){

    // 1.모든 탭 비활성화
    tabs.forEach(t => {
      t.classList.remove("act1");
      t.setAttribute("aria-selected", "false");
    });

    // 2. 클릭된 탭 활성화
    this.classList.add("act1");
    this.setAttribute("aria-selected", "true");

    //3. 모든 패널 숨기기
    panels.forEach(panel => {
      panel.classList.remove("product_act1");
      panel.hidden = true;
    });

    //4. 연결된 패널 보이기
    const targetId = this.getAttribute("aria-controls");
    const targetPanel = document.getElementById(targetId);
    targetPanel.classList.add("product_act1");
    targetPanel.hidden = false;

  });
});


$(document).ready(function(){

  $('.go_prd_detail').on('click', function(e){
    e.preventDefault();

    // 눌린 개별 페이지 이동 버튼의 상품 번호
    const prd_no = $(this).data('no');

    // 페이지 이동
    location.href = `./product_detail.php?no=${prd_no}&title=상세페이지`;
  });

  // 장바구니에 추가(AJAX)
  $('.add_cart_btn').on('click', function(e){
    e.preventDefault(); // 기본 form제출 막기

    if(<?= $userid ? 'true' : 'false' ?> === false){
      alert('로그인이 필요한 서비스입니다.');
      location.href = '../db/login/login.php';
      return;
    }

    let qty = $('.quantity_input').val();
    const prd_no = $(this).closest('.product_box').data('id');

    $.ajax({
      url: "./ajax/cart_insert.php",
      type: "POST",
      data: {
        no: prd_no,
        quantity: qty
      },
      success: function(res){
        console.log(res);
        showCartModal();
      }
    });

    // 장바구니 뱃지 수량변경
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

  // 찜버튼 클릭이벤트
  $('.jjim').on('click', function(){
    // 로그인 유효성 검사
    if(<?= $userid ? 'true' : 'false' ?> === false){
        alert("로그인이 필요한 서비스입니다.");
        $(this).prop('checked', false); // UI 되돌리기
        location.href="../db/login/login.php";
        return;
    }

    let $btn = $(this);

    // 찜 유무 1,0
    let is_jjim = $(this).prop('checked') ? 1 : 0;
    // 상품번호
    let prd_no = $(this).data('no');

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
});

</script>
</body>
</html>