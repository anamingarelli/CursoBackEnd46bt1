<?php
declare(strict_types=1);

// Verifica se a senha possui mais de 8 caracteres
function senhaForte(string $senha): bool {
    return strlen($senha) > 8;
}

// Testes
$senha1 = "123456789";
$senha2 = "abc123";

if (senhaForte($senha1)) {
    echo "Senha 1: senha forte<br>";
} else {
    echo "Senha 1: senha fraca<br>";
}

if (senhaForte($senha2)) {
    echo "Senha 2: senha forte";
} else {
    echo "Senha 2: senha fraca";
}
?>