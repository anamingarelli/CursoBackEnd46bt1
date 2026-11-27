<?php
declare(strict_types=1);

// Recebe a senha pelo terminal
$senha = readline("Digite uma senha: ");

// Gera o hash com Argon2id
$hash = password_hash($senha, PASSWORD_ARGON2ID);

// Separa os blocos do hash
$partes = explode('$', $hash);

// Apresenta as informações
echo "\n--- INSPETOR DE HASH ---\n";

echo "Algoritmo: " . $partes[1] . "\n";
echo "Versão: " . $partes[2] . "\n";
echo "Custos: " . $partes[3] . "\n";
echo "Salt codificado: " . $partes[4] . "\n";
echo "Hash final: " . $partes[5] . "\n";

echo "\nHash completo:\n";
echo $hash . "\n";
