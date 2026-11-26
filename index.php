<?php
  // 세션정보 확인
  include('./db/dbconn/dbconn.php');
  
  // 카트 개수 변수
  $cart_total = 0;

  // 세션 아이디가 있을경우
  if(isset($_SESSION['mb_id'])){    //세션 아이디가 있으면
    $userid = $_SESSION['mb_id'];   // 변수에 세션 id저장
    $name = $_SESSION['mb_name'];   // 변수에 세션 name을 저장
    $log_nav = '로그아웃'; 
    $log_href = 'logout.php';
    $log_icon = 'fa-solid fa-arrow-right-from-bracket';
    $sql = "SELECT COUNT(*) AS total FROM temp24 WHERE mb_id = '$userid'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $cart_total = (int)$row['total'];
    }
  }else{
    $userid = '';                   // id 없음
    $name = '';                     // 닉네임 없음
    $log_nav = '로그인';
    $log_href = 'login.php';
    $log_icon = 'fa-solid fa-user';
  }

  // 제목 변수 값이 없으면 기본값은 메인페이지
  $yes24_title = $_GET['title'] ?? '메인페이지';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 메타 태그 -->
  <meta name="description" content="YES24">
  <meta name="keywords" content="책, 온라인서점, 문화공간">
  <meta name="author" content="Upgrade³">
  <meta name="og:title" content="<?= $yes24_title ?>">
  <!-- 제목 -->
  <title>2차 프로젝트 YES24리뉴얼 - <?= $yes24_title; ?></title>
  <!-- 파비콘 -->
  <link rel="icon" href="./images/favi/favicon.ico" type="image/x-icon">
  <!-- 폰트 어썸 서식 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
  <!-- 슬라이드 서식 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <!-- 초기화 -->
  <link href="./css/reset.css" rel="stylesheet" type="text/css">
  <!-- 공통서식 -->
  <link href="./css/common.css" rel="stylesheet" type="text/css">
  <!-- 레이아웃 서식 -->
  <link href="./css/layout.css" rel="stylesheet" type="text/css">
  <!-- 메인 서식 -->
  <link href="./css/main.css" rel="stylesheet" type="text/css">


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
  <!-- 모바일 헤더에 들어갈 로그인,로그아웃 변수, 카트 개수변수 -->
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
          if(!$userid){
            
          ?>
          <a href="./db/login/login.php" title="로그인하기">
            로그인하기
          </a>
        </span></p>
        <?php }else{ 
          echo $name;
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
          <a href="index.php" title="메인페이지로 바로가기">
            <img src="./images/logo/logo.png" alt="상단로고" fetchpriority="high">
          </a>
        </h1>
        <!-- 상단 검색바 -->
        <div class="h_search_box">
          <input type="search" id="h_search" placeholder='오늘의 책을 찾아보세요'>
          <label for="h_search">
            <span class="sr-only">검색</span>
            <i class="fas fa-search h_search">&nbsp;</i>
          </label>
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
            <a href="./sub/cart.php?title=장바구니" title='장바구니'>
              <i class="fa-solid fa-cart-shopping"></i>
              <p class='h_nav_txt'>장바구니</p>
              <span class='h_cart_howmany'><?php echo $cart_total; ?></span>
            </a>
          </li>
          <!-- 로그인 -->
          <li>
            <a href="./db/login/<?php echo $log_href; ?>" title="<?php echo $log_nav; ?>">
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
            <a href="./sub/product_list.php?title=전체페이지" title="베스트">
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
          <a href="index.php" title="메인페이지로 바로가기">
            <img src="./images/logo/logo.png" alt="상단로고" >
          </a>
        </h1>
        
        <!-- 상단 검색바 -->
        <div class="h_search_box">
          <input type="search" id="h_search2" placeholder='오늘의 책을 찾아보세요'>
          <label for="h_search2">
            <span class="sr-only">검색</span>
            <i class="fas fa-search h_search"></i>
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
            <a href="./sub/cart.php?title=장바구니" title='장바구니'>
              <i class="fa-solid fa-cart-shopping"></i>
              <p class='h_nav_txt'>장바구니</p>
              <span class='h_cart_howmany'><?php echo $cart_total; ?></span>
            </a>
          </li>
          <!-- 로그인 -->
          <li>
            <?php if(!isset($_SESSION['mb_id'])){ ?>
            <a href="./db/login/login.php" title='로그인'>
              <i class="<?= $log_icon ?>"></i>
              <p class='h_nav_txt'>로그인</p>
            </a>
            <?php }else{ ?>
            <a href="./db/login/logout.php" title='로그아웃'>
              <i class="<?= $log_icon ?>"></i>
              <p class='h_nav_txt'>로그아웃</p>
            </a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <!-- 메인콘텐츠영역 -->
  <main>
    <!-- 1. 메인슬라이드 -->
    <section id="main_slide">
      <h2 class="t_none">메인슬라이드</h2>

      <!-- 왼쪽 컨텐츠 -->
      <!-- 메인슬라이드배너 -->
      <article class="main_slide">
        <h3 class="t_none">메인슬라이드배너</h3>
        <div class="swiper main_slide_swiper">
          <div class="swiper-wrapper">
            <!-- 슬라이드 콘텐츠 -->
            <div class="swiper-slide">
              <a href="#" title="디즈니" onclick="event.preventDefault();">
                <img src="./images/items/main_banner1.jpg" alt="메인슬라이드1" fetchpriority="high">
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" title="쓰고빙고" onclick="event.preventDefault();">
                <img src="./images/items/main_banner2.jpg" alt="메인슬라이드2" loading="lazy">
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" title="무적LG펀딩" onclick="event.preventDefault();">
                <img src="./images/items/main_banner3.jpg" alt="메인슬라이드3" loading="lazy">
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" title="EBS교재" onclick="event.preventDefault();">
                <img src="./images/items/main_banner4.jpg" alt="메인슬라이드4" loading="lazy">
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" title="세계와 지리" onclick="event.preventDefault();">
                <img src="./images/items/main_banner5.jpg" alt="메인슬라이드5" loading="lazy">
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" title="블랙프라이데이" onclick="event.preventDefault();">
                <img src="./images/items/main_banner6.jpg" alt="메인슬라이드6" loading="lazy">
              </a>
            </div>
          </div>
          <!-- 화살표 -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </article>

      <!-- 오른쪽 컨텐츠 -->
      <div class="ms_right">
        <!-- 오른쪽 광고 슬라이드 -->
        <article class="ad_slide">
          <h3 class="t_none">광고슬라이드</h3>
          <div class="swiper ad_slide_swiper">
            <div class="swiper-wrapper">
              <!-- 슬라이드 콘텐츠 -->
              <div class="swiper-slide">
                <a href="#" title="마이히어로북" onclick="event.preventDefault();">
                  <img src="./images/items/side_banner1.jpg" alt="광고 슬라이드1">
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" title="세상의 모든 교양" onclick="event.preventDefault();">
                  <img src="./images/items/side_banner2.jpg" alt="광고 슬라이드2" loading="lazy">
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" title="디즈니 노트" onclick="event.preventDefault();">
                  <img src="./images/items/side_banner3.jpg" alt="광고 슬라이드3" loading="lazy">
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" title="블랙프라이데이" onclick="event.preventDefault();">
                  <img src="./images/items/side_banner4.jpg" alt="광고 슬라이드4" loading="lazy">
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" title="어린이, 지금 이 책.." onclick="event.preventDefault();">
                  <img src="./images/items/side_banner5.jpg" alt="광고 슬라이드5" loading="lazy">
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" title="크리스마스" onclick="event.preventDefault();">
                  <img src="./images/items/side_banner6.jpg" alt="광고 슬라이드6" loading="lazy">
                </a>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </article>

        <!-- 오른쪽 내비게이션 -->
        <article class="main_nav">
          <h3 class="t_none">오른쪽 내비</h3>
          <ul class='m_main_nav'>
            <li><a href='./sub/product_list.php' title='베스트'>베스트</a></li>
            <li><a href='#' title='추천' onclick="event.preventDefault();">추천</a></li>
            <li><a href='#' title='문구' onclick="event.preventDefault();">문구</a></li>
          </ul>


          <nav>
            <ul class="main_nav_cont">
              <li>
                <a href="#" title="혜택보기 바로가기" onclick="event.preventDefault();">
                  <div>
                    <img src="./images/items/main_icon1.png" alt="혜택보기 이미지" />
                  </div>
                  <p>혜택보기</p>
                </a>
              </li>

              <li>
                <a href="#" title="이벤트 바로가기" onclick="event.preventDefault();">
                  <div>
                    <img src="./images/items/main_icon2.png" alt="이벤트 이미지" />
                  </div>
                  <p>이벤트</p>
                </a>
              </li>

              <li>
                <a href="#" title="클래스24 바로가기" onclick="event.preventDefault();">
                  <div>
                    <img src="./images/items/main_icon3.png" alt="클래스24 이미지" />
                  </div>
                  <p>클래스24</p>
                </a>
              </li>

              <li>
                <a href="#" title="예스펀딩 바로가기" onclick="event.preventDefault();">
                  <div>
                    <img src="./images/items/main_icon4.png" alt="예스펀딩 이미지" />
                  </div>
                  <p>예스펀딩</p>
                </a>
              </li>
            </ul>
          </nav>
        </article>
      </div>
    </section>


    <!-- 2. 베스트 셀러 -->   
    <section id="best_seller">
      <h2 class="title">베스트 셀러</h2>
      <div class="best">
        <!-- 목록 (탭) -->
        <ul class="best_tab_menu" role=tablist>
          <li class="best_tab active" aria-controls="best_panel1" id="best_tab1" role="tab"  aria-selected="true">종합</li>
          <li class="best_tab" aria-controls="best_panel2" id="best_tab2" role="tab"  aria-selected="false">소설</li>
          <li class="best_tab" aria-controls="best_panel3" id="best_tab3" role="tab"  aria-selected="false">만화</li>
          <li class="best_tab" aria-controls="best_panel4" id="best_tab4" role="tab"  aria-selected="false">시/에세이</li>
          <li class="best_tab" aria-controls="best_panel5" id="best_tab5" role="tab"  aria-selected="false">인문</li>
          <li class="best_tab" aria-controls="best_panel6" id="best_tab6" role="tab"  aria-selected="false">경영/경제</li>
        </ul>

        <!-- 제품 -->
        <div class="best_item">
          <!-- 제품 넣기 -->
          <?php
            $sql = "SELECT * FROM product24 WHERE prd_category='BEST'";
            $result = mysqli_query($conn, $sql);
          ?>
          <!-- 패널1 (종합) -->
          <div class="best_panel best_active" id="best_panel1" aria-labelledby="best_tab1" role="tabpanel">
            <div class="swiper best-swiper" data-best="1">
              <div class="swiper-wrapper">
              <!-- 컨텐츠 반복문 -->
              <?php while($row = mysqli_fetch_assoc($result)){  ?>
                <div class="swiper-slide">
                  <a href="./sub/product_detail.php?no=<?= $row['prd_no']; ?>&title=상세페이지" title="<?= $row['prd_name']?>">
                    <img src="./images/items/<?= $row['prd_picture']; ?>" alt="베스트<?= $row['prd_no']?>">
                    <span class="b_rank top3"><?= $row['prd_no']?></span>
                    <!-- 가격 제목 -->
                    <p class="b_title"><?= $row['prd_name']?></p>
                    <p class="b_price"><?= NUMBER_FORMAT($row['prd_price']) ?>원</p>
                  </a>
                </div>
              <?php } ?>
                <div class="swiper-slide">
                  <a href="#" title="절창" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best5.jpg" alt="베스트5">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">절창</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="박공희 연금부자수업" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best6.jpg" alt="베스트6">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">박공희 연금부자수업</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="어른의 행복은 조용하다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best7.jpg" alt="베스트7">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">어른의 행복은 조용하다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="단 한 줄만 내 마음에 새긴다고 해도" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best8.jpg" alt="베스트8">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">단 한 줄만 내 마음에 새긴다고 해도</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>

          <!-- 패널2 (소설) -->
          <div class="best_panel" id="best_panel2" aria-labelledby="best_tab2" role="tabpanel" hidden>
            <div class="swiper best-swiper" data-best="2">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="절창" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel1.jpg" alt="소설1" loading="lazy">
                    <span class="b_rank top3">1</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">절창</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="단 한 줄만 내 마음에 새긴다고 해도" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel2.jpg" alt="소설2" loading="lazy">
                    <span class="b_rank top3">2</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">단 한 줄만 내 마음에 새긴다고 해도</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="혼모노" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel3.jpg" alt="소설3" loading="lazy">
                    <span class="b_rank top3">3</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">혼모노</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="모순" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel4.jpg" alt="소설4" loading="lazy">
                    <span class="b_rank">4</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">모순</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="소년이 온다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel5.jpg" alt="소설5" loading="lazy">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">소년이 온다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="자몽 살구 클럽" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel6.jpg" alt="소설6" loading="lazy">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">자몽 살구 클럽</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="스토너" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel7.jpg" alt="소설7" loading="lazy">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">스토너</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="어스탐 경의 임사전언" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel8.jpg" alt="소설8" loading="lazy">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">어스탐 경의 임사전언</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>

          <!-- 패널3 (만화) -->
          <div class="best_panel" id="best_panel3" aria-labelledby="best_tab3" role="tabpanel" hidden>
            <div class="swiper best-swiper" data-best="3">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="봇치더락" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics1.jpg" alt="만화1" loading="lazy">
                    <span class="b_rank top3">1</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">봇치더락</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="도쿄 에일리언즈1" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics2.jpg" alt="만화2" loading="lazy">
                    <span class="b_rank top3">2</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">도쿄 에일리언즈1</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="도쿄 에일리언즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics3.jpg" alt="만화3" loading="lazy">
                    <span class="b_rank top3">3</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">도쿄 에일리언즈2</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="카쿠라바치" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics4.jpg" alt="만화4">
                    <span class="b_rank">4</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">카쿠라바치</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="팬텀 버스터즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics5.jpg" alt="만화5" loading="lazy">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">팬텀 버스터즈</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="사카모토홀리데이즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics6.jpg" alt="만화6" loading="lazy">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">사카모토홀리데이즈</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="비스크돌은 사랑을 한다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics7.jpg" alt="만화7" loading="lazy">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">비스크돌은 사랑을 한다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="원피스" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics8.jpg" alt="만화8" loading="lazy">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">원피스</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>

          <!-- 패널4 (종합) -->
          <div class="best_panel" id="best_panel4" aria-labelledby="best_tab4" role="tabpanel" hidden>
            <div class="swiper best-swiper" data-best="4">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="트랜드 코리아2026" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best1.jpg" alt="베스트1" loading="lazy">
                    <span class="b_rank top3">1</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">트랜드 코리아2026</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="달리기를 말할 때 내가 하고 싶은 이야기" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best2.jpg" alt="베스트2" loading="lazy">
                    <span class="b_rank top3">2</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">달리기를 말할 때 내가 하고 싶은 이야기</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="위버멘쉬" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best3.jpg" alt="베스트3" loading="lazy">
                    <span class="b_rank top3">3</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">위버멘쉬</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="대형주 추세추종 투자법칙" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best4.jpg" alt="베스트4" loading="lazy">
                    <span class="b_rank">4</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">대형주 추세추종 투자법칙</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="절창" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best5.jpg" alt="베스트5" loading="lazy">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">절창</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="박공희 연금부자수업" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best6.jpg" alt="베스트6" loading="lazy">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">박공희 연금부자수업</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="어른의 행복은 조용하다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best7.jpg" alt="베스트7" loading="lazy">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">어른의 행복은 조용하다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="단 한 줄만 내 마음에 새긴다고 해도" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_best8.jpg" alt="베스트8" loading="lazy">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">단 한 줄만 내 마음에 새긴다고 해도</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>

          <!-- 패널5 (소설) -->
          <div class="best_panel" id="best_panel5" aria-labelledby="best_tab5" role="tabpanel" hidden>
            <div class="swiper best-swiper" data-best="5">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="절창" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel1.jpg" alt="소설1" loading="lazy">
                    <span class="b_rank top3">1</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">절창</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="단 한 줄만 내 마음에 새긴다고 해도" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel2.jpg" alt="소설2" loading="lazy">
                    <span class="b_rank top3">2</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">단 한 줄만 내 마음에 새긴다고 해도</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="혼모노" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel3.jpg" alt="소설3" loading="lazy">
                    <span class="b_rank top3">3</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">혼모노</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="모순" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel4.jpg" alt="소설4" loading="lazy">
                    <span class="b_rank">4</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">모순</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="소년이 온다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel5.jpg" alt="소설5" loading="lazy">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">소년이 온다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="자몽 살구 클럽" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel6.jpg" alt="소설6" loading="lazy">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">자몽 살구 클럽</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="스토너" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel7.jpg" alt="소설7" loading="lazy">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">스토너</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="어스탐 경의 임사전언" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_novel8.jpg" alt="소설8" loading="lazy">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">어스탐 경의 임사전언</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>

          <!-- 패널6(만화) -->
          <div class="best_panel" id="best_panel6" aria-labelledby="best_tab6" role="tabpanel" hidden>
            <div class="swiper best-swiper" data-best="6">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="봇치더락" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics1.jpg" alt="만화1" loading="lazy">
                    <span class="b_rank top3">1</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">봇치더락</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="도쿄 에일리언즈1" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics2.jpg" alt="만화2" loading="lazy">
                    <span class="b_rank top3">2</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">도쿄 에일리언즈1</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="도쿄 에일리언즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics3.jpg" alt="만화3" loading="lazy">
                    <span class="b_rank top3">3</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">도쿄 에일리언즈2</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="카쿠라바치" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics4.jpg" alt="만화4" loading="lazy">
                    <span class="b_rank">4</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">카쿠라바치</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="팬텀 버스터즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics5.jpg" alt="만화5" loading="lazy">
                    <span class="b_rank">5</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">팬텀 버스터즈</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="사카모토홀리데이즈" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics6.jpg" alt="만화6" loading="lazy">
                    <span class="b_rank">6</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">사카모토홀리데이즈</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="비스크돌은 사랑을 한다" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics7.jpg" alt="만화7" loading="lazy">
                    <span class="b_rank">7</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">비스크돌은 사랑을 한다</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="원피스" onclick="event.preventDefault();">
                    <img src="./images/items/yes24_product_comics8.jpg" alt="만화8" loading="lazy">
                    <span class="b_rank">8</span>
                    <!-- 가격 제목 -->
                    <p class="b_title">원피스</p>
                    <p class="b_price">10,000원</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="best_nav">
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>

      </div>

      <!-- 더보기 버튼 -->
      <div class="add_btn">
        <a href="./sub/product_list.php?title=전체페이지" title="베스트 셀러 더보기">
          더보기
        </a>
      </div>

    </section>


    <!-- 3. 화재의 책 -->
    <section id="trending-books">
      <!-- 설명글 -->
      <div class='slide-info-top'>
        <p id="slideCaption"></p>
      </div>

      <div class="customSwiper-container">
        <h2 class="title">화제의 책</h2>
        <div class="swiper customSwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide" data-title="지금 가장 뜨거운 이야기" data-price="15,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic1.jpg" alt="화제의 책1" />
              </a>
            </div>

            <div class="swiper-slide" data-title="한 번 읽으면 멈출 수 없어" data-price="16,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic2.jpg" alt="화제의 책2" />
              </a>
            </div>

            <div class="swiper-slide" data-title="모두가 주목한 그 책" data-price="11,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic3.jpg" alt="화제의 책3" />
              </a>
            </div>

            <div class="swiper-slide" data-title="읽을수록 깊어지는 감동" data-price="12,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic4.jpg" alt="화제의 책4" />
              </a>
            </div>

            <div class="swiper-slide" data-title="요즘 가장 많이 찾는 책" data-price="19,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic5.jpg" alt="화제의 책5" />
              </a>
            </div>

            <div class="swiper-slide" data-title="당신의 시선을 바꿀 한 권" data-price="20,900원">
              <a href='#' title='' onclick="event.preventDefault();">
                <img src="./images/items/yes24_product_topic6.jpg" alt="화제의 책6" />
              </a>
            </div>
          </div>


        </div>
        <!-- 화살표 -->
        <div class="swiper-button-prev custom-prev"></div>
        <div class="swiper-button-next custom-next"></div>
      </div>

      <!-- 가격 영역 -->
      <div class="slide-info-bottom">
        <p id="slidePrice"></p>
      </div>

      <!-- 더보기 버튼 -->
      <div class="add_btn">
        <a href="./sub/product_list.php" title="베스트 셀러 더보기">
          더보기
        </a>
      </div>
    </section>

    <!-- 4. 인기티켓 -->
    <section id="tickets">
      <h2 class="title">인기 티켓</h2>
      <div class="tick_inner">
        <!-- 컨텐츠1 -->
        <div class="tick_cont">
          <a href="#" title="인기티켓1 바로가기" onclick="event.preventDefault();">
            <img src="./images/items/yes24_ticket1.jpg" alt="티켓1" id="rand_img1">
          </a>
        </div>
        <!-- 컨텐츠2 -->
        <div class="tick_cont">
          <a href="#" title="인기티켓1 바로가기" onclick="event.preventDefault();">
            <img src="./images/items/yes24_ticket2.jpg" alt="티켓2" id="rand_img2">
          </a>
        </div>
      </div>
      <!-- 더보기 버튼 -->
      <div class="add_btn">
        <a href="#" title="베스트 셀러 더보기" onclick="event.preventDefault();">
          더보기
        </a>
      </div>
    </section>

    <!-- 광고 -->
    <a href="#" title="광고" onclick="event.preventDefault();" class='wide_b_outer'>
      <article class="wide_banner">
        <h2 class="t_none">광고</h2>
        <div class="wb_bg">
          <img src="./images/items/wide_banner_bg.jpg" alt="광고배경">
        </div>
        <p class="wb_cont">
          <img src="./images/items/wide_banner1.png" alt="광고컨텐츠">
        </p>
      </article>
    </a>

    <!-- 5. 문구 -->
    <section id="goods">
      <h2 class="title">문구</h2>
      <div class="swiper goods-swiper">
        <div class="swiper-wrapper">
          <!-- 같은 구조 8개 -->
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift1.jpg" alt="노르잇 투명독서대 높이조절 PR01A"></div>
              <p class="goods_title">노르잇 투명독서대 높이조절 PR01A</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift2.jpg" alt="모나미 라이브칼라 60색 세트"></div>
              <p class="goods_title">모나미 라이브칼라 60색 세트</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift3.jpg" alt="핑크풋 1000냥냥이수정테이프"></div>
              <p class="goods_title">핑크풋 1000냥냥이수정테이프</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift4.jpg" alt="야옹이 실리콘 코스터 컵받침 5종"></div>
              <p class="goods_title">야옹이 실리콘 코스터 컵받침 5종</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift5.jpg" alt="크림 2단 화이트 독서대"></div>
              <p class="goods_title">크림 2단 화이트 독서대</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift6.jpg" alt="비비드 인덱스 마그네틱 북마크"></div>
              <p class="goods_title">비비드 인덱스 마그네틱 북마크</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift7.jpg" alt="엘리트 스프링 유선노트"></div>
              <p class="goods_title">엘리트 스프링 유선노트</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" onclick="event.preventDefault();">
              <div><img src="./images/items/yes24_product_gift8.jpg" alt="2026년 이야기다이어리 펜 스티커 세트"></div>
              <p class="goods_title">2026년 이야기다이어리 펜 스티커 세트</p>
              <p class="goods_price">10,000원</p>
            </a>
          </div>
        </div>
      </div>
      <div class="goods_btn">
        <div class="swiper-button-next goods-next"></div>
        <div class="swiper-button-prev goods-prev"></div>
      </div>
      <!-- 더보기 버튼 -->
      <div class="add_btn">
        <a href="#" title="베스트 셀러 더보기" onclick="event.preventDefault();">
          더보기
        </a>
      </div>
    </section>
  </main>

  
  <!-- 탑버튼 -->
  <div class='top_btn'>
    <a href='#' title='상단으로 바로가기'>
      <i class="fa-solid fa-angle-up"></i>
    </a>
  </div>

  <!-- 하단푸터영역 -->
  <footer>
    <!-- 푸터 위쪽 -->
    <div class="footer_outer_top">
      <div class="footer_inner_top">
        <!-- 푸터 내비 -->
        <nav class="footer_nav">
          <ul>
            <li><a href="#" title='이용약관'>이용약관</a></li>
            <li><a href="#" title='개인정보처리방침' class="f_nav_bold">개인정보처리방침</a></li>
            <li><a href="#" title='청소년보호정책'>청소년보호정책</a></li>
            <li><a href="#" title='회사소개'>회사소개</a></li>
            <li><a href="#" title='광고안내'>광고안내</a></li>
            <li><a href="#" title='제휴안내'>제휴안내</a></li>
            <li><a href="#" title='매장안내'>매장안내</a></li>
          </ul>
        </nav>

        <!-- 패밀리 사이트 -->
        <label for="familySite" class='sr-only'>카테고리 선택</label>
        <select id="familySite">
          <option value="">FamilySite</option>
          <option value="https://www.hansaeyes24.com/">한세예스24홀딩스</option>
          <option value="https://www.hansae.com/">한세실업</option>
          <option value="http://www.hansaedreams.co.kr/">한세드림</option>
          <option value="https://www.bookdonga.com/main.donga">동아출판</option>
        </select>
      </div>
    </div>

    <!-- 푸터 아래쪽 -->
    <div class="footer_outer_bottom">
      <div class="footer_inner_bottom">
        <!-- 푸터 아래 왼쪽 -->
        <div class="footer_inner_left">
          <!-- 하단 로고 -->
          <div class="footer_logo">
            <a href="index.php" title="메인페이지로 바로가기">
              <img src="./images/logo/f_logo.png" alt="하단 로고">
            </a>
          </div>
          <!-- 어드레스 -->
          <address>
            <ul>
              <li>대표 : 홍길동, 아무개</li>
              <li>주소 : &#9675;&#9675;시 &#9675;&#9675;구 &#9675;&#9675;로 &#9675;&#9675;, &#9675;층~&#9675;층 (&#9675;&#9675;동, &#9675;&#9675;빌딩)</li>
              <li>사업자등록번호 : 000-00-00000</li>
              <li>통신판매업신고 : 제 0000-00000호 사업자 확인</li>
              <li>이메일 :  &#9675;&#9675;@email.com</li>
              <li>호스팅 서비스사업자 : &#9675;&#9675;(주)</li>
            </ul>
          </address>

          <p class="copyright">Copyright &copy; YES24 Corp. ALL Rights Reserved.</p>

        </div>
        <!-- 푸터 아래 오른쪽 -->
        <div class="footer_inner_right">
          <!-- 푸터 sns -->
          <div class="f_sns_box">
            <ul>
              <li><a href="https://pf.kakao.com/_yxkZjR" title='카카오톡 채널'><img src="./images/sns_logo/footer_kakao.png" alt="카카오톡 이미지"></a></li>
              <li><a href="https://www.instagram.com/yes24_official/" title='인스타그램 바로가기'><img src="./images/sns_logo/footer_insta.png" alt="인스타그램 이미지"></a></li>
              <li><a href="https://www.facebook.com/yes24/" title='페이스북 바로가기'><img src="./images/sns_logo/footer_facebook.png" alt="페이스북 이미지"></a></li>
            </ul>
          </div>
          <!-- 푸터 고객문의 -->
          <div class="f_help_box">
            <h3>고객문의</h3>
            <div class="f_help">
              <dl>
                <dt>도서/음반: </dt>
                <dd>0000-0000</dd>
              </dl>

              <dl>
                <dt>중고도서: </dt>
                <dd>0000-0000</dd>
              </dl>

              <dl>
                <dt>티켓예메: </dt>
                <dd>0000-0000</dd>
              </dl>
              <!-- 1:1상품문의 -->
              <dl>
                <dt class="chat_help"><a href="#" title="1:1문의/채팅상담">1:1문의/채팅상담 &gt;</a></dt>
                <dd>&nbsp;</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- 스크립트 cdn -->

  <!-- 스와이퍼 슬라이드 -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- 제이쿼리 -->
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <!-- 메인 스크립트 -->
  <script src="./script/main.js"></script>

  <!-- 스크립트 내용 -->
  <script>
    // 스와이퍼 슬라이드
    // 메인 슬라이드
    var swiper = new Swiper(".main_slide_swiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      loop: true,
      autoplay: {
        delay:3000,
        disableOnInteraction: false
      },
    });


    //메인 광고 슬라이드
    var swiper = new Swiper(".ad_slide_swiper", {
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      loop: true,
      autoplay: {
        delay:3000,
        disableOnInteraction: false
      },
    });

    // 베스트 셀러 슬라이드
    document.querySelectorAll('.best-swiper').forEach(swiperEl => {
      const panel = swiperEl.closest('.best_panel');
      const next  = panel.querySelector('.swiper-button-next');
      const prev  = panel.querySelector('.swiper-button-prev');

      // 화면 크기에 따라 설정 만들어주는 함수
      const getConfig = () => {
        if (window.innerWidth < 768) {
          // 모바일: 2줄 × 2개
          return {
            slidesPerView: 2,
            grid: {
              rows: 2,
              fill: 'row'
            },
            spaceBetween: 20,
            navigation: {
              nextEl: next,
              prevEl: prev,
            },
          };
        } else {
          // PC: 1줄 × 4개
          return {
            slidesPerView: 4,
            grid: {
              rows: 1,
              fill: 'row'
            },
            spaceBetween: 87,
            navigation: {
              nextEl: next,
              prevEl: prev,
            },
          };
        }
      };

      // 처음 한 번 생성
      let swiper = new Swiper(swiperEl, getConfig());

      // 현재 상태(모바일인지 PC인지) 기억
      let isMobile = window.innerWidth < 768;

      // 브라우저 크기 바뀔 때마다 체크
      window.addEventListener('resize', () => {
        const nowMobile = window.innerWidth < 768;

        // 모바일 ↔ PC 경계(768px)를 넘었을 때만 재생성
        if (nowMobile !== isMobile) {
          isMobile = nowMobile;
          swiper.destroy(true, true);        // 기존 인스턴스 제거
          swiper = new Swiper(swiperEl, getConfig()); // 새로 생성
        }
      });
    });

    // 문구 슬라이드
    var goodsSwiper = new Swiper(".goods-swiper", {
      slidesPerView: 2,
      spaceBetween: 16,
      grid: {
        rows: 2,
        fill: "row",
      },
      navigation: {
        nextEl: ".goods-next",
        prevEl: ".goods-prev",
      },
      breakpoints: {
        768: {
          slidesPerView: 4,
          spaceBetween: 30,
          grid: {
            rows: 1
          }
        }
      }
    });


    //화재의 책 슬라이드 및 설명, 가격 표시
    document.addEventListener('DOMContentLoaded', function () {
      // Swiper 초기화
      const fireswiper = new Swiper(".customSwiper", {
        slidesPerView: 5,         // 기본값(PC)
        centeredSlides: false,
        spaceBetween: 30,
        loop: true,
        navigation: {
          nextEl: ".custom-next",
          prevEl: ".custom-prev",
        },

        on: {
          init(swiper) {
            // 초기 로드 시 화면 크기에 맞게 슬라이드 개수 맞추고 스케일 적용
            handleResponsiveSlides(swiper);
          },
          slideChange(swiper) {
            // 슬라이드 변경될 때마다 가운데 슬라이드 강조
            applyScale(swiper);
          }
        }
      });

      // 🔥 창 크기 바뀔 때마다 실시간으로 3/5개 전환
      window.addEventListener('resize', function () {
        handleResponsiveSlides(fireswiper);
      });

      // ✅ 현재 화면에 맞게 slidesPerView를 3 또는 5로 맞춰주는 함수
      function handleResponsiveSlides(swiper) {
        const isMobile = window.innerWidth < 768;
        const targetPerView = isMobile ? 3 : 5;

        // 값이 달라질 때만 업데이트
        if (swiper.params.slidesPerView !== targetPerView) {
          swiper.params.slidesPerView = targetPerView;
          swiper.update();       // Swiper에게 "설정 바뀌었어" 알려주기
        }

        applyScale(swiper);      // 슬라이드 개수가 바뀌었으니 가운데 강조 다시 계산
      }

      // ✅ 현재 slidesPerView 구하기 (swiper 설정에서 바로 읽기)
      function getSlidesPerView(swiper) {
        let perView = swiper.params.slidesPerView;

        if (typeof perView !== "number") {
          perView = 5; // 혹시 이상하면 기본값
        }
        return perView;
      }

      // ✅ 가운데 슬라이드 크게, 양옆은 축소 + blur 처리
      function applyScale(swiper) {
        const perView = getSlidesPerView(swiper);      // PC면 5, 모바일이면 3
        const offsetCenter = Math.floor(perView / 2);  // 5→2, 3→1
        let centerIndex = swiper.activeIndex + offsetCenter;
        const maxIndex = swiper.slides.length - 1;

        if (centerIndex > maxIndex) centerIndex = maxIndex;

        let centerSlide = null; // 나중에 텍스트 뽑으려고 저장

        swiper.slides.forEach((slide, i) => {
          slide.classList.remove("blur");

          const diff = Math.abs(i - centerIndex);

          if (diff === 0) {
            // 가운데 슬라이드
            slide.style.transform = "scale(1)";
            slide.style.filter = "blur(0)";
            slide.style.opacity = "1";
            centerSlide = slide;
          } else if (diff === 1) {
            // 바로 옆
            slide.style.transform = "scale(0.8)";
            slide.classList.add("blur");
            slide.style.opacity = "0.8";
          } else {
            // 그 밖의 슬라이드
            slide.style.transform = "scale(0.6)";
            slide.classList.add("blur");
            slide.style.opacity = "0.6";
          }
        });

        // 가운데 슬라이드의 텍스트/가격 갱신
        updateText(centerSlide);
      }

      // ✅ 가운데 슬라이드의 data-title, data-price → 하단 텍스트로
      function updateText(centerSlide) {
        const captionEl = document.getElementById("slideCaption");
        const priceEl   = document.getElementById("slidePrice");

        if (!captionEl || !priceEl) return; // 요소 없으면 그냥 종료

        // 기본값(보이지 않게)
        captionEl.textContent = "";
        priceEl.textContent = "";
        captionEl.classList.remove("has-text");
        priceEl.classList.remove("has-text");

        if (!centerSlide) return;

        const title = centerSlide.dataset.title || "";
        const price = centerSlide.dataset.price || "";

        if (title) {
          captionEl.textContent = title;
          captionEl.classList.add("has-text");
        }
        if (price) {
          priceEl.textContent = price;
          priceEl.classList.add("has-text");
        }
      }
    });

    // 패밀리 사이트 이동
    document.getElementById('familySite').addEventListener('change', function(){
      const url = this.value;
      if(url){
        window.location.href = url;
      }
    });


    // 탑버튼 제이쿼리
    $(function () {

      function onScrollHandler() {
        const $topBtn = $('.top_btn');
        const scrollTop_m = $(window).scrollTop();     // 현재 스크롤 위치
        const windowHeight_m = $(window).height();     // 화면 높이
        const windowWidth = $(window).width();         // 화면 가로 길이
        const $footer = $('footer');

        // ✅ 화면 크기에 따라 기본 bottom 값 결정 (SCSS @media(max-width: 767px)와 동일 기준)
        const baseBottom = (windowWidth <= 767) ? 70 : 100;

        // 1) 200px 이상 스크롤 시 노출 / 미노출
        if (scrollTop_m > 200) {
          $topBtn.fadeIn(200);
        } else {
          $topBtn.fadeOut(200);
        }

        // 2) footer와 겹치는지 체크해서 위치 조정
        if ($footer.length) { // footer가 있을 때만
          const footerTop = $footer.offset().top;                 // footer의 문서 기준 top
          const windowBottom = scrollTop_m + windowHeight_m;      // 화면의 바닥 위치

          // ✅ 화면 바닥이 footer의 top과 닿았거나 아래로 내려간 경우
          if (windowBottom >= footerTop) {
            // 버튼을 footer top 기준으로 baseBottom px 위에 고정되도록 bottom 계산
            const newBottom = windowBottom - footerTop + baseBottom;
            $topBtn.css('bottom', newBottom + 'px');
          } else {
            // ✅ footer와 겹치지 않을 때: 그냥 화면 기준으로 따라다님
            $topBtn.css('bottom', baseBottom + 'px');
          }
        } else {
          // footer가 아예 없는 페이지라면 그냥 기본 위치만 적용
          $topBtn.css('bottom', baseBottom + 'px');
        }
      }

      // 스크롤할 때마다 실행
      $(window).on('scroll', onScrollHandler);

      // 화면 크기 바뀔 때도 즉시 재계산
      $(window).on('resize', onScrollHandler);

      // 새로고침했을 때도 바로 판단
      onScrollHandler();

      // TOP 버튼 클릭 시 위로 부드럽게 이동
      $('.top_btn').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 400);
      });
    });




    // 제이쿼리
    // 스크롤시 헤더(검색바) 고정
    $(document).ready(function(){
      $(window).on('scroll', function(){
        if($(window).scrollTop() > 150){  // 150px 이상 내려가면
          $('.header_scroll').css('display','block');
        }else{
          $('.header_scroll').css('display','none');
        }
        let barHeight = $('.mb_header_outer_bottom').outerHeight();
        if($(window).scrollTop() > 65){
          $('.mb_header_outer_bottom').css('position','fixed');
          $('.mb_header_outer_bottom_placeholder').css('height', barHeight);
        }else{
          $('.mb_header_outer_bottom').css('position','relative');
          $('.mb_header_outer_bottom_placeholder').css('height', 0);
        }
      });
    });
  </script>
</body>
</html>