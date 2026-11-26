<?php
  include '../dbconn/dbconn.php';

  $mb_id = $_SESSION['mb_id'];

  $sql_fin = "DELETE FROM temp24 WHERE checked = 1 AND mb_id = '$mb_id';";
  $result_fin = mysqli_query($conn, $sql_fin);


  print "
  <script>
    alert('결제 완료되었습니다. 메인페이지로 이동합니다.');
    location.replace('../../index.php?title=메인페이지');
  </script>";
  mysqli_close($conn);
  exit;
?>