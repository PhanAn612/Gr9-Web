<?php
session_start();

// Kết nối đến cơ sở dữ liệu MySQL
require '../php/connect.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để kiểm tra username và password trong cơ sở dữ liệu
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, lấy thông tin người dùng và xác định vai trò
        $row = $result->fetch_assoc();
        $role = $row['role'];
        $iduser= $row['iduser'];
        $fullName= $row['fullName'];
        $userName= $row['userName'];
        $email= $row['email'];
        $address = $row['address'];
        $phoneNumber = $row['phoneNumber'];
        $isLocked = $row['locked']; // Lấy trạng thái khóa của người dùng
        $Password = $row['Password'];
        // Kiểm tra trạng thái khóa
        if ($isLocked == 1) {
            // Nếu người dùng bị khóa, chuyển hướng về trang đăng nhập với thông báo
            echo "Your account is locked. Please contact with to explained";
            exit();
        }
        
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['iduser'] = $iduser;
        $_SESSION['fullName'] = $fullName;
        $_SESSION['userName'] = $userName;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['phoneNumber'] = $phoneNumber;
        $_SESSION['Password'] = $Password;

        // Lưu vai trò vào session và chuyển hướng tới trang tương ứng
        $_SESSION['role'] = $role;
        if ($role == 0) {
            header('Location: http://localhost/Gr9-Web/interface/index.php');
            exit();
        } elseif ($role == 1) {
            header('Location: http://localhost/Gr9-Web/admin/index.php');
            exit();
        }
    } else {
        // Đăng nhập không thành công, thông báo lỗi hoặc chuyển hướng về trang đăng nhập với thông báo
        header('Location: login_signup.html?error=1');
        exit();
    }
} else {
    // Nếu không có dữ liệu đăng nhập được gửi đi, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}

$conn->close();
?>
