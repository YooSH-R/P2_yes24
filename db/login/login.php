<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');
  

  // 2. 쿠키에서 저장된 아이디 가져오기
  $saved_id = isset($_COOKIE['saved_id']) ? $_COOKIE['saved_id'] : '';

?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <!-- 파비콘 -->
  <link rel="icon" href="../../images/favi/favicon.ico" type="image/x-icon">
  <!-- 부트스트랩 서식 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">

  <style>
    /* 초기화 */
    body{font-size:14px; font-family:'Nanum Gothic', sans-serif;}
    a{color:#333; text-decoration:none;}
    
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

    /* 버튼 서식 */
    .login_btn{background:#0080ff; color:#fff;}

    /* 입력창/checkbox 클릭시 테두리 파란색 그림자 안나오게 */
    .form-control, .form-check-input{box-shadow: none !important;}

    /* 로그인 회원가입 테두리 */
    form > div:first-of-type > input{
      border-radius:8px 8px 0 0 ;
    }
    form > div:nth-of-type(2) > input{
      border-radius:0 0 8px 8px !important;
    }

    /* 간편로그인 양옆에 선 만들기 */
    form > div:nth-of-type(5){
      border-bottom:1px solid #ccc;
      display:flex;
      justify-content:center;
    }

    /* 아이디, 비번 찾기, 회원가입 서식 */
    form > div:nth-of-type(5) a{
      font-size:12px;
      padding:0 clamp(10px, 1.953vw, 20px);
      border-right:1px solid #ccc;
    }
    form > div:nth-of-type(5) a:hover{
      text-decoration:underline;
    }

    /* 회원가입 오른쪽에는 구분선없애기 */
    form > div:nth-of-type(5) a:last-child{
      border:none;
    }
    
    /* 간편로그인 글자 서식 */
    form > div:nth-of-type(6) > p{
      background:#fff;
      width:140px;
      margin:0 auto;
      transform:translateY(-12px);
    }

    /* sns 로고 */
    form > div:nth-of-type(7) > a > img{width:45px;}

    /* 푸터 서식 */
    footer a, footer p{
      font-size:12px !important;
    }


  </style>
</head>
<body>
  <main>
    <!-- 로그인폼 감싸는 컨테이너 -->
    <div class="container">
      <div><a href="../../index.php" title="메인페이지로 가기"><img src="./img/logo.png" alt="로고"></a></div>
      <form name="login" method="post" action="login_check.php" onsubmit="return form_check();">
  
        <div class="form-floating mt-5">
          <input type="text" name="mb_id" id="mb_id" class="form-control" placeholder="ID : " value="<?php echo htmlspecialchars($saved_id) ?>">
          <label for="mb_id">*ID : </label>
        </div>
  
        <div class="form-floating">
          <input type="password" name="mb_password" id="mb_password" class="form-control mb-3" placeholder="PW : ">
          <label for="mb_password">*PW : </label>
        </div>
  
        <div>
          <input type="checkbox" name="save_id" id="save_id" class="form-check-input me-2" value="save" <?php echo $saved_id ? 'checked' : '' ?>>
          <label for="save_id" class="form-check-label" style="transform:translateY(1px) !important;">아이디 저장</label>
        </div>
  
        <div>
          <input type="submit" class="login_btn btn btn-primary w-100 my-3" value="로그인">
        </div>
  
        <div class="pb-5">
          <a href="#">아이디 찾기</a>
          <a href="#">비밀번호 찾기</a>
          <a href="register.php">회원가입</a>
        </div>
  
        <div class="">
          <p class="text-center">간편로그인</p>
        </div>
        
        <div class="text-center my-3">
          <a href="#" onclick="loginWithKakao();"><img src="./img/kakao_logo.png" alt="카카오 로그인"></a>
          <a href="#" class="mx-5"><img src="./img/naver_logo.png" alt="네이버 로그인"></a>
          <a href="#"><img src="./img/google_logo.png" alt="구글 로그인"></a>
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
    
  <!-- 카카오 로그인 api -->
  <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
  <!-- 제이쿼리 라이브러리 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
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
    }
    // <!-- 카카오 로그인을 위한 자바스크립트 인증키 실행함수 -->
    Kakao.init("f5ba898d567672483cfd05b4dad9321c");

    //로그인 함수
    function loginWithKakao(){
      Kakao.Auth.authorize({
        redirectUri: "https://rexsung.dothome.co.kr/yes24/db/login/login.php",
      });
    }
  </script>
</body>
</html>