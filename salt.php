<?php
// 사용자의 비밀번호와 솔트 생성
$password = "user_password";
$salt = bin2hex(random_bytes(16)); // 16바이트의 무작위 솔트 생성

// 비밀번호와 솔트를 결합하여 해시 함수에 적용
$hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT);

// 데이터베이스에 저장된 값: $hashedPassword, $salt
echo $password."<br>";
echo $salt."<br>";
echo $hashedPassword."<br>";
?>