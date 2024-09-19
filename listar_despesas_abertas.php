<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Despesas Abertas</title>
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
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Despesas Abertas</h1>
    
    <?php
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

    // Define os caminhos dos arquivos
    $file_path = 'despesas.txt';
    $file_pagas_path = 'despesas_pagas.txt';
    $despesas = readDespesas($file_path);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $despesas_abertas = [];
        $despesas_pagas = [];

        // Separar despesas abertas e pagas
        foreach ($despesas as $despesa) {
            if ($despesa[0] === $id) {
                $despesa[5] = 'Pago';
                $despesas_pagas[] = $despesa;
            } else {
                $despesas_abertas[] = $despesa;
            }
        }

        // Gravar despesas abertas e pagas nos respectivos arquivos
        file_put_contents($file_path, array_reduce($despesas_abertas, function($carry, $despesa) {
            return $carry . implode('|', $despesa) . "\n";
        }, ''));

        file_put_contents($file_pagas_path, array_reduce($despesas_pagas, function($carry, $despesa) {
            return $carry . implode('|', $despesa) . "\n";
        }, ''), FILE_APPEND);

        // Redirecionar para a página de despesas pagas
        header('Location: listar_despesas_pagas.php');
        exit();
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($despesas as $despesa): ?>
                <?php if (isset($despesa[5]) && $despesa[5] === 'Aberta'): ?>
                    <tr>
                        <td><?= htmlspecialchars($despesa[1]) ?></td>
                        <td>R$ <?= htmlspecialchars($despesa[2]) ?></td>
                        <td><?= htmlspecialchars($despesa[3]) ?></td>
                        <td><?= htmlspecialchars($despesa[4]) ?></td>
                        <td><?= htmlspecialchars($despesa[5]) ?></td>
                        <td>
                            <a href="?id=<?= urlencode($despesa[0]) ?>" class="button">Pagar</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="button">Voltar à Tela Inicial</a>
</div>

</body>
</html>
