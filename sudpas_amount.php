<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: sudpas_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>삼육대학교 기부 플랫폼 관리자 사이트</title>
        <link rel="stylesheet" href="style_sudpas.css">
        <link rel="stylesheet" href="style_sudpas_amount.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script type="module" src="sudpas.js" defer="defer"></script>
    </head>
    <body>
        <div class="topBar"></div>
        <div class="mainContainer">
            <?php require "lib/sidebar.php" ?>
            <div class="contentContainer">
                <div class="menuBar">
                    <div id="sideBarButton">
                        <i class="fa-solid fa-bars fa-2xl sideBarHamburger"></i>
                    </div>
                    <div>기부금액 관리</div>
                </div>
                <div class="amountContainer">
                    <table border="1" class="amountTable">
                        <thead>
                            <tr>
                                <th>기부액</th>
                                <th>금액입력</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php require "lib/amountTable.php" ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
        <div id="popup">
            <div class="instruction" id="popupInst"></div>
            <div class="buttonContainer">
                <div id="confirm">확인</div>
                <div id="cancle">취소</div>
            </div>
        </div>
        <script type="module" src="sudpas_amount.js" defer="defer"></script>
    </body>
</html>