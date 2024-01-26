<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idpw.id, idpw.name, nickname, activated, group_name.name AS group_name FROM idpw LEFT JOIN group_name ON idpw.group_id = group_name.id;";

$result = $conn->query($sql);

$list = '';
if ($result === FALSE) {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
} else {
    $response = array("success" => true, "message" => "Data exists in the database");
    mysqli_fetch_array($result);
    while ($row = mysqli_fetch_array($result)) {
            $list .= "<tr>
            <td>{$row['name']}</td>
            <td>{$row['nickname']} / {$row['group_name']}</td>";
            $list .= ($row['activated'] === "1") ? "<td>활성화</td>" : "<td>비활성화</td>";
            $list .= "<td>
            <a href='sudpas_admin_edit.php?id={$row['id']}'><button>정보 수정</button></a>
            </td>
            </tr>";
        } 
    }

echo $list;

$conn->close();
?>