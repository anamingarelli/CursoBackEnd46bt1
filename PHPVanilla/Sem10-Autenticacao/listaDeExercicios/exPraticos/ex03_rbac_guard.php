<?php
declare(strict_types=1);

// Inicia a sessão
session_start();

// Verifica o nível de permissão do usuário
function verificarPermissao(string $perfilMinimo): void
{
    $niveis = [
        'OPERADOR' => 1,
        'ADMIN' => 2
    ];

    $perfil = $_SESSION['perfil'] ?? '';

    if (!isset($niveis[$perfilMinimo]) ||
        !isset($niveis[$perfil]) ||
        $niveis[$perfil] < $niveis[$perfilMinimo]) {

        http_response_code(403);

        echo "<h1>Acesso negado!</h1>";
        echo "<p>Você não possui permissão para acessar esta página.</p>";

        exit;
    }
}

// Verifica se existe um usuário autenticado
if (!isset($_SESSION['usuario'])) {
    http_response_code(401);
    exit("Você precisa realizar o login.");
}

// Permite acesso somente ao administrador
verificarPermissao('ADMIN');

echo "<h1>Relatórios gerenciais</h1>";
echo "<p>Bem-vindo ao painel administrativo!</p>";