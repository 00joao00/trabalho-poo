<?php
include 'conexao.php';
include 'utils.php';

// Função para lidar com exclusão de usuários
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $mensagem = "<p>Usuário excluído com sucesso!</p>";
    } else {
        $mensagem = "<p>Erro ao excluir usuário.</p>";
    }
    $stmt->close();
}

// Função para lidar com a edição de usuários
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $senha_criptografada = criptografar_senha($senha);

    $sql = "UPDATE usuarios SET usuario = ?, senha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $usuario, $senha_criptografada, $id);

    if ($stmt->execute()) {
        $mensagem = "<p>Usuário atualizado com sucesso!</p>";
    } else {
        $mensagem = "<p>Erro ao atualizar usuário.</p>";
    }
    $stmt->close();
}

// Função para carregar o usuário para edição
if (isset($_GET['acao']) && $_GET['acao'] == 'editar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario_atual = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
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
        h1 {
            font-size: 2.5em;
            margin: 20px 0;
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
            margin: 20px auto;
            text-align: left;
        }
        label {
            display: block;
            margin: 10px 0;
            font-size: 18px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
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
        .tabela-usuarios {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .tabela-usuarios table {
            width: 100%;
            border-collapse: collapse;
        }
        .tabela-usuarios thead {
            background-color: #00ff00; /* Branco neon */
            color: #000; /* Texto preto */
            font-weight: bold;
        }
        .tabela-usuarios th, .tabela-usuarios td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .tabela-usuarios th {
            background-color: #00ff00; /* Branco neon */
            color: #000;
            font-weight: bold;
        }
        .tabela-usuarios tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .tabela-usuarios tr:last-child td {
            border-bottom: none;
        }
        .btn {
            background-color: #28a745; /* Verde para editar */
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #218838;
        }
        .btn-excluir {
            background-color: #dc3545; /* Vermelho para excluir */
        }
        .btn-excluir:hover {
            background-color: #c82333;
        }
        a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Gerenciar Usuários</h1>

    <?php if (isset($mensagem)): ?>
        <div><?= $mensagem ?></div>
    <?php endif; ?>

    <?php if (isset($usuario_atual)): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= $usuario_atual['id'] ?>">
            <label for="usuario">Nome de Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario_atual['usuario']) ?>" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <input type="submit" value="Atualizar Usuário">
        </form>
    <?php else: ?>
        <form method="post">
            <label for="usuario">Nome de Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <input type="submit" value="Cadastrar Usuário">
        </form>
    <?php endif; ?>

    <h2 style="color: #00ff00;">Usuários Cadastrados</h2>
    <div class="tabela-usuarios">
        <table>
            <thead>
                <tr>
                    <th>Nome de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td>
                        <a href="?acao=editar&id=<?= $row['id'] ?>" class="btn">Editar</a>
                        <a href="?acao=excluir&id=<?= $row['id'] ?>" class="btn btn-excluir">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php">Voltar ao Menu Principal</a>
</body>
</html>
