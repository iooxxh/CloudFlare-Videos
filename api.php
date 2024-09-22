<?php
// 获取前端传递的 URL 参数
if (isset($_GET['url'])) {
    $apiUrl = $_GET['url'];

    // 初始化 cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 超时时间为10秒

    // 执行 cURL 请求并获取结果
    $response = curl_exec($ch);

    // 检查是否有错误
    if (curl_errno($ch)) {
        echo json_encode([
            'error' => '请求API失败: ' . curl_error($ch)
        ]);
    } else {
        // 设置返回头为 JSON
        header('Content-Type: application/json');

        // 直接输出 API 返回的内容
        echo $response;
    }

    // 关闭 cURL
    curl_close($ch);
} else {
    // 如果没有提供 URL 参数，返回错误信息
    echo json_encode([
        'error' => '没有提供URL参数'
    ]);
}
