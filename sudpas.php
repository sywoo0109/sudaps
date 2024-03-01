<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: sudpas_login.php");
    exit();
}

if (isset($_GET['year'])) {
    $yearValue = $_GET['year'];
} else {
    $yearValue = "2024"; 
}

if (isset($_GET['method'])) {
    $methodYearValue = $_GET['method'];
} else {
    $methodYearValue = "2024"; 
}

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUM(amount) AS total_amount FROM donation;";

$result = $conn->query($sql);

$row = mysqli_fetch_array($result);
$total = $row['total_amount'];

$sql = "SELECT DISTINCT YEAR(date) AS year FROM donation ORDER BY Year DESC;";

$result = $conn->query($sql);

$list = '<option>연도 선택</option>';
$methodList = '<option>연도 선택</option>';
while ($row = mysqli_fetch_array($result)) {
    if($yearValue === $row['year']) {
        $list .= "<option value={$row['year']} selected>{$row['year']}</option>";

        if($methodYearValue === $row['year']) {
            $methodList .= "<option value={$row['year']} selected>{$row['year']}</option>";
        } else {
            $methodList .= "<option value={$row['year']}>{$row['year']}</option>";
        }
    } else {
        $list .= "<option value={$row['year']}>{$row['year']}</option>";

        if($methodYearValue === $row['year']) {
            $methodList .= "<option value={$row['year']} selected>{$row['year']}</option>";
        } else {
            $methodList .= "<option value={$row['year']}>{$row['year']}</option>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>삼육대학교 기부 플랫폼 관리자 사이트</title>
        <link rel="stylesheet" href="style_sudpas.css">
        <link rel="stylesheet" href="style_sudpas_donation.css">
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
                    <div>기부현황</div>
                </div>
                <div>
                    <div class="totalDonationContainer">총 기부액 :
                        <?php echo number_format($total) ?>
                        원
                    </div>
                    <div class="monthlyContainer">
                        <div class="monthlyMenuContainer">
                            <div>월별 기부 현황</div>
                            <select class="year" id="monthlyChartYear">
                                <?php echo $list ?>
                            </select>
                        </div>
                        <div class="chartContainer">
                            <canvas class="monthylChart" id="myBarChart"></canvas>
                        </div>
                    </div>
                    <div class="methodDonorContainer">
                        <div class="methodContainer">
                            <div class="methodMenuContainer">
                                <div>기부수단 현황</div>
                                <select class="year" id="methodChartYear">
                                    <?php echo $methodList ?>
                                </select>
                            </div>
                            <canvas class="methodChart" id="myChart"></canvas>
                        </div>
                        <div class="donorContainer">
                            <div class="donorMenuContainer">
                                <div>기부자 현황 (최근 1달)</div>
                            </div>
                            <table class="donorTable">
                                    <thead>
                                        <tr>
                                            <th>날짜</th>
                                            <th>기부정보</th>
                                            <th>금액</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php require "lib/process_donor.php" ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomBar"></div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="lib/monthlyChart.js"></script>
        <script src="lib/methodChart.js"></script>
    </body>
</html>