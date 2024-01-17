<?php

// 사용자가 입력한 비밀번호
$user_password = "S@f3P@ss!";

// 솔트 생성 (랜덤하게 생성하거나, 사용자별로 고유한 값 등을 사용할 수 있습니다)
$salt = bin2hex(random_bytes(16)); // 랜덤 16바이트 솔트 생성

// 비밀번호와 솔트를 결합하여 해싱
$hashed_password = password_hash($user_password . $salt, PASSWORD_DEFAULT);

echo $salt."<br>".$hashed_password

// // 데이터베이스에 저장된 솔트와 함께 해싱된 비밀번호를 가져온다고 가정
// // (실제로는 데이터베이스에서 사용자 정보를 가져와야 합니다)
// $stored_salt = "stored_salt_from_database";
// $stored_hashed_password = "stored_hashed_password_from_database";

// // 사용자가 입력한 비밀번호를 검증
// if (password_verify($user_password . $stored_salt, $stored_hashed_password)) {
//     echo "비밀번호 일치!";
// } else {
//     echo "비밀번호 불일치!";
// }

?>