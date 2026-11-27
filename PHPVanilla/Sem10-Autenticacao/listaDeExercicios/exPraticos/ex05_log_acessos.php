<?php
declare(strict_types=1);

// Configura e inicia a sessão
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => !empty($_SERVER['HTTPS'])
]);

session_start();

// Conecta ao PostgreSQL
$pdo = new PDO(
    "pgsql:host=127.0.0.1;port=5432;dbname=peca_senai",
    "postgres",
    "postgres"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Registra uma tentativa de autenticação
function registrarAcesso(PDO $pdo, string $email, bool $sucesso): void
{
    $sql = "INSERT INTO auditoria_logins
            (email, ip, user_agent, sucesso)
            VALUES (:email, :ip, :navegador, :sucesso)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':ip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ':navegador' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ':sucesso' => $sucesso
    ]);
}

// Processa o login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM usuarios
            WHERE email = :email AND ativo = TRUE";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Confere a senha cadastrada
    $sucesso = $usuario &&
        password_verify($senha, $usuario['senha_hash']);

    // Registra o resultado da tentativa
    registrarAcesso($pdo, $email, (bool) $sucesso);

    if ($sucesso) {
        session_regenerate_id(true);

        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['perfil'] = $usuario['perfil'];

        header('Location: ex05_log_acessos.php');
        exit;
    }

    echo "<p>E-mail ou senha incorretos!</p>";
}

// Verifica se o usuário é administrador
if (($_SESSION['perfil'] ?? '') === 'ADMIN') {

    echo "<h2>Painel de auditoria</h2>";

    $sql = "SELECT * FROM auditoria_logins
            ORDER BY data_hora DESC LIMIT 50";

    $registros = $pdo->query($sql);

    // Apresenta os registros de acesso
    foreach ($registros as $registro) {

        echo "<p>";
        echo "E-mail: " . htmlspecialchars($registro['email'] ?? '');
        echo "<br>IP: " . htmlspecialchars($registro['ip'] ?? '');
        echo "<br>Navegador: " . htmlspecialchars($registro['user_agent'] ?? '');
        echo "<br>Data: " . htmlspecialchars($registro['data_hora']);

        echo "<br>Resultado: ";

        echo in_array($registro['sucesso'], [true, 't', '1', 1], true)
            ? "Sucesso"
            : "Falha";

        echo "</p><hr>";
    }
}
?>

<h2>Login de usuários</h2>

<form method="POST">
    <input type="email" name="email" placeholder="E-mail" required>
    <br><br>

    <input type="password" name="senha" placeholder="Senha" required>
    <br><br>

    <button type="submit">Entrar</button>
</form>
