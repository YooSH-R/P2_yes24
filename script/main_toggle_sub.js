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

// 결제하기 // 모바일 버전
$(document).ready(function () {
  // 모바일 결제 박스
  const $mBox   = $('.m_payment_box');
  const $toggle = $('.m_payment_box .m_result i.fa-solid');

  // 초기 상태: 접혀 있고 아이콘은 ↑ (지금 HTML이 이미 up이라면 그대로 둬도 됨)
  // $mBox.removeClass('open'); // 필요하면 명시적으로 닫힌 상태로

  $toggle.on('click', function () {
    $mBox.toggleClass('open');

    if ($mBox.hasClass('open')) {
      // 펼쳐진 상태 → 아이콘은 down
      $(this)
        .removeClass('fa-angle-up')
        .addClass('fa-angle-down');
    } else {
      // 접힌 상태 → 아이콘은 up
      $(this)
        .removeClass('fa-angle-down')
        .addClass('fa-angle-up');
    }
  });
});