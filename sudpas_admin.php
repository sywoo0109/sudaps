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
        <script type="module" src="sudpas_admin.js" defer="defer"></script>
    </head>
    <body>
        <div class="topBar"></div>
        <div class="mainContainer">
            <div class="sideBarContainer">
                <img src="./img/logo_black.png" class="logo"></img>
                <div class="adminMenuContainer">
                    <div class="adminProfileContainer">
                        <div class="profileImage">
                            <img src="https://github.com/identicons/sywoo0109.png">
                        </div>
                        <div class="adminName"><?php echo $_SESSION["id"]?></div>
                        <div class="dropdownButton">&#9660;</div>
                    </div>
                    <div class="adminDropdownContainer">
                        <div>관리자 관리</div>
                        <div>로그 아웃</div>
                    </div>
                </div>
                <div class="menuContainer">
                    <div>
                        <div>아이콘</div>기부현황</div>
                    <div>
                        <div>아이콘</div>미디어 관리</div>
                    <div>
                        <div>아이콘</div>기부수단 관리</div>
                    <div>
                        <div>아이콘</div>기부금액 관리</div>
                    <div>
                        <div>아이콘</div>공지사항 관리</div>
                </div>
            </div>
            <div class="contentContainer">
                <div class="menuBar"></div>
                <div></div>
            </div>
        </div>
        <div class="bottomBar"></div>
    </body>
</html>