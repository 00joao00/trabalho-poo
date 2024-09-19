<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tipos de Despesa</title>
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
        input[type="text"], input[type="submit"] {
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
        table {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff; /* Fundo branco para a tabela */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            font-weight: bold;
            color: #000; /* Texto preto */
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        tr:hover td {
            background-color: #e0e0e0;
        }
        .edit-button, .delete-button {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-button:hover, .delete-button:hover {
            background-color: #0056b3;
        }
        .edit-button {
            margin-right: 5px;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
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
    <h1>Gerenciar Tipos de Despesa</h1>
    <form action="gerenciar_tipos.php" method="post">
        <label for="tipo">Tipo de Despesa:</label>
        <input type="text" id="tipo" name="tipo" required>
        <input type="submit" value="Adicionar Tipo">
    </form>
    
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

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipos as $index => $tipo): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($tipo) ?></td>
                    <td>
                        <a href="editar_tipo.php?id=<?= $index ?>" class="edit-button">Editar</a>
                        <a href="deletar_tipo.php?id=<?= $index ?>" class="delete-button">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="button">Voltar à Tela Inicial</a>
</div>

</body>
</html>
