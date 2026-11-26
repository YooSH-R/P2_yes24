<?php

  // db연결을 위한 정보
  include('../dbconn/dbconn.php');

  // 입력한 값 받아서 변수 저장
  $prd_category = trim($_POST['prd_category']);
  $prd_name = trim($_POST['prd_name']);
  $prd_price = trim($_POST['prd_price']);
  
  $prd_author = trim($_POST['prd_author']);
  $prd_description = mysqli_real_escape_string($conn, $_POST['prd_description']);
  $author_description = mysqli_real_escape_string($conn, $_POST['author_description']);
  $book_index = mysqli_real_escape_string($conn, $_POST['book_index']);

  if($_FILES['prd_picture']['error']==4){
    $prd_picture = trim($_POST['prd_picture1']);
  }else{
    $prd_picture = trim($_FILES['prd_picture']['name']);
  }
  // $prd_picture = trim($_POST['prd_picture1']);
  // $prd_picture = trim($_FILES['prd_picture']['name']);
  // 상품등록여부 확인하는 쿼리문 작성
  $sql = "SELECT * FROM product24 WHERE prd_name = '$prd_name'";

  // 쿼리문 실행
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result)>0){ // 등록되어있을 경우
    
    // 상품 목록 수정 쿼리문
    $sql = "
      UPDATE product24 SET
      prd_category = '$prd_category',
      prd_price = '$prd_price',
      prd_picture = '$prd_picture',
      prd_author = '$prd_author',
      prd_description = '$prd_description',
      author_description = '$author_description',
      book_index = '$book_index'
      WHERE prd_name = '$prd_name';
    ";
    $mode = '상품 목록 수정';

    // 장바구니 수정 쿼리문
    $sql2 = "
      UPDATE temp24 SET
      prd_price = '$prd_price',
      prd_picture = '$prd_picture',
      prd_author = '$prd_author'
      WHERE prd_name = '$prd_name';
    ";

    // 장바구니 수정 쿼리문 실행
    mysqli_query($conn, $sql2);
  }else{
    // 상품 등록 쿼리문
    $sql = "
      INSERT INTO product24 SET
      prd_category = '$prd_category',
      prd_name = '$prd_name',
      prd_price = '$prd_price',
      prd_picture = '$prd_picture',
      prd_author = '$prd_author',
      prd_description = '$prd_description',
      author_description = '$author_description',
      book_index = '$book_index';
    ";
    $mode = '상품 등록';
  }
  
  // 이미지 업로드하기
  if($_POST['action']=='제출하기'){
    $uploaded_file_name_tmp = $_FILES['prd_picture']['tmp_name'];
    $upload_file_name = $_FILES['prd_picture']['name'];
    $upload_folder = './prd_images/';

    move_uploaded_file($uploaded_file_name_tmp, $upload_folder.$upload_file_name);
  }

  // 쿼리문 실행하기
  $result = mysqli_query($conn, $sql);

  // 세션정보에 저장
  $_SESSION['prd_name'] = $prd_name;


  // 상품 등록/수정 여부에 따라 메세지 띄운 후 상품목록 페이지로 들어가기
  if($result){
    echo "<script>alert('".$mode."이 완료되었습니다.')</script>";
    echo "<script>location.replace('admin_product_list.php')</script>";
  }else{
    echo "상품등록 실패 : ".mysqli_error($conn);
  }

?>