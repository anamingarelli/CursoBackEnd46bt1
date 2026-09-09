<?php
declare(strict_types=1);

// Remove pontos e traço do CPF
function limparCPF(string $cpf): string {
    return str_replace([".", "-"], "", $cpf);
}

// Verifica se o CPF possui 11 números
function cpfValido(string $cpf): bool {
    return strlen($cpf) === 11 && is_numeric($cpf);
}

// CPF para teste
$cpf = "123.456.789-00";

$cpfLimpo = limparCPF($cpf);

echo "CPF limpo: " . $cpfLimpo . "<br>";

if (cpfValido($cpfLimpo)) {
    echo "CPF válido";
} else {
    echo "CPF inválido";
}
?>