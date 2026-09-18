<?php
//Sanitizador de Cadastro de Colaboradores

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function sanitizarTexto(string $dado): string
{
    return trim(strip_tags($dado));
}

function validarColaborador(array $dados): array
{
    $erros = [];

    if ($dados['nome'] === '') {
        $erros['nome'] = 'Nome obrigatório.';
    }

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'E-mail inválido.';
    }

    if (filter_var($dados['matricula'], FILTER_VALIDATE_INT) === false) {
        $erros['matricula'] = 'Matrícula deve ser um inteiro.';
    }

    if (filter_var($dados['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $erros['salario'] = 'Salário deve ser um número.';
    }

    return $erros;
}

$dados = [
    'nome' => '',
    'email' => '',
    'matricula' => '',
    'salario' => ''
];

$erros = [];
$cadastrado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados['nome'] = sanitizarTexto($_POST['nome'] ?? '');
    $dados['email'] = trim($_POST['email'] ?? '');
    $dados['matricula'] = trim($_POST['matricula'] ?? '');
    $dados['salario'] = trim($_POST['salario'] ?? '');

    $erros = validarColaborador($dados);

    if ($erros === []) {
        $cadastrado = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
</head>

<body>

<h1>Cadastro de Colaborador</h1>

<form method="POST">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= e($dados['nome']) ?>">

    <br><br>

    <label>E-mail:</label>
    <input type="text" name="email" value="<?= e($dados['email']) ?>">

    <br><br>

    <label>Matrícula:</label>
    <input type="text" name="matricula" value="<?= e($dados['matricula']) ?>">

    <br><br>

    <label>Salário:</label>
    <input type="text" name="salario" value="<?= e($dados['salario']) ?>">

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php if ($erros !== []): ?>

    <h2>Erros encontrados:</h2>

    <?php foreach ($erros as $erro): ?>
        <p><?= e($erro) ?></p>
    <?php endforeach; ?>

<?php endif; ?>

<?php if ($cadastrado): ?>

    <h2>Colaborador cadastrado!</h2>

    <p>Nome: <?= e($dados['nome']) ?></p>
    <p>E-mail: <?= e($dados['email']) ?></p>
    <p>Matrícula: <?= e($dados['matricula']) ?></p>
    <p>Salário: <?= e($dados['salario']) ?></p>

<?php endif; ?>

</body>
</html>