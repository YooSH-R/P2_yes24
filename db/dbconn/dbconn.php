<?php


  // db연결을 위한 정보
  $mysql_host = getenv('DB_HOST') ?: 'localhost';
  $mysql_user = getenv('DB_USER');
  $mysql_password = getenv('DB_PASSWORD');
  $mysql_db = getenv('DB_NAME') ?: 'kdt';

  // 웹 서버 환경에서 DB 계정과 비밀번호를 설정합니다.
  if ($mysql_user === false || $mysql_user === '' || $mysql_password === false) {
    http_response_code(500);
    exit('DB 연결 설정을 확인해 주세요.');
  }


  // conn변수 설정
  $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
  
  // db연결 오류시 스크립트 종료
  if(!$conn){
    die('연결종료 : '.mysqli_connect_error());
  }


  // php오류메세지 숨김
  ini_set('display_errors', 'Off');


  // db연결이 정상적이면 session시작함
  session_start();


?>
