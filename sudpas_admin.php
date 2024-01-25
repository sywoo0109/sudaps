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
            <div class="sideBarContainer" id="sideBar">
                <a href="sudpas.php" class="logoLink">
                    <img src="./img/logo_black.png" class="logo"></img>
                </a>
                <div class="adminMenuContainer">
                    <div class="adminProfileContainer">
                        <div class="profileImage">
                            <img id="dummyImage">
                        </div>
                        <div class="adminName"><?php echo $_SESSION["id"]?></div>
                        <div class="dropdownButton" id="dropdownButton">&#9660;</div>
                    </div>
                    <div
                        class="adminDropdownContainer"
                        id="adminDropdownContainer"
                        style="display: none">
                        <a href="sudpas_admin.php">
                            <div>관리자 관리</div>
                        </a>
                        <a href="process_logout.php">
                            <div>로그아웃</div>
                        </a>
                    </div>
                </div>
                <div class="menuContainer">
                    <a href="sudpas.php">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <span>기부현황</span>
                    </a>
                    <a href="sudpas_media.php">
                        <i class="fa-solid fa-sliders"></i>
                        <span>미디어 관리</span>
                    </a>
                    <a href="sudpas_method.php">
                        <i class="fa-solid fa-ruler"></i>
                        <span>기부수단 관리</span>
                    </a>
                    <a href="sudpas_amount.php">
                        <i class="fa-solid fa-money-bill"></i>
                        <span>기부금액 관리</span>
                    </a>
                    <a href="sudpas_announcement.php">
                        <i class="fa-solid fa-check"></i>
                        <span>공지사항 관리</span>
                    </a>
                </div>
            </div>
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
                                        <button disabled>정보 수정</button>
                                    </td>
                                </tr>
                                <?php require 'lib/userTable.php'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
    </body>
</html>