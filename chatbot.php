<?php
header('Content-Type: application/json');

// 🔐 API Key Gemini
// $apiKey = 'AIzaSyDw7uDwMpD8FZUUq_EhKnVGBI7ZSKFH1lQ';
if (!$apiKey) {
    echo json_encode(['reply' => '❗Chưa cấu hình API Key.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// 📨 Nhận message từ client
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$message = trim($data['message'] ?? '');

if (empty($message)) {
    echo json_encode(['reply' => '❗Bạn chưa nhập gì cả!'], JSON_UNESCAPED_UNICODE);
    exit;
}

// 🔌 Kết nối CSDL thật
$conn = new mysqli("localhost", "root", "", "duan_1");
if ($conn->connect_error) {
    echo json_encode(['reply' => '❗Lỗi kết nối CSDL: ' . $conn->connect_error], JSON_UNESCAPED_UNICODE);
    exit;
}

$messageLower = mb_strtolower($message);
$reply = null;

// 🧠 Logic xử lý CSDL thông minh hơn
if (preg_match('/sản phẩm mới/i', $messageLower)) {
    $sql = "SELECT ten_san_pham FROM san_phams ORDER BY created_at DESC LIMIT 5";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $reply = "🆕 Các sản phẩm mới nhất:\n";
        while ($row = $result->fetch_assoc()) {
            $reply .= "• " . $row['ten_san_pham'] . "\n";
        }
    } else {
        $reply = "⚠️ Hiện chưa có sản phẩm mới nào.";
    }
} elseif (preg_match('/(danh mục|loại hàng|loại sản phẩm)/i', $messageLower)) {
    $sql = "SELECT ten_danh_muc FROM danh_mucs";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $reply = "📂 Các danh mục sản phẩm:\n";
        while ($row = $result->fetch_assoc()) {
            $reply .= "• " . $row['ten_danh_muc'] . "\n";
        }
    } else {
        $reply = "⚠️ Chưa có danh mục nào trong hệ thống.";
    }
} elseif (preg_match('/sản phẩm (.+)/iu', $messageLower, $matches)) {
    $tuKhoa = $conn->real_escape_string($matches[1]);
    $sql = "SELECT ten_san_pham, gia_san_pham FROM san_phams WHERE ten_san_pham LIKE '%$tuKhoa%' LIMIT 5";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $reply = "🔍 Kết quả tìm kiếm cho \"$tuKhoa\":\n";
        while ($row = $result->fetch_assoc()) {
            $gia = number_format($row['gia_san_pham'], 0, ',', '.');
            $reply .= "• " . $row['ten_san_pham'] . " — " . $gia . "₫\n";
        }
    } else {
        $reply = "❌ Không tìm thấy sản phẩm nào với từ khóa \"$tuKhoa\".";
    }
}

// 📦 Nếu có kết quả từ CSDL thì trả về luôn
if ($reply !== null) {
    echo json_encode(['reply' => $reply], JSON_UNESCAPED_UNICODE);
    $conn->close();
    exit;
}

// 🤖 Nếu không khớp logic nào, gửi sang Gemini
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

$postData = [
    "contents" => [
        [
            "parts" => [["text" => $message]]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($ch);
if ($response === false) {
    echo json_encode(['reply' => '❌ Lỗi cURL: ' . curl_error($ch)], JSON_UNESCAPED_UNICODE);
    $conn->close();
    exit;
}

$result = json_decode($response, true);
if (isset($result['error'])) {
    echo json_encode(['reply' => '❌ Lỗi API: ' . $result['error']['message']], JSON_UNESCAPED_UNICODE);
    $conn->close();
    exit;
}

$aiReply = $result['candidates'][0]['content']['parts'][0]['text'] ?? '🤖 Không có phản hồi từ AI.';
echo json_encode(['reply' => $aiReply], JSON_UNESCAPED_UNICODE);

curl_close($ch);
$conn->close();
