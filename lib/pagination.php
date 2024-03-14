<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS total_rows FROM announcement;";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$page = (int)ceil($row['total_rows'] / 12);

if (isset($_GET['page'])) {
    if(is_numeric($_GET['page']) && intval($_GET['page']) > 0 && intval($_GET['page']) <= $page) {
        $currentPage = intval($_GET['page']);
    } else {
        echo "<script>alert('올바르지 않은 페이지입니다.'); window.location.href = 'sudpas_announcement.php';</script>";
        exit();
    }
} else {
    $currentPage = 1;
}

if ($currentPage === 1) {
    $list = '<div class="pagination" id="pagination">';
} else {
    $list = '<div class="pagination" id="pagination"> <div class="pagingButton prevButton"><</div>';
}

for($i = 1; $i <= $page; $i++) {
    if ($currentPage === $i) {
        $list .= '<div class="pagingButton currentPage">'.$i.'</div>';
    } else {
        $list .= '<div class="pagingButton pageButton" page='.$i.'>'.$i.'</div>';
    }
}

if ($currentPage === $page) {
    $list .= '</div>';
} else {
    $list .= '<div class="pagingButton nextButton">></div> </div>';
}

echo $list;
?>