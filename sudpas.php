<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login_sudpas.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>삼육대학교 기부 플랫폼 관리자 사이트</title>
    <link rel="stylesheet" href="style_sudpas.css">
  </head>
  <body>
    <div class="mainContainer">
      메인 콘테이너
    </div>
  </body>
</html>
