<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

$yearInputValue = mysqli_real_escape_string($conn, $_POST['yearInputValue']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT MONTH(date) AS month, SUM(amount) AS total_amount FROM donation WHERE YEAR(date) = {$yearInputValue} GROUP BY MONTH(date) ORDER BY MONTH(date)";
$result = $conn->query($sql);

$monthlyData = array_fill(1, 12, 0);

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    while($row = $result->fetch_assoc()) {
        $month = $row['month'];
        $totalAmount = $row['total_amount'];
        $monthlyData[$month] = $totalAmount;
    }
    $response = array("success" => true, "message" => $monthlyData);
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>