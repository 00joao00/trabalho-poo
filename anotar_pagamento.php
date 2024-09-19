<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotar Pagamento</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('imagem.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        form {
            width: 100%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.8); /* Fundo branco com transparência */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0;
            font-size: 18px;
        }
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a.button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Anotar Pagamento</h1>
    <form action="anotar_pagamento.php" method="post">
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>

        <label for="valor_pagamento">Valor do Pagamento:</label>
        <input type="number" id="valor_pagamento" name="valor_pagamento" step="0.01" required>

        <label for="data_pagamento">Data do Pagamento:</label>
        <input type="date" id="data_pagamento" name="data_pagamento" required>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria" required>

        <input type="submit" value="Salvar Pagamento">
    </form>
    <a href="listar_despesas_pagas.php" class="button">Listar Despesas Pagas</a>
    <a href="index.php" class="button">Voltar à Tela Inicial</a>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        $valor_pagamento = $_POST['valor_pagamento'];
        $data_pagamento = $_POST['data_pagamento'];
        $categoria = $_POST['categoria'];

        $file_path = 'despesas_pagas.txt';
        $data = sprintf("%s|%.2f|%s|%s|%s|Pago\n", $descricao, $valor_pagamento, $data_pagamento, $categoria, 'Pago');

        file_put_contents($file_path, $data, FILE_APPEND);

        echo "<p>Pagamento registrado com sucesso!</p>";
    }
    ?>
</div>

</body>
</html>
