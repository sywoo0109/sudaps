<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT method, method_id, activated FROM donation_method";

$result = $conn->query($sql);

$list = '';
if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    while ($row = mysqli_fetch_array($result)) {
            $list .= "<tr>
            <td>{$row['method']}</td>";
            $list .= ($row['activated'] === "1") ? "<td class='activated' id={$row['method_id']}>활성화</td> </tr>" : "<td class='deactivated' id={$row['method_id']}>비활성화</td> </tr>";
        } 
    }

echo $list;

$conn->close();
?>