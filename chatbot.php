<?php
session_start();
header('Content-Type: application/json');

// 🔐 API Key Gemini
$apiKey = 'AIzaSyDw7uDwMpD8FZUUq_EhKnVGBI7ZSKFH1lQ';

// 📨 Nhận message từ client
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$message = trim($data['message'] ?? '');

if (empty($message)) {
    echo json_encode(['reply' => '❗Bạn chưa nhập gì cả!'], JSON_UNESCAPED_UNICODE);
    exit;
}

// 🔌 Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "datt");
if ($conn->connect_error) {
    echo json_encode(['reply' => '❗Lỗi kết nối CSDL: ' . $conn->connect_error], JSON_UNESCAPED_UNICODE);
    exit;
}

$messageLower = mb_strtolower($message);
$reply = null;

// 🧠 Logic xử lý CSDL
if (preg_match('/sản phẩm mới/i', $messageLower)) {
    $sql = "SELECT ten_san_pham FROM san_phams ORDER BY ngay_nhap DESC LIMIT 5";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $reply = "🆕 Các sản phẩm mới nhất:\n";
        while ($row = $result->fetch_assoc()) {
            $reply .= "• " . $row['ten_san_pham'] . "\n";
        }
    } else {
        $reply = "⚠️ Hiện chưa có sản phẩm mới nào.";
    }
} elseif (preg_match('/(danh mục|loại hàng|loại sản phẩm)/iu', $messageLower)) {
    $sql = "SELECT ten_danh_muc FROM danh_mucs";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $reply = "📂 Các danh mục sản phẩm hiện có:\n";
        while ($row = $result->fetch_assoc()) {
            $reply .= "• " . $row['ten_danh_muc'] . "\n";
        }
    } else {
        $reply = "🤖 Chưa có danh mục cụ thể, nhưng bạn có thể hỏi về các loại gấu như gấu teddy, gấu trắng, v.v.";
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
        // Gợi ý sản phẩm ngẫu nhiên nếu không tìm thấy
        $sqlSuggest = "SELECT ten_san_pham, gia_san_pham FROM san_phams ORDER BY RAND() LIMIT 3";
        $resultSuggest = $conn->query($sqlSuggest);

        $reply = "🤖 Không tìm thấy sản phẩm chính xác cho \"$tuKhoa\".\nBạn có thể tham khảo một số sản phẩm sau:\n";
        while ($row = $resultSuggest->fetch_assoc()) {
            $gia = number_format($row['gia_san_pham'], 0, ',', '.');
            $reply .= "• " . $row['ten_san_pham'] . " — " . $gia . "₫\n";
        }
    }
}

// 📦 Nếu tìm thấy câu trả lời từ DB
if ($reply !== null) {
    // Lưu vào DB
    $stmt = $conn->prepare("INSERT INTO chat_logs (user_message, bot_reply) VALUES (?, ?)");
    $stmt->bind_param("ss", $message, $reply);
    $stmt->execute();

    // Lưu vào session
    $_SESSION['chat_history'][] = [
        'user' => $message,
        'bot' => $reply
    ];
    // Giới hạn tối đa 100 lượt
    $_SESSION['chat_history'] = array_slice($_SESSION['chat_history'], -100);

    echo json_encode(['reply' => $reply], JSON_UNESCAPED_UNICODE);
    $conn->close();
    exit;
}

// 🧠 Nếu không khớp DB, dùng hội thoại từ session gửi cho AI
$history = "";
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

foreach ($_SESSION['chat_history'] as $chat) {
    $history .= "Người dùng: " . $chat['user'] . "\n";
    $history .= "Chatbot: " . $chat['bot'] . "\n";
}

$prompt = $history . "Người dùng: $message\nChatbot:";

// 🤖 Gửi sang Gemini
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";
$postData = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
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
$aiReply = $result['candidates'][0]['content']['parts'][0]['text'] ?? '🤖 Không có phản hồi từ AI.';

// Lưu AI vào DB
$stmt = $conn->prepare("INSERT INTO chat_logs (user_message, bot_reply) VALUES (?, ?)");
$stmt->bind_param("ss", $message, $aiReply);
$stmt->execute();

// Lưu vào session
$_SESSION['chat_history'][] = [
    'user' => $message,
    'bot' => $aiReply
];
$_SESSION['chat_history'] = array_slice($_SESSION['chat_history'], -100);

echo json_encode(['reply' => $aiReply], JSON_UNESCAPED_UNICODE);

curl_close($ch);
$conn->close();
?>
