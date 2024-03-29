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
        <link rel="stylesheet" href="style_sudpas_media.css">
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
                    <div>미디어 관리</div>
                </div>
                <div class="mediaContainer">
                    <div class="mediaSettingContainer">
                        <div class="settingButton" id="homeSetting">홈 화면 설정</div>
                        <div class="settingButton">기부하기 설정</div>
                        <div class="settingButton">기부방법 설정</div>
                        <div class="settingButton">기부처 안내 설정</div>
                        <div class="settingButton">기부현황 / 문의처 설정</div>
                    </div>
                    <div class="frontContainer"></div>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
        <div id="popup">
            <p>팝업창 내용</p>
            <button id="closeBtn">닫기</button>
        </div>
        <script type="module" src="sudpas_media.js" defer="defer"></script>
    </body>
</html>