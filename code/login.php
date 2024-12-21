<?php
// 数据库连接信息
$servername = "localhost";
$username = "root"; // 你的数据库用户名
$password = ""; // 你的数据库密码
$dbname = "account"; // 数据库名称
$port = 3316; // 数据库端口号

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取用户输入的用户名和密码
$user_input = $_POST['username'];
$pass_input = $_POST['password'];

// 防止SQL注入
$user_input = $conn->real_escape_string($user_input);

// 使用预处理语句查询数据库，检查是否有匹配的用户名
$stmt = $conn->prepare("SELECT id, username, password FROM User WHERE username = ?");
$stmt->bind_param("s", $user_input);
$stmt->execute();
$result = $stmt->get_result();

// 如果找到用户
if ($result->num_rows > 0) {
    // 获取用户的数据
    $row = $result->fetch_assoc();

    // 检查密码是否匹配
    if (password_verify($pass_input, $row['password'])) {
        // 登录成功
        // 设置会话标识，表示用户已经登录
        session_start();
        $_SESSION['username'] = $row['username']; // 保存用户名到会话中

        // 跳转到特定的 HTML 页面
        header("Location: ./ware/host.html"); // 将 dashboard.html 替换为你需要的 HTML 页面
        exit; // 确保后续代码不会执行
    } else {
        // 密码错误
        echo "Invalid username or password.";
    }
} else {
    // 用户名不存在
    echo "no one here.";
}

// 关闭数据库连接
$conn->close();
?>