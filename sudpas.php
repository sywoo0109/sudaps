<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login_sudpas.php");
    exit();
}

echo "Welcome, " . $_SESSION["id"] . "!";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>삼육대학교 기부 플랫폼 관리자 사이트</title>
  </head>
  <body>
  </body>
</html>
