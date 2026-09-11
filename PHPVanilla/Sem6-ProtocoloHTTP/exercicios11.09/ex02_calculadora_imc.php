<?php
// aplicação de página unica de variaveis superglobais ($_POST, $_SERVER)
declare(strict_types=1);

// REQUISITO: Função calcularIMC (Máximo 10 linhas)
function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

// REQUISITO: Função classificarIMC (Máximo 15 linhas)
function classificarIMC(float $imc): string {
    if ($imc < 18.5) return 'Abaixo do peso';
    if ($imc < 25.0) return 'Normal';
    if ($imc < 30.0) return 'Sobrepeso';
    return 'Obesidade';
}

//Declarar algumas Variáveis (Padrão do seu primeiro código)
$mensagemSucesso = "";
$erro = [];

$nome = "";
$pesoTexto = "";
$alturaTexto = "";
$classeImc = ""; // Variável auxiliar para o estilo condicional CSS

//Processamento do POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Recuperar os Dados de um Formulário
    $nome = trim((string) ($_POST["nome"] ?? ""));
    $pesoTexto = trim((string) ($_POST["peso"] ?? ""));
    $alturaTexto = trim((string) ($_POST["altura"] ?? ""));

    // Validação do Servidor (Seguindo o padrão do seu primeiro código)
    if (strlen($nome) < 3) {
        $erro["nome"] = "Informe um nome com pelo menos 3 caracteres";
    }

    // REQUISITO: Validação do Peso (float positivo entre 20 e 300)
    $peso = filter_var($pesoTexto, FILTER_VALIDATE_FLOAT);
    if ($peso === false || $peso < 20.0 || $peso > 300.0) {
        $erro["peso"] = "O peso deve ser um valor numérico entre 20 e 300 kg";
    }

    // REQUISITO: Validação da Altura (float positivo entre 0.5 e 2.5)
    $altura = filter_var($alturaTexto, FILTER_VALIDATE_FLOAT);
    if ($altura === false || $altura < 0.5 || $altura > 2.5) {
        $erro["altura"] = "A altura deve ser um valor numérico entre 0.5 e 2.5 m";
    }

    //SE não existir erros, o cálculo será realizado
    if ($erro === []) {
        $imc = calcularIMC((float)$peso, (float)$altura);
        $classificacao = classificarIMC($imc);
        
        // Define a classe do CSS com base no resultado para o estilo condicional
        $classeImc = strtolower($classificacao);
        if ($classeImc === 'abaixo do peso') $classeImc = 'normal'; // Opcional: define cor para abaixo do peso

        $mensagemSucesso = sprintf(
            "Olá %s! Seu IMC é %.2f e sua classificação é: <strong>%s</strong>",
            htmlspecialchars($nome),
            $imc,
            $classificacao
        );
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Calculadora de IMC</h1>

        <section>
            <h2>Insira seus dados</h2>
            <p>Os dados serão enviados no corpo da requisição usando POST</p>

            <!-- REQUISITO: Exibição do resultado com estilo condicional baseado na classificação -->
            <?php if ($mensagemSucesso !== "") : ?>
                <div class="sucesso imc-<?= $classeImc ?>">
                    <?= $mensagemSucesso ?>
                </div>
            <?php endif; ?>

            <!-- REQUISITO: Formulário POST com os dados mantidos preenchidos (Sticky Form) -->
            <form action="ex02_calculadora_imc.php" method="POST" novalidate>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu Nome" value="<?= htmlspecialchars($nome) ?>">
                <?php if (isset($erro["nome"])): ?>
                    <div class="erro"><?= $erro["nome"] ?></div>
                <?php endif; ?>

                <label for="peso">Peso (kg)</label>
                <input type="number" name="peso" id="peso" step="0.1" placeholder="Ex: 75.5" value="<?= htmlspecialchars($pesoTexto) ?>">
                <?php if (isset($erro["peso"])): ?>
                    <div class="erro"><?= $erro["peso"] ?></div>
                <?php endif; ?>

                <label for="altura">Altura (m)</label>
                <input type="number" name="altura" id="altura" step="0.01" placeholder="Ex: 1.75" value="<?= htmlspecialchars($alturaTexto) ?>">
                <?php if (isset($erro["altura"])): ?>
                    <div class="erro"><?= $erro["altura"] ?></div>
                <?php endif; ?>

                <button type="submit">Calcular IMC</button>
            </form>
        </section>
    </main>
</body>

</html>
