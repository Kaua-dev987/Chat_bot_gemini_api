<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>| Deep Buzz |</title>
</head>
<body>
    <header>
        <img src="deep_buzz3.png" alt="Logo" width="250px">
    </header>
    <br><hr><br>
    <main>
        <div class="background_front">
            <form action="index.php" method="POST">
                <button type="submit" class="b_sub">| Submit |</button>
                <label for="caixa">Escreva aqui : </label>
                <input type="text" name="pergunta" id="1" placeholder="Digite sua pergunta..." required>
            </form>
            <?php
                // incluir o arquivo conexão.php
                include("conexão.php");
                //enviar os dados para um formulário 
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    $prompt = $_POST['pergunta'];
                }
                //interligação com o banco de dados
                $prompt_vrf= $prompt;
                //
                //  
                echo "
                <div class='div_prompt'>
                    <h1 class='prompt'>$prompt</h1>
                </div>
                <div class='imagem_user'>
                    <img src='u.png' width='40px'>                
                </div>
                    <style>
                        .imagem_user{
                            position:absolute;
                            left:10px;
                            top:12px;
                        }
                        .prompt{
                            font-family:arial;
                            font-size:20px;
                            color:rgb(82, 150, 65);
                        }
                        .div_prompt{
                            position:absolute;
                            top:10px;
                            left:70px;
                            background-color:white;
                            border-top-right-radius:10px;
                            border-bottom-right-radius:10px;
                            border-top-left-radius:10px;
                            border-bottom-left-radius:10px;
                            display: inline-block;
                            padding-left:10px;
                            padding-right:10px;
                            width: fit-content;
                            max-width: 1450px;
                            word-wrap: break-word;
                        }
                    </style> ";
                    $api_key = 'AIzaSyCSSuFIcwsz85npwuFzQQ5m06yu0WXQrLg'; // Substitua pela sua chave
                    $pergunta = $_POST['pergunta'];
                    
                    if ($pergunta) {
                        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent'; // URL da API
                        $data = array(
                            'contents' => array(
                                array(
                                    'parts' => array(
                                        array(
                                            'text' => $pergunta
                                        )
                                    )
                                )
                            )
                        );
                        $options = array(
                            'http' => array(
                                'header'  => "Content-type: application/json\r\n" .
                                             "x-goog-api-key: " . $api_key . "\r\n",
                                'method'  => 'POST',
                                'content' => json_encode($data)
                            )
                        );
                        $context  = stream_context_create($options);
                        $result = file_get_contents($url, false, $context);
                        $resposta = json_decode($result, true)['candidates'][0]['content']['parts'][0]['text'];
                        echo "
                        <div class='div_resposta'>
                            <h1 class='resposta'>$resposta</h1>
                        </div>
                        <div class='imagem_bot'>
                            <img src='gemini_img.png' width='40px' >
                        </div>
                            <style>
                                .imagem_bot{
                                    position:absolute;
                                    left:10px;
                                    top:82px;
                                }
                                img{
                                    border-radius:20%;
                                }
                                .resposta{
                                    font-family:arial;
                                    font-size:20px;
                                    color:rgb(82, 150, 65);
                                }
                                .div_resposta{
                                    position:absolute;
                                    top:80px;
                                    left:70px;
                                    background-color:#f0ffd7;
                                    border-top-right-radius:10px;
                                    border-bottom-right-radius:10px;
                                    border-top-left-radius:10px;
                                    border-bottom-left-radius:10px;
                                    display: inline-block;
                                    padding-left:10px;
                                    padding-right:10px;
                                    width: fit-content;
                                    max-width: 1400px;
                                    word-wrap: break-word;
                                }
                            </style>
                                ";
                                if (strlen($prompt)>0){
                                    $sql = "INSERT INTO table_ia (Perg,Resp) VALUES ('$prompt','$resposta')";
                                    mysqli_query($con,$sql);
                                }
                                
                    }
            ?>
        </div>
    </main> 
</body>
</html>



