<?php
declare(strict_types=1);

// Configura os cookies da sessão
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => !empty($_SERVER['HTTPS'])
]);

session_start();

// Inicializa o contador
$_SESSION['tentativas_login'] ??= 0;

// Verifica se existe um bloqueio ativo
$bloqueio = $_SESSION['bloqueado_ate'] ?? 0;
$restante = $bloqueio - time();

if ($restante > 0) {
    echo "<h2>Login bloqueado!</h2>";
    echo "<p>Aguarde $restante segundos.</p>";
    echo "<script>setTimeout(() => location.reload(), 1000);</script>";
    exit;
}

// Reinicia o contador após o bloqueio
if ($bloqueio > 0) {
    $_SESSION['tentativas_login'] = 0;
    unset($_SESSION['bloqueado_ate']);
}

// Conecta ao PostgreSQL
$pdo = new PDO(
    "pgsql:host=127.0.0.1;port=5432;dbname=peca_senai",
    "postgres",
    "postgres"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM usuarios
            WHERE email = :email AND ativo = TRUE";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica a senha
    if ($usuario && password_verify($senha, $usuario['senha_hash'])) {

        $_SESSION['tentativas_login'] = 0;
        unset($_SESSION['bloqueado_ate']);

        session_regenerate_id(true);

        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['perfil'] = $usuario['perfil'];

        echo "Login realizado com sucesso!";
        exit;
    }

    // Conta as tentativas incorretas
    $_SESSION['tentativas_login']++;

    echo "E-mail ou senha incorretos!<br>";

    // Bloqueia após três erros
    if ($_SESSION['tentativas_login'] >= 3) {
        $_SESSION['bloqueado_ate'] = time() + 60;
        echo "Você foi bloqueado por 60 segundos!";
        exit;
    }

    echo "Tentativas: " . $_SESSION['tentativas_login'] . "/3";
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
