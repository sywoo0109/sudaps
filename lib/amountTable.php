<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, amount_id, amount, activated FROM donation_amount";

$result = $conn->query($sql);

$list = '';
if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    while ($row = mysqli_fetch_array($result)) {
            $amount = number_format($row['amount']);
            $list .= "<tr>
            <td>{$row['name']}</td>
            <td>
            <div class='amountInputContainer'>";
            $list .= ($row['activated'] === "1") ? "<input id={$row['amount_id']} value='{$amount}원'></input>" : "<input id={$row['amount_id']} value='미사용중'></input>";
            $list .= "<div id={$row['amount_id']}Save>저장</div>
            <div id={$row['amount_id']}Deactivate>사용안함</div>
            </div>
            </td>
            </tr>
            ";
        } 
    }

echo $list;

$conn->close();
?>