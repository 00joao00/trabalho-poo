<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Despesas Pagas</title>
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
        table {
            width: 100%;
            max-width: 800px;
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
        .danger-button {
            background-color: #dc3545;
        }
        .danger-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Despesas Pagas</h1>

    <?php
    // Função para ler as despesas a partir do arquivo
    function readDespesas($file_path) {
        $despesas = [];
        if (file_exists($file_path)) {
            $file_content = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($file_content as $line) {
                $despesas[] = explode('|', trim($line));
            }
        }
        return $despesas;
    }

    // Define o caminho do arquivo de despesas pagas
    $file_path = 'despesas_pagas.txt';
    $despesas = readDespesas($file_path);
    ?>

    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Pagamento</th>
                <th>Categoria</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($despesas as $despesa): ?>
                <?php if (isset($despesa[5]) && $despesa[5] === 'Pago'): ?>
                    <tr>
                        <td><?= htmlspecialchars($despesa[0]) ?></td>
                        <td>R$ <?= htmlspecialchars($despesa[1]) ?></td>
                        <td><?= htmlspecialchars($despesa[2]) ?></td>
                        <td><?= htmlspecialchars($despesa[3]) ?></td>
                        <td><?= htmlspecialchars($despesa[4]) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulário para limpar o histórico -->
    <form action="listar_despesas_pagas.php" method="post" style="display: inline;">
        <input type="hidden" name="clear_history" value="true">
        <input type="submit" value="Limpar Histórico" class="button danger-button">
    </form>

    <a href="index.php" class="button">Voltar à Tela Inicial</a>

    <?php
    // Lógica para limpar o histórico
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clear_history']) && $_POST['clear_history'] === 'true') {
        // Limpa o conteúdo do arquivo diretamente
        file_put_contents($file_path, '');
        // Redireciona para a mesma página para atualizar a tabela
        header('Location: listar_despesas_pagas.php');
        exit();
    }
    ?>
</div>

</body>
</html>
