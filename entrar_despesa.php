<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar Despesa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('imagem.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #000;
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
            color: #00ff00; /* Branco neon */
            font-weight: bold;
        }
        form {
            width: 100%;
            max-width: 600px;
            background-color: #fff; /* Fundo branco para o formulário */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0;
            font-size: 18px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="submit"] {
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
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Entrar Despesa</h1>
    <form action="entrar_despesa.php" method="post">
        <?php
        // Função para ler os tipos de despesa a partir do arquivo
        function readTiposDespesa($file_path) {
            $tipos = [];
            if (file_exists($file_path)) {
                $file_content = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($file_content as $line) {
                    $tipos[] = trim($line);
                }
            }
            return $tipos;
        }

        // Define o caminho do arquivo de tipos de despesa
        $tipos_file_path = 'tipos_despesa.txt';
        $tipos = readTiposDespesa($tipos_file_path);
        ?>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" step="0.01" required>

        <label for="data_vencimento">Data de Vencimento:</label>
        <input type="date" id="data_vencimento" name="data_vencimento" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="">Selecione...</option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= htmlspecialchars($tipo) ?>"><?= htmlspecialchars($tipo) ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Salvar Despesa">
    </form>
    <a href="listar_despesas_abertas.php" class="button">Listar Despesas Abertas</a>
    <a href="index.php" class="button">Voltar à Tela Inicial</a>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data_vencimento = $_POST['data_vencimento'];
    $categoria = $_POST['categoria'];

    // Define o caminho do arquivo de despesas
    $file_path = 'despesas.txt';

    // Abre o arquivo para adicionar a nova despesa
    $file = fopen($file_path, 'a');
    if ($file) {
        // Adiciona um ID sequencial
        $id = time(); // Usando timestamp como ID único
        // Escreve os dados da despesa no arquivo
        fwrite($file, "$id|$descricao|$valor|$data_vencimento|$categoria|Aberta\n");
        fclose($file);
    }

    // Redireciona para a página de listar despesas
    header('Location: listar_despesas_abertas.php');
    exit();
}
?>

</body>
</html>
