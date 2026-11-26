<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');

?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원가입</title>
  <!-- 파비콘 -->
  <link rel="icon" href="../../images/favi/favicon.ico" type="image/x-icon">

  <!-- 부트스트랩 서식 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- 폰트어썸 cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
  <style>
    /* 초기화 */
    body{font-size:14px; color:#333; font-family:'Nanum Gothic', sans-serif;}
    
  
    /* 컨테이너 서식 */
    .container{
      max-width:500px;
      width:95%;
      position:absolute; left:50%; top:50%;
      transform:translate(-50%, -50%);
    }
  
    /* 상단로고 */
    .container > div:first-of-type{text-align:center;}
    .container > div:first-of-type img:first-of-type{width:200px;}
  
    
    /* label태그 가리기 */
    label{display:none; font-size:14px;}
    
    /* input 크기, 테두리, 폰트크기 조절 */
    input{height:50px;}
    form > div:first-of-type > input:first-of-type{}
    form > div:nth-of-type(2) > input{border-radius:8px 8px 0 0;}
    form > div:nth-of-type(3) > input{border-radius:0 0 8px 8px;}
    form > div:nth-of-type(4) > input{border-radius:8px 8px 0 0;}
    form > div:nth-of-type(5) > input{border-radius:0;}
    form > div:nth-of-type(6) > input{border-radius:0 0 8px 8px;}
    form input::placeholder{font-size:14px;}
  
    /* 중복검사 위치 조절, 폰트크기 조절 */
    form > div:first-of-type{position:relative;}
    form > div:first-of-type > input:last-of-type{
      position:absolute;
      top:50%; right:10px;
      transform:translateY(-50%);
      font-size:12px;
      height:30px;
    }
  
    /* 입력창, checkbox 클릭시 테두리 파란색 그림자 안나오게 */
    .form-control, .form-check-input{box-shadow: none !important;}
  
    /* 버튼 서식 */
    .btn{background:#0080ff; color:#fff;}
    footer .btn{background:none; color:#333;}
  
    /* 정보제공동의 서식 */
    .terms{
      display: none;
      max-height: 200px; /* 높이 제한 */
      overflow-y: auto;  /* 내용이 많으면 스크롤 */
      padding: 10px;
      font-size:14px;
      color:#333;
      margin-top:10px;
    }
  
    /* 정보제공동의 더보기버튼 서식, 위치조절 */
    form > div:nth-of-type(7){
      position:relative;
    }
    i{
      cursor:pointer;
      position:absolute;
      top:20px; right:5%;
      
    }
  
    /* 푸터 서식 */
    footer a, footer p{
      font-size:13px !important;
    }
  </style>
</head>
<body>
  <main>
    <div class="container">
      <div><a href="../../index.php" title="메인페이지로 가기"><img src="./img/logo.png" alt="로고"></a></div>
      <form name="register" method="post" action="register_check.php" onsubmit="return form_check();">
        <div class="mt-5">
          <input type="text" name="mb_id" id="mb_id" class="form-control" placeholder="*ID : ">
          <label for="mb_id"></label>
          <input type="button" id="id_check_btn" class="btn btn-primary" value="중복확인">
        </div>
        <p id="check_print"></p>
  
        <div class="mt-4">
          <input type="password" name="mb_password" id="mb_password" class="form-control" placeholder="*PW : ">
          <label for="mb_password"></label>
        </div>
  
        <div>
          <input type="password" name="mb_password_re" id="mb_password_re" class="form-control" placeholder="*PW re : ">
          <label for="mb_password_re"></label>
        </div>
  
        <div class="mt-4">
          <input type="text" name="mb_name" id="mb_name" class="form-control" placeholder="*NAME : ">
          <label for="mb_name"></label>
        </div>
  
        <div>
          <input type="text" name="mb_phone" id="mb_phone" class="form-control" placeholder="*PHONE : '-' 없이 입력">
          <label for="mb_phone"></label>
        </div>
  
        <div>
          <input type="email" name="mb_email" id="mb_email" class="form-control" placeholder="*EMAIL : ">
          <label for="mb_email"></label>
        </div>
  
        <div class="mt-4 form-control py-3">
          <input type="checkbox" id="mb_agree" name="mb_agree" value="yes" class="form-check-input me-2">
          <label for="mb_agree" style="display:inline-block; transform:translateY(-1px) !important;">정보 제공 동의</label>
          <i class="fa-solid fa-angle-down"></i>
          <div class="terms"></div>
        </div>
  
        <div class="mt-4">
          <input type="submit" class="btn btn-primary w-100" value="회원가입">
        </div>
      </form>
      <footer class="mt-4">
          <div class="text-center">
          <a href="#" class="btn">이용약관</a>
          <a href="#" class="btn"><strong>개인정보처리방침</strong></a>
          <a href="#" class="btn">법적고지</a>
          <a href="#" class="btn">고객센터</a>
          <a href="#" class="btn">위치정보</a>
          </div>
  
          <div class="text-center mt-3">
            <p>Copyright &copy; YES24 Corp. All Rights Reserved.</p>
          </div>
        </footer>
    </div>
  </main>
  <!-- 제이쿼리 라이브러리 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
    // 중복검사
    let id_check_done = false;

    // 유효성 검사
    function form_check(){
      if(document.getElementById('mb_id').value==''){
        alert('아이디를 입력하십시오.');
        document.getElementById('mb_id').focus();
        return false;
      }
      if(document.getElementById('mb_password').value==''){
        alert('비밀번호를 입력하십시오.');
        document.getElementById('mb_password').focus();
        return false;
      }
      if(document.getElementById('mb_password_re').value==''){
        alert('비밀번호 확인문자를 입력하십시오.');
        document.getElementById('mb_password_re').focus();
        return false;
      }
      if(document.getElementById('mb_password').value!=document.getElementById('mb_password_re').value){
        alert('비밀번호가 일치하지 않습니다.');
        document.getElementById('mb_password_re').focus();
        return false;
      }
      if(document.getElementById('mb_name').value==''){
        alert('이름을 입력하십시오.');
        document.getElementById('mb_name').focus();
        return false;
      }
      if(document.getElementById('mb_phone').value==''){
        alert('휴대폰 번호를 입력하십시오.');
        document.getElementById('mb_phone').focus();
        return false;
      }
      if(document.getElementById('mb_email').value==''){
        alert('이메일을 입력하십시오.');
        document.getElementById('mb_email').focus();
        return false;
      }
      if(!document.getElementById('mb_agree').checked){
        alert('정보 제공에 동의해주십시오.');
        document.getElementById('mb_agree').focus();
        return false;
      }
      if(!id_check_done){
        alert('아이디 중복 확인을 해주세요.');
        return false;
      }
    }

    $(document).ready(function(){
      // 약관동의 내용
      const terms = `
        <p><strong>[필수] 서비스 이용약관 동의</strong><br><br>

        본 약관은 ○○쇼핑몰(이하 “회사”)이 제공하는 온라인 쇼핑 서비스 및 관련 제반 서비스(이하 “서비스”)의 이용과 관련하여 회사와 회원 간의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다.<br><br>

        회원은 회사가 정한 가입 절차에 따라 회원정보를 정확히 기재하고, 본 약관에 동의함으로써 서비스 이용 자격을 부여받습니다.<br><br>

        회원은 관련 법령 및 본 약관에서 정한 사항을 준수해야 하며, 타인의 정보를 도용하거나 부정한 방법으로 서비스 이용을 금합니다.<br><br>

        회사는 안정적인 서비스 제공을 위해 노력하며, 서비스 운영 정책에 따라 콘텐츠 및 기능을 변경하거나 중단할 수 있습니다.<br><br>

        회원은 상품 구매 시 결제 및 배송 등을 위해 필요한 개인정보를 제공해야 합니다.<br><br>

        회사는 회원이 서비스 이용과 관련하여 발생한 손해에 대해 관련 법령에서 정하는 범위 내에서 책임을 부담합니다.<br><br>

        회원은 언제든지 탈퇴를 요청할 수 있으며, 회사는 관련 법령에 따라 보관 의무가 있는 정보를 제외하고 즉시 회원 정보를 삭제합니다.<br><br>

        회원은 아래 체크박스를 선택함으로써 본 약관의 내용을 충분히 이해하고 이에 동의한 것으로 간주됩니다.</p>
      `;

      $('.terms').html(terms);

      // 약관동의 더보기 버튼 클릭시
      $('i').click(function(){
        // 내용 나타나기
        $('.terms').toggle();
        
        // 더보기 버튼 위, 아래 방향 바뀌기
        $(this).toggleClass('fa-angle-down fa-angle-up');
      })

      // 사용자가 중복확인 버튼 클릭시 입력한 id를 변수에 담는다.
      $('#id_check_btn').click(function(){
        let userId = $('#mb_id').val().trim(); // 입력한 id값을 변수에 담는다.
        
        // 아이디 입력하지 않았을 경우
        if(userId==''){
          alert('아이디를 입력하세요.');
          $('#mb_id').focus();
          return;
        }

        // 아이디 입력했을 경우 ajax요청하여 중복검사
        $.ajax({
          url:'../ajax/id_check.php',
          type:'POST',
          data:{mb_id:userId},
          success:function(response){
            // 통신선공시
            response = response.trim();
            if(response === 'ok'){
              $('#check_print').text('사용가능한 아이디입니다.').css({'color':'green'});
              id_check_done = true;
            }else{
              $('#check_print').text('사용중인 아이디입니다.').css({'color':'red'});
              id_check_done = false;
            }
          },
          // 통신오류시
          error:function(){
            alert('서버요청 실패, 다시 시도하세요.');
          }
        });
      });

      // 아이디 재입력시 다시 중복검사 필요
      $('#mb_id').on('input',function(){
        id_check_done = false;
      })
    })
    
  </script>
</body>
</html>