<?php
// aplicação de página unica de variaveis superglobais ($_POST, $_SERVER)
declare(strict_types=1);

// Dados Fictícios para Comparação (Requisito)
define("EMAIL_CORRETO", "admin@senai.br");
define("SENHA_CORRETA", "senhaSegura123");

//declara variáveis de controle
$mensagemSucesso = "";
$erro = [];

$email = "";
// A variável da senha não precisa ser mantida globalmente para o formulário por segurança

//Processamento do POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Recuperar os Dados do Formulário
    $email = trim((string) ($_POST["email"] ?? ""));
    $senha = (string) ($_POST["senha"] ?? ""); // as senhas não devem ter espaços cortados com trim obrigatoriamente

    // Requisito: Validação do E-mail (filter_var)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro["email"] = "Informe um e-mail válido";
    }

    // Requisito: Validação da Senha (mínimo 6 caracteres)
    if (strlen($senha) < 6) {
        $erro["senha"] = "A senha deve ter no mínimo 6 caracteres";
    }

    // caso não existir erros de validação, compara com as credenciais fictícias
    if ($erro === []) {
        if ($email === EMAIL_CORRETO && $senha === SENHA_CORRETA) {
            // requisito: Card de boas-vindas se o login for correto
            $mensagemSucesso = "Bem-vindo ao sistema, Administrador!";
        } else {
            // requisito: mensagem exata se for incorreto
            $erro["login"] = "Credenciais inválidas";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Área de Autenticação</h1>

        <section>
            <h2>Identifique-se</h2>
            <p>Insira suas credenciais para acessar a plataforma do SENAI</p>

            <?php if ($mensagemSucesso !== "") : ?>
                <div class="sucesso">
                    <strong><?= htmlspecialchars($mensagemSucesso) ?></strong>
                </div>
            <?php endif; ?>

            <!-- mensagem de erro de credenciais inválidas -->
            <?php if (isset($erro["login"])): ?>
                <div class="erro-login" style="background: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 15px; border-radius: 4px; font-weight: bold;">
                    <?= $erro["login"] ?>
                </div>
            <?php endif; ?>

            <!-- Formulário POST -->
            <form action="ex03_login_seguro.php" method="POST" novalidate>
                
                <label for="email">E-mail</label>
                <!-- requisito: Sticky Form ativo apenas para o e-mail -->
                <input type="email" name="email" id="email" placeholder="Ex: exemplo@senai.br" value="<?= htmlspecialchars($email) ?>">
                <?php if (isset($erro["email"])): ?>
                    <div class="erro"><?= $erro["email"] ?></div>
                <?php endif; ?>

                <label for="senha">Senha</label>
                <!-- requisito de segurança: O campo value nunca é repopulado com a senha digitada -->
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                <?php if (isset($erro["senha"])): ?>
                    <div class="erro"><?= $erro["senha"] ?></div>
                <?php endif; ?>

                <button type="submit">Acessar Sistema</button>
            </form>
        </section>
    </main>
</body>

</html>
