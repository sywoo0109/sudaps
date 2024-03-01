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
        <link rel="stylesheet" href="style_sudpas_admin.css">
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
                    <div>관리자 관리</div>
                </div>
                <div>
                    <div class="adminActionContainer">
                        <div class="info">관리자로 등록된 사용자 목록입니다.</div>
                        <a href="sudpas_admin_group.php">
                            <button>관리자 그룹 만들기</button>
                        </a>
                        <a href="sudpas_admin_create.php">
                            <button>새 관리자 만들기</button>
                        </a>
                    </div>
                    <div class="userTableContainer">
                        <table border="1" class="userTable">
                            <thead>
                                <tr>
                                    <th>아이디</th>
                                    <th>이름 / 그룹명</th>
                                    <th>상태</th>
                                    <th>수정</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>admin</td>
                                    <td>관리자 / master group</td>
                                    <td>활성화</td>
                                    <td>
                                        <button disabled="disabled">정보 수정</button>
                                    </td>
                                </tr>
                                <?php require 'lib/userTable.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="inputWindowContainer">
                        <div class="inputWindowContainerName">관리자 그룹 만들기</div>
                        <div class="inputContainer">
                            <div class="inputItem">
                                <div class="inputLabel">그룹명</div>
                                <input type="text" id="groupName" class="groupNameInput"></input>
                                <div class="inputError" id="groupNameError">그룹명은 최대 10자까지 등록 가능합니다.</div>
                            </div>
                        </div>
                        <div class="buttonContainer">
                            <button id="applyButton">적용</button>
                            <a href="sudpas_admin.php">
                                <button id="cancleButton">취소</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
        <script type="module" src="sudpas_admin_group.js" defer="defer"></script>
    </body>
</html>