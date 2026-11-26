<?php

  // cart_insert.php

  include_once '../../db/dbconn/dbconn.php';

  // 필수 입력값 체크
  if(!isset($_POST['no']) || !isset($_POST['quantity'])){
    exit('잘못된 접근입니다.');
  }

  $prd_no = intval($_POST['no']); // 번호를 정수형으로 캐스팅하여 보안 강화
  $quan = intval($_POST['quantity']); // 수량을 정수형으로 변환하여 저장

  $mb_id = $_SESSION['mb_id'];

  // 클릭한 상품정보를 조회하기 위해 쿼리문 작성
  $sql = "SELECT * FROM product24 WHERE prd_no='$prd_no'";
  $result = mysqli_query($conn, $sql);

  // 상품이 존재하지 않는 경우
  if(!$row = mysqli_fetch_assoc($result)){
    mysqli_close($conn);
    exit('상품을 찾을 수 없습니다.');
  }

  // 데이터베이스에서 상품 정보 가져오기
  $prd_name = $row['prd_name'];
  $prd_author = $row['prd_author'];
  $prd_price = $row['prd_price'];
  $prd_picture = $row['prd_picture'];
  $money = $quan * $prd_price;

  // 이미 같은 상품이 장바구니에 있는지 확인
  $sql_check = "SELECT * FROM temp24 WHERE mb_id='$mb_id' AND prd_name = '$prd_name'";
  $result_check = mysqli_query($conn, $sql_check);

  if(mysqli_num_rows($result_check) > 0){ // 이미 담겨있다면
    $old = mysqli_fetch_assoc($result_check);
    $new_count = $old['count'] + $quan;
    $new_money = $old['money'] + $money;

    // 수정
    $sql_update = "
      UPDATE temp24
      SET count = '$new_count', money = '$new_money' WHERE mb_id = '$mb_id' AND prd_name ='$prd_name' 
    ";

    // 쿼리문 실행
    mysqli_query($conn, $sql_update);
    }else{
      // 담겨있지 않을 시
      // 입력
      $sql = "INSERT INTO temp24(prd_no, prd_name, prd_author, count, prd_price, money, prd_picture, mb_id) VALUES('$prd_no', '$prd_name', '$prd_author', '$quan', '$prd_price', '$money', '$prd_picture','$mb_id')";
      
      // 쿼리문 실행
      mysqli_query($conn, $sql);
    }

      // 쿼리문 종료
      mysqli_close($conn);

  // 장바구니 페이지로 이동
  // echo "<script>location.replace('../sub/cart.php');</script>";

?>