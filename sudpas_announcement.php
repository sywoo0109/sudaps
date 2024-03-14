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
        <link rel="stylesheet" href="style_sudpas_announcement.css">
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
                    <div>공지사항 관리</div>
                </div>
                <div class="announcementContainer">
                    <div class="announcementMenuContainer">
                        <div>공지사항 관리입니다.</div>
                        <div class="createButton" id="createButton">공지사항 작성</div>
                    </div>
                    <div class="announcementTableContainer">
                        <table border="1" class="announcementTable">
                            <thead>
                                <tr>
                                    <th>공지사항 제목</th>
                                    <th>수정</th>
                                    <th>삭제</th>
                                    <th>활성화</th>
                                </tr>
                            </thead>
                            <tbody id="dataContainer">
                                <?php require "lib/announcementTable.php" ?>
                            </tbody>
                        </table>
                    </div>
                    <?php require "lib/pagination.php" ?>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
        <div id="popupContainer">
            <div id="popup">
                <div class="popupInst">공지사항 작성</div>
                <div class="inputContainer">
                    <div>
                        <label for="title">공지사항 제목:</label>
                        <input type="text" id="title" placeholder="공지제목은 30자까지 입력 가능합니다.">
                    </div>
                    <div class="textareaContainer">
                        <label for="content">공지내용 입력:</label>
                        <textarea id="content" rows="10" placeholder="공지내용은 500자까지 입력 가능합니다."></textarea>
                    </div>
                </div>
                <div class="buttonContainer">
                    <div class="saveButton" id="saveButton">저장</div>
                    <div class="closeButton" id="closeButton">닫기</div>
                </div>
            </div>
        </div>
        <script type="module" src="sudpas_announcement.js" defer="defer"></script>
    </body>
</html>