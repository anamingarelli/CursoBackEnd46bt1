<?php
// Validador de Links de Portfólio (Prevenção javascript:)
declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function validarLink(string $url): bool
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    return str_starts_with($url, 'http://')
        || str_starts_with($url, 'https://');
}

$nome = '';
$linkValido = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $url = trim($_POST['url'] ?? '');

    if ($nome === '') {
        $erro = 'Informe seu nome.';
    } elseif (!validarLink($url)) {
        $erro = 'Informe uma URL válida usando HTTP ou HTTPS.';
    } else {
        $linkValido = $url;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Validador de Links</title>
</head>

<body>

<h1>Portfólio</h1>

<form method="POST">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= e($nome) ?>">

    <br><br>

    <label>Link do GitHub/LinkedIn:</label>
    <input type="text" name="url">

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<?php if ($linkValido !== ''): ?>

    <p>
        <?= e($nome) ?>:
        <a href="<?= e($linkValido) ?>" target="_blank">
            Visitar Portfólio
        </a>
    </p>

<?php endif; ?>

</body>
</html>