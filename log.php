<?php
$webhook_url = "https://discord.com/api/webhooks/1383718705174675456/NR4jzLiRI1hsWVnqjKF_pyrAWSLl59mxrRhyRPz8B8MpEA1hxl4GGyQUKN9WYfi-UCps";

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}

$ip = getUserIP();
$timestamp = date("Y-m-d H:i:s");

$data = [
    "content" => "📥 Visitor on your site!\nIP: `$ip`\nTime: `$timestamp`"
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/json",
        'content' => json_encode($data)
    ]
];

$context  = stream_context_create($options);
file_get_contents($webhook_url, false, $context);

// Return a 1x1 transparent pixel to make it invisible
header("Content-Type: image/gif");
echo base64_decode("R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==");
?>
