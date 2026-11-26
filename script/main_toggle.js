const mb_h = `
  <header class="mb_index_header">
    <!-- 헤더 위 -->
    <div class='mb_header_outer_top'>
      <div class='mb_header_inner_top'>
        <div class="mb_toggle_btn">
          <label for="toggle_btn">
            <i class="fa-solid fa-bars"></i>
          </label>
        </div>
        <ul class="mb_h_right_nav">
          <li>
            <a href="#" title='고객지원'>
              <i class="fa-solid fa-headset"></i>
            </a>
          </li>
          <li>
            <a href="cart.php" title='장바구니?title=장바구니'>
              <i class="fa-solid fa-cart-shopping"></i>
              <span class='mb_h_cart_howmany'>${cart_total}</span>
            </a>
          </li>
          <li>
            <a href="../db/login/${logHref}" title="${logNav}">
              <i class="${log_icon}"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="mb_header_outer_bottom_placeholder"></div>

    <div class="mb_header_outer_bottom">
      <div class="mb_h_search_box">
        <input type="search" id="mb_h_search" placeholder='오늘의 책을 찾아보세요'>
        <label for="mb_h_search">
        <i class="fas fa-search h_search"></i>
        <span class="sr-only">검색</span>
        </label>
        <h1 class="mb_h_logo">
          <a href="../index.php" title="메인페이지로 바로가기">
            <img src="../images/logo/m_logo.png" alt="상단로고">
          </a>
        </h1>
      </div>
    </div>
  </header>
`;

const mqMobile = window.matchMedia('(max-width: 767px)');

function handleMobileHeader(e) {
  if (e.matches) {
    // 767px 이하 → 모바일 헤더 추가 / PC 헤더 숨김
    if (!$('.mb_index_header').length) {
      $('body').prepend(mb_h);
    }
    $('.index_header').css('display', 'none');

  } else {
    // 768px 이상 → PC 헤더 보임 / 모바일 헤더 제거
    $('.index_header').css('display', 'block');
    $('.mb_index_header').remove();
  }
}

// 최초 실행
handleMobileHeader(mqMobile);
// 화면 크기 변할 때마다 실행
mqMobile.addEventListener('change', handleMobileHeader);









//   토글 메뉴
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
$(document).ready(function () {

    $('.second_cate > li').click(function (e) {
      e.stopPropagation();
  
      const $li    = $(this);
      const myMenu = $li.children('.third_cate');
      const myIcon = $li.children('i');
      const isOpen = myMenu.is(':visible'); // 🔥 지금 열려 있는지 체크
  
      if (isOpen) {
        // 🔻 이미 열려있는 li를 다시 클릭 → 닫기 + 스타일 초기화
        myMenu.slideUp(300);
        $li.css('background', 'transparent');
        myIcon.removeClass('fa-angle-up').addClass('fa-angle-down');
      } else {
        // 🔻 새로운 li를 여는 경우
  
        // 1) 다른 li들의 스타일 & 아이콘 초기화
        $('.second_cate > li').not($li).css('background', 'transparent');
        $('.second_cate > li > i')
          .not(myIcon)
          .removeClass('fa-angle-up')
          .addClass('fa-angle-down');
  
        // 2) 다른 third_cate 전부 닫기
        $('.third_cate').not(myMenu).slideUp(300);
  
        // 3) 현재 li 활성화
        $li.css('background', '#fff');
        myIcon.removeClass('fa-angle-down').addClass('fa-angle-up');
        myMenu.slideDown(300);
      }
    });
  
  });

//  토글클릭시 X클릭시
$(document).ready(function () {
    const $toggleChk   = $('#toggle_btn');
    const $toggleOuter = $('.toggle_outer');
    const $toggleInner = $('.toggle_inner');
    const $closeIcon   = $('.toggle_title .fa-x');
  
    // 배경 클릭 시 닫기
    $toggleOuter.on('click', function () {
      $toggleChk.prop('checked', false);
    });
  
    // 메뉴 안쪽 클릭 시는 닫히지 않게
    $toggleInner.on('click', function (e) {
      e.stopPropagation();
    });
  
    // X 버튼 클릭 시 닫기
    $closeIcon.on('click', function () {
      $toggleChk.prop('checked', false);
    });
  });