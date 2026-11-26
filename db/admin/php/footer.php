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
            <a href="../../index.php" title="메인페이지로 바로가기">
              <img src="../../images/logo/f_logo.png" alt="하단 로고">
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
              <li><a href="https://pf.kakao.com/_yxkZjR" title='카카오톡 채널'><img src="../../images/sns_logo/footer_kakao.png" alt="카카오톡 이미지"></a></li>
              <li><a href="https://www.instagram.com/yes24_official/" title='인스타그램 바로가기'><img src="../../images/sns_logo/footer_insta.png" alt="인스타그램 이미지"></a></li>
              <li><a href="https://www.facebook.com/yes24/" title='페이스북 바로가기'><img src="../../images/sns_logo/footer_facebook.png" alt="페이스북 이미지"></a></li>
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
    //탑버튼 제이쿼리
    $(function(){
      // 스크롤 시 보여주기/숨기기
      function toggleTopBtn() {
        if($(window).scrollTop() > 200){
          $('.top_btn').fadeIn(200);   // 빠르게 나타남
        }else{
          $('.top_btn').fadeOut(200);  // 빠르게 사라짐
        }
      }

      // 스크롤 이벤트에 함수 연결
      $(window).on('scroll', toggleTopBtn);

      // ⭐ 새로고침 했을 때도 즉시 판단하게 실행
      toggleTopBtn();

      // TOP 버튼 클릭 시 부드럽게 올라가기
      $('.top_btn').on('click', function(e){
        e.preventDefault();
        
        $('html, body').animate({
          scrollTop: 0
        }, 400);  // 스크롤 올라가는 속도(0.4초)
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
