<?php
// 数据库连接信息
$servername = "localhost";
$username = "root"; // 你的数据库用户名
$password = ""; // 你的数据库密码
$dbname = "account"; // 数据库名称
$port = 3316; // 数据库端口号

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname , $port);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取用户输入的用户名和密码
$user_input = $_POST['username'];
$pass_input = $_POST['password'];

// 加密密码
$hashed_password = password_hash($pass_input, PASSWORD_DEFAULT);

// 防止SQL注入
$user_input = $conn->real_escape_string($user_input);

// 插入新用户到数据库
$sql = "INSERT INTO User (username, password) VALUES ('$user_input', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: ./ware/host.html"); // 将 dashboard.html 替换为你需要的 HTML 页面
exit; // 确保后续代码不会执行

// 关闭数据库连接
$conn->close();
?>
