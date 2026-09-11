<?php
// aplicação de página unica de variaveis superglobais ($_POST, $_SERVER)
declare(strict_types=1);

//Opções permitidas para os cursos técnicos (Requisito)
$cursosPermitidos = [
    'Desenvolvimento de Sistemas',
    'Mecatrônica',
    'Redes'
];

//Declarar Variáveis de Controle (Padrão das suas atividades)
$mensagemSucesso = "";
$erro = [];

$nomeCandidato = "";
$idadeTexto = "";
$cursoDesejado = "";
$aceiteTermos = false;

//Processamento do POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Recuperar os Dados do Formulário
    $nomeCandidato = trim((string) ($_POST["nome_candidato"] ?? ""));
    $idadeTexto = trim((string) ($_POST["idade"] ?? ""));
    $cursoDesejado = trim((string) ($_POST["curso_desejado"] ?? ""));
    // Requisito: Verificação do checkbox usando isset()
    $aceiteTermos = isset($_POST["aceite_termos"]);

    // REQUISITO: Nome com pelo menos 5 caracteres
    if (strlen($nomeCandidato) < 5) {
        $erro["nome_candidato"] = "O nome deve conter pelo menos 5 caracteres";
    }

    // REQUISITO: Idade maior ou igual a 16 anos
    $idade = filter_var($idadeTexto, FILTER_VALIDATE_INT);
    if ($idade === false || $idade < 16) {
        $erro["idade"] = "A idade mínima para inscrição é de 16 anos";
    }

    // REQUISITO: Curso obrigatório e pertencente à lista
    if ($cursoDesejado === "" || !in_array($cursoDesejado, $cursosPermitidos, true)) {
        $erro["curso_desejado"] = "Selecione um curso válido pertencente à lista";
    }

    // REQUISITO: Checkbox de termos deve estar obrigatoriamente marcado
    if (!$aceiteTermos) {
        $erro["aceite_termos"] = "Você precisa aceitar os termos de inscrição para prosseguir";
    }

    // SE não existir erros, a inscrição será realizada com sucesso
    if ($erro === []) {
        $mensagemSucesso = "Inscrição realizada com sucesso no curso de " . htmlspecialchars($cursoDesejado) . "!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição Curso Técnico - SENAI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Inscrição SENAI</h1>

        <section>
            <h2>Formulário de Candidatura</h2>
            <p>Preencha os campos abaixo para solicitar sua vaga nos cursos técnicos</p>

            <!-- Card de Confirmação de Sucesso -->
            <?php if ($mensagemSucesso !== "") : ?>
                <div class="sucesso">
                    <strong><?= htmlspecialchars($mensagemSucesso) ?></strong>
                </div>
            <?php endif; ?>

            <!-- Formulário POST com dados mantidos preenchidos (Sticky) -->
            <form action="" method="POST" novalidate>
                
                <label for="nome_candidato">Nome do Candidato</label>
                <input type="text" name="nome_candidato" id="nome_candidato" placeholder="Digite seu nome completo" value="<?= htmlspecialchars($nomeCandidato) ?>">
                <!-- REQUISITO: Exibição da mensagem de erro em vermelho logo abaixo do campo -->
                <?php if (isset($erro["nome_candidato"])): ?>
                    <div class="erro"><?= $erro["nome_candidato"] ?></div>
                <?php endif; ?>

                <label for="idade">Idade</label>
                <input type="number" name="idade" id="idade" placeholder="Ex: 17" value="<?= htmlspecialchars($idadeTexto) ?>">
                <!-- REQUISITO: Exibição da mensagem de erro em vermelho logo abaixo do campo -->
                <?php if (isset($erro["idade"])): ?>
                    <div class="erro"><?= $erro["idade"] ?></div>
                <?php endif; ?>

                <label for="curso_desejado">Curso Desejado</label>
                <select name="curso_desejado" id="curso_desejado" style="width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; font-size: 1rem;">
                    <option value="">Selecione um curso...</option>
                    <?php foreach ($cursosPermitidos as $curso): ?>
                        <option value="<?= $curso ?>" <?= $cursoDesejado === $curso ? 'selected' : '' ?>>
                            <?= $curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <!-- REQUISITO: Exibição da mensagem de erro em vermelho logo abaixo do campo -->
                <?php if (isset($erro["curso_desejado"])): ?>
                    <div class="erro"><?= $erro["curso_desejado"] ?></div>
                <?php endif; ?>

                <!-- Container especial para o Checkbox alinhar perfeitamente -->
                <div style="margin-top: 15px; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="aceite_termos" id="aceite_termos" style="width: auto; margin-top: 0;" <?= $aceiteTermos ? 'checked' : '' ?>>
                    <label for="aceite_termos" style="margin-top: 0; cursor: pointer;">Eu aceito os termos e condições do curso</label>
                </div>
                <!-- REQUISITO: Exibição da mensagem de erro em vermelho logo abaixo do campo -->
                <?php if (isset($erro["aceite_termos"])): ?>
                    <div class="erro"><?= $erro["aceite_termos"] ?></div>
                <?php endif; ?>

                <button type="submit">Enviar Inscrição</button>
            </form>
        </section>
    </main>
</body>

</html>
