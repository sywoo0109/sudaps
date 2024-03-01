<?php
echo
"<div class='sideBarContainer' id='sideBar'>
    <a href='sudpas.php' class='logoLink'>
        <img src='./img/logo_black.png' class='logo'></img>
    </a>
    <div class='adminMenuContainer'>
        <div class='adminProfileContainer'>
            <div class='profileImage'>
                <img id='dummyImage'>
            </div>
            <div class='adminName'>{$_SESSION['id']}</div>
            <div class='dropdownButton' id='dropdownButton'>&#9660;</div>
        </div>
        <div
            class='adminDropdownContainer'
            id='adminDropdownContainer'
            style='display: none'>
            <a href='sudpas_admin.php'>
                <div>관리자 관리</div>
            </a>
            <a href='process_logout.php'>
                <div>로그아웃</div>
            </a>
        </div>
    </div>
    <div class='menuContainer'>
        <a href='sudpas.php'>
            <i class='fa-solid fa-hand-holding-dollar'></i>
            <span>기부현황</span>
        </a>
        <a href='sudpas_media.php'>
            <i class='fa-solid fa-sliders'></i>
            <span>미디어 관리</span>
        </a>
        <a href='sudpas_method.php'>
            <i class='fa-solid fa-ruler'></i>
            <span>기부수단 관리</span>
        </a>
        <a href='sudpas_amount.php'>
            <i class='fa-solid fa-money-bill'></i>
            <span>기부금액 관리</span>
        </a>
        <a href='sudpas_announcement.php'>
            <i class='fa-solid fa-check'></i>
            <span>공지사항 관리</span>
        </a>
    </div>
</div>";
?>