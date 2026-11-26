  <!-- 탑버튼 -->
  <div class='top_btn'>
    <i class="fa-solid fa-angle-up"></i>
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
            <a href="../index.php" title="메인페이지로 바로가기">
              <img src="../images/logo/f_logo.png" alt="하단 로고">
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
              <li><a href="https://pf.kakao.com/_yxkZjR" title='카카오톡 채널'><img src="../images/sns_logo/footer_kakao.png" alt="카카오톡 이미지"></a></li>
              <li><a href="https://www.instagram.com/yes24_official/" title='인스타그램 바로가기'><img src="../images/sns_logo/footer_insta.png" alt="인스타그램 이미지"></a></li>
              <li><a href="https://www.facebook.com/yes24/" title='페이스북 바로가기'><img src="../images/sns_logo/footer_facebook.png" alt="페이스북 이미지"></a></li>
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

  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script>
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


        // 패밀리 사이트 이동
    document.getElementById('familySite').addEventListener('change', function(){
      const url = this.value;
      if(url){
        window.location.href = url;
      }
    });

    // 내일 날짜 삽입하기
    const date = new Date();
    date.setDate(date.getDate() + 1); // 내일로 설정
    const month = date.getMonth() + 1; // 월
    const day = date.getDate(); // 일
    const week = ['일','월','화','수','목','금','토'];
    const dayofWeek = week[date.getDay()]; // 요일

    // 모든 .tomorrow_day / .tomorrow_date 요소에 같은 값 넣기
    document.querySelectorAll('.tomorrow_day').forEach(el => {
      el.innerText = dayofWeek;
    });

    document.querySelectorAll('.tomorrow_date').forEach(el => {
      el.innerText = `${month}/${day}`;
    });
  </script>
