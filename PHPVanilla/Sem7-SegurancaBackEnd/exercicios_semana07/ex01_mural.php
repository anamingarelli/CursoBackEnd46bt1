<?php
//Mural de Recados Blindado (Stored XSS)
declare(strict_types=1);

// Escapa caracteres especiais para evitar XSS
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// Lê os recados salvos no arquivo JSON
function carregarRecados(string $arquivo): array
{
    if (!file_exists($arquivo)) {
        return [];
    }

    $dados = file_get_contents($arquivo);
    return json_decode($dados, true) ?? [];
}

// Salva os recados no arquivo JSON
function salvarRecados(string $arquivo, array $recados): void
{
    file_put_contents(
        $arquivo,
        json_encode($recados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

$arquivo = 'recados.json';
$recados = carregarRecados($arquivo);
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (strlen($nome) < 3) {
        $erro = 'O nome deve possuir pelo menos 3 caracteres.';
    } elseif (strlen($mensagem) < 5) {
        $erro = 'A mensagem deve possuir pelo menos 5 caracteres.';
    } else {
        $recados[] = [
            'nome' => $nome,
            'mensagem' => $mensagem
        ];

        salvarRecados($arquivo, $recados);
        header('Location: ex01_mural.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mural de Recados</title>
</head>

<body>

<h1>Mural de Recados</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="POST">

    <label>Nome:</label>
    <input type="text" name="nome">

    <br><br>

    <label>Mensagem:</label>
    <textarea name="mensagem"></textarea>

    <br><br>

    <button type="submit">Enviar</button>

</form>

<hr>

<h2>Recados publicados</h2>

<?php foreach ($recados as $recado): ?>

    <div>
        <strong><?= e($recado['nome']) ?></strong>

        <p><?= nl2br(e($recado['mensagem'])) ?></p>
    </div>

    <hr>

<?php endforeach; ?>

</body>
</html>