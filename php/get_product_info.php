<?php

require '../php/connect.php';

function returnJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
}

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    if (!empty($productId)) {
        // Sanitize input
        $productId = intval($productId);

        $stmt = $conn->prepare("SELECT * FROM products WHERE idProduct = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productInfo = [
                'id' => $row['idProduct'],
                'name' => $row['name'],
                'price' => $row['price'],
                'category' => $row['category'],
                'image' => $row['image'],
                'image2' => $row['image2'],
                'image3' => $row['image3'],
                'description' => $row['description']
            ];
            returnJsonResponse($productInfo);
        } else {
            returnJsonResponse(['error' => 'Không tìm thấy sản phẩm với ID đã cung cấp.']);
        }
        $stmt->close();
    } else {
        returnJsonResponse(['error' => 'ID sản phẩm không được để trống.']);
    }
} else {
    returnJsonResponse(['error' => 'Không có ID sản phẩm nào được cung cấp.']);
}

$conn->close();
?>
