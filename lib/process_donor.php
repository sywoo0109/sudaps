<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT amount, date, information FROM donation WHERE date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY date ASC LIMIT 8;";

$result = $conn->query($sql);

$list = '';

if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    while ($row = mysqli_fetch_array($result)) {
        $amount = number_format($row['amount']);
        $list .= "<tr>
        <td>{$row['date']}</td>
        <td>{$row['information']}</td>
        <td>{$amount}원</td>
        </tr>";
    }
}

echo $list;

$conn->close();
?>