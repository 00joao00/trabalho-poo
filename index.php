<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            text-decoration: none;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .button i {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Menu Principal</h1>
    <div class="button-container">
        <a href="entrar_despesa.php" class="button"><i class="fas fa-plus"></i> Entrar Despesa</a>
        <a href="anotar_pagamento.php" class="button"><i class="fas fa-money-bill-wave"></i> Anotar Pagamento</a>
        <a href="listar_despesas_abertas.php" class="button"><i class="fas fa-list"></i> Listar Despesas em Aberto no Período</a>
        <a href="listar_despesas_pagas.php" class="button"><i class="fas fa-check-circle"></i> Listar Despesas Pagas no Período</a>
        <a href="gerenciar_tipos_despesa.php" class="button"><i class="fas fa-tags"></i> Gerenciar Tipos de Despesa</a>
        <a href="gerenciar_usuarios.php" class="button"><i class="fas fa-users"></i> Gerenciar Usuários</a>
    </div>
</div>

</body>
</html>
