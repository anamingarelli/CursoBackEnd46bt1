<?php
declare(strict_types=1);

// Remove espaços e formata o nome
function formatarNome(string $nome): string {
    $nome = trim($nome);
    $nome = strtolower($nome);
    return ucfirst($nome);
}

// Testes
echo formatarNome("  ANA  ") . "<br>";
echo formatarNome("JOÃO") . "<br>";
echo formatarNome("  maria  ");
?>