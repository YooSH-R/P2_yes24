<?php
include_once '../dbconn/dbconn.php';
 // 배송지 등록
    $userid = $_SESSION['mb_id'];

    $modal_address = trim($_POST['modal_address']);
    $modal_detail = trim($_POST['modal_detail']);
    
    $address = $modal_address . ' ' . $modal_detail;
    $sql = "UPDATE member24 SET mb_address='$address' WHERE mb_id='$userid'";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>alert('주소가 등록되었습니다.');</script>";
        echo "<script>location.replace('../../sub/payment.php')</script>";
    }else{
        echo "오류 발생: " . mysqli_error($conn);
    }
?>