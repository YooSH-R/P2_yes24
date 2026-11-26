  <!-- 장바구니 없으면 없어지게 style적용 -->
  <?php if($cart_total == 0): ?>
    <style>
      .mb_h_cart_howmany,
      .h_cart_howmany {
        display: none !important;
      }
    </style>
  <?php endif; ?>
  </head>
  <body>
    
    <script>
      const logHref = "<?php echo $log_href; ?>";
      const logNav = "<?php echo $log_nav; ?>";
      const cart_total = "<?php echo $cart_total; ?>";
      const log_icon = "<?php echo $log_icon; ?>";
    </script>
    <!-- 토글 체크박스 -->
    <input type="checkbox" id="toggle_btn">

    <!-- 토글 메뉴 -->
    <div class="toggle_outer">
      <div class="toggle_inner">
        <div class="toggle_title">
          <p><span class="user_name">
          <?php 
            if(!isset($_SESSION['mb_id'])){
            ?>
            <a href="../db/login/login.php" title="로그인하기">
              로그인하기
            </a>
          </span></p>
          <?php }else{ 
            echo $_SESSION['mb_name'];
            ?>님 </span>어서오세요!</p>
          <?php } ?>
          <i class="fa-solid fa-x"></i>
        </div>
        <ul class="first_cate">
          <li>
            <p>카테고리</p>
            <ul class="second_cate">
              <li>
                국내도서
                <i class="fa-solid fa-angle-down"></i>
                <ul class="third_cate">
                  <li class="action">
                    <a href="#" title="소설" onclick="event.preventDefault();">
                      소설<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="시/에세이" onclick="event.preventDefault();">
                      시/에세이<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="여행" onclick="event.preventDefault();">
                      여행<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="역사" onclick="event.preventDefault();">
                      역사<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                해외도서
                <i class="fa-solid fa-angle-down"></i>
                <ul class="third_cate">
                  <li>
                    <a href="#" title="문학소설" onclick="event.preventDefault();">
                      문학소설<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="결제경영" onclick="event.preventDefault();">
                      결제경영<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="인문사회" onclick="event.preventDefault();">
                      인문사회<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                소설
                <i class="fa-solid fa-angle-down"></i>
                <ul class="third_cate">
                  <li>
                    <a href="#" title="단편소설" onclick="event.preventDefault();">
                      단편소설<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="장편소설" onclick="event.preventDefault();">
                      장편소설<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="SF" onclick="event.preventDefault();">
                      SF<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                만화
                <i class="fa-solid fa-angle-down"></i>
                <ul class="third_cate">
                  <li>
                    <a href="#" title="유아" onclick="event.preventDefault();">
                      유아<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="학습" onclick="event.preventDefault();">
                      학습<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="해외" onclick="event.preventDefault();">
                      해외<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                수험서
                <i class="fa-solid fa-angle-down"></i>
                <ul class="third_cate">
                  <li>
                    <a href="#" title="자격증" onclick="event.preventDefault();">
                      자격증<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="공무원" onclick="event.preventDefault();">
                      공무원<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" title="수능" onclick="event.preventDefault();">
                      수능<i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" title="고객지원 바로가기">고객지원</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- 상단헤더서식 -->
    <header class='index_header'>
      <!-- 헤더 위쪽 아우터 -->
      <div class="header_outer_top">
        <!-- 헤더 위쪽 이너 -->
        <div class="header_inner_top">
          <!-- 상단로고 -->
          <h1 class="h_logo">
            <a href="../index.php" title="메인페이지로 바로가기">
              <img src="../images/logo/logo.png" alt="상단로고">
            </a>
          </h1>
          <!-- 상단 검색바 -->
          <div class="h_search_box">
            <input type="search" id="h_search" placeholder='오늘의 책을 찾아보세요'>
            <span class="sr-only">검색</span>
            <label for="h_search"><i class="fas fa-search h_search"></i></label>
          </div>
          <!-- 상단 우측 내비게이션 (고객지원, 장바구니, 로그인) -->
          <ul class="h_right_nav">
            <!-- 고객지원 -->
            <li>
              <a href="#" title='고객지원'>
                <i class="fa-solid fa-headset"></i>
                <p class='h_nav_txt'>고객지원</p>
              </a>
            </li>
            <!-- 장바구니 -->
            <li>
              <a href="cart.php?title=장바구니" title='장바구니'>
                <i class="fa-solid fa-cart-shopping"></i>
                <p class='h_nav_txt'>장바구니</p>
                <span class='h_cart_howmany'><?php echo $cart_total; ?></span>
              </a>
            </li>
            <!-- 로그인 -->
            <li>
              <a href="../db/login/<?php echo $log_href; ?>" title="<?php echo $log_nav; ?>">
                <i class="<?= $log_icon ?>"></i>
                <p class='h_nav_txt'><?php echo $log_nav; ?></p>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- 헤더 아래쪽 아우터 -->
      <div class="header_outer_bottom">
        <div class="header_inner_bottom">
          <!-- 토글 버튼 -->
          <div class="toggle_btn">
            <label for="toggle_btn">
              <i class="fa-solid fa-bars"></i>
            </label>
          </div>

          <!-- 헤더 아래쪽 메뉴 내비 -->
          <ul class="header_bottom_nav">
            <li>
              <a href="product_list.php?title=상품전체페이지" title="베스트">
                베스트
              </a>
            </li>
            <li>
              <a href="recommend.php" title="추천">
                추천
              </a>
            </li>
            <li>
              <a href="gift.php" title="문구/기프트">
                문구/기프트
              </a>
            </li>

          </ul>
        </div>
      </div>

      <!-- 스크롤시 나오는 헤더 pc버전 -->
      <div class="header_scroll">
        <!-- 헤더 위쪽 이너 -->
        <div class="header_scroll_top">
          <!-- 토글 버튼 -->
          <div class="toggle_btn">
            <label for="toggle_btn">
              <i class="fa-solid fa-bars"></i>
            </label>
          </div>
          <!-- 상단로고 -->
          <h1 class="h_logo">
            <a href="../index.php" title="메인페이지로 바로가기">
              <img src="../images/logo/logo.png" alt="상단로고" >
            </a>
          </h1>
          
          <!-- 상단 검색바 -->
          <div class="h_search_box">
            <input type="search" id="h_search2" placeholder='오늘의 책을 찾아보세요'>
            <label for="h_search2"><i class="fas fa-search h_search"></i>
            <span class="sr-only">검색</span>
          </label>
          </div>
          <!-- 상단 우측 내비게이션 (고객지원, 장바구니, 로그인) -->
          <ul class="h_right_nav mb_nav">
            <!-- 고객지원 -->
            <li>
              <a href="#" title='고객지원'>
                <i class="fa-solid fa-headset"></i>
                <p class='h_nav_txt'>고객지원</p>
              </a>
            </li>
            <!-- 장바구니 -->
            <li>
              <a href="cart.php?title=장바구니" title='장바구니'>
                <i class="fa-solid fa-cart-shopping"></i>
                <p class='h_nav_txt'>장바구니</p>
                <span class='h_cart_howmany'><?php echo $cart_total; ?></span>
              </a>
            </li>
            <!-- 로그인 -->
            <li>
              <?php if(!isset($_SESSION['mb_id'])){ ?>
              <a href="../db/login/login.php" title='로그인'>
                <i class="<?= $log_icon ?>"></i>
                <p class='h_nav_txt'>로그인</p>
              </a>
              <?php }else{ ?>
              <a href="../db/login/logout.php" title='로그아웃'>
                <i class="<?= $log_icon ?>"></i>
                <p class='h_nav_txt'>로그아웃</p>
              </a>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </header>