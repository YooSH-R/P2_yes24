<?php

  // db연결을 위한 정보
  $mysql_host = 'localhost';
  $mysql_user = 'root';
  $mysql_password = '1234';
  $mysql_db = 'kdt';

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