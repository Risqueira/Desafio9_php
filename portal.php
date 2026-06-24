<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';


// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
$usuario = new Usuario($db);


// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: portal.php');
    exit();
}
// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];
// Obter dados dos usuários
$dados = $usuario->ler();
// Função para determinar a saudação
function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Portal</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
        }

        header {
            background: #4a90e2;
            color: #fff;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        header h1 {
            font-size: 1.2rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 16px;
            padding: 8px 16px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
            transition: background 0.2s;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        .nav-links a.btn-logout {
            background: #e74c3c;
        }

        .nav-links a.btn-logout:hover {
            background: #c0392b;
        }

        .content {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        th {
            background: #4a90e2;
            color: #fff;
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid #f0f2f5;
            color: #444;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f8f9fb;
        }

        .btn-editar,
        .btn-deletar {
            padding: 6px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 6px;
        }

        .btn-editar {
            background: #f39c12;
            color: #fff;
        }

        .btn-editar:hover {
            background: #d68910;
        }

        .btn-deletar {
            background: #e74c3c;
            color: #fff;
        }

        .btn-deletar:hover {
            background: #c0392b;
        }
    </style>
</head>

<body>
    <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>
    <a href="registrar.php">Adicionar Usuário</a>
    <a href="logout.php">Logout</a>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Fone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                <td><?php echo $row['fone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="deletar.php?id=<?php echo $row['id']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>