<?php
//Chat Industrial com Tratamento de Emojis e Quebras de Linha

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function carregarMensagens(string $arquivo): array
{
    if (!file_exists($arquivo)) {
        return [];
    }

    $dados = file_get_contents($arquivo);
    return json_decode($dados, true) ?? [];
}

function salvarMensagens(string $arquivo, array $mensagens): void
{
    file_put_contents(
        $arquivo,
        json_encode($mensagens, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

function validarMensagem(string $mensagem): string
{
    if ($mensagem === '') {
        return 'Digite uma mensagem.';
    }

    if (mb_strlen($mensagem) > 250) {
        return 'A mensagem não pode ultrapassar 250 caracteres.';
    }

    return '';
}

$arquivo = 'chat.json';
$mensagens = carregarMensagens($arquivo);
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $operador = trim($_POST['operador'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    $erro = validarMensagem($mensagem);

    if ($erro === '') {

        $mensagens[] = [
            'operador' => $operador,
            'mensagem' => $mensagem
        ];

        salvarMensagens($arquivo, $mensagens);

        header('Location: ex05_chat_operacao.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Chat Industrial</title>
</head>

<body>

<h1>Chat da Operação</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="POST">

    <label>Operador/Supervisor:</label>
    <input type="text" name="operador">

    <br><br>

    <label>Mensagem:</label>
    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>

</form>

<hr>

<h2>Mensagens</h2>

<?php foreach ($mensagens as $item): ?>

    <p>
        <strong><?= e($item['operador']) ?></strong>
    </p>

    <!--
    Primeiro usamos e() para escapar o HTML.
    Depois usamos nl2br() para transformar quebras de linha em <br>.
    Se fizermos e(nl2br()), o <br> também será escapado
    e aparecerá como texto em vez de funcionar como quebra de linha.
    -->

    <p><?= nl2br(e($item['mensagem'])) ?></p>

    <hr>

<?php endforeach; ?>

</body>
</html>