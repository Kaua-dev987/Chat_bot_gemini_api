<?php
$apiKey = "AIzaSyDccmk0WDe3FP_k_ZStZB5JGejB-E1iq3U";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["prompt"])) {
    $prompt = $_POST["prompt"];
} else {
    die("Nenhuma pergunta foi enviada.");
}
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $apiKey;
$data = [
    "contents" => [
        ["parts" => [["text" => $prompt]]]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);

curl_close($ch);

$result = json_decode($response, true);

if (isset($result["candidates"][0]["content"]["parts"][0]["text"])) {
    echo "<strong>Resposta do Gemini:</strong><br>";
    echo $result["candidates"][0]["content"]["parts"][0]["text"];
} else {
    echo "Erro ao obter resposta da API.";
}
?>
