<?php

declare(strict_types=1);

// Banco precisa de uma sistema que calcule os Juros Compostos mês a mês. 
// Regras de Negócio:
// Classificação de Risco: O sistema deve avaliar a Categoria do Cliente ('A', 'B', 'C') utilizando a estrutura match e definir a taxa de juros:
// Categoria 'A' ➔ Juros de 0.01 (1% ao mês)
// Categoria 'B' ➔ Juros de 0.02 (2% ao mês)
// Categoria 'C' ➔ Juros de 0.03 (3% ao mês)
// Qualquer outra coisa (default) ➔ Juros de 0.05 (5% - Risco Máximo)

// Valor inicial da dívida que será usado para fazer a projeção
$divida = 1000.00;

// Guarda a categoria do cliente para definir o seu nível de risco
$categoriaCliente = "A";

// O match foi usado porque precisamos verificar a categoria do cliente e escolher uma taxa de juros diferente para cada uma delas
$taxa = match ($categoriaCliente) {
    "A" => 0.01, // Categoria A: 1% de juros
    "B" => 0.02, // Categoria B: 2% de juros
    "C" => 0.03, // Categoria C: 3% de juros

    // Se a categoria não for A, B ou C, será aplicada a taxa de 5%
    default => 0.05
};

// Mostra na tela a categoria e a taxa que foram definidas
echo "Categoria do cliente: $categoriaCliente<br>";
echo "Taxa de juros: " . ($taxa * 100) . "% ao mês<br><br>";

// O for foi usado porque precisamos repetir o cálculo uma quantidade determinada de vezes: 12 meses
for ($mes = 1; $mes <= 12; $mes++) {

    // O if verifica se o mês atual é o sexto, pois esse mês possui a regra especial de anistia
    if ($mes == 6) {

        // Informa que no sexto mês não haverá cobrança de juros
        echo "Mês 6 - Isenção de juros<br>";

        // O continue foi usado para pular o cálculo dos juros do sexto mês e continuar a repetição no mês seguinte
        continue;
    }

    // Calcula os juros usando a dívida atual e a taxa definida
    $juros = $divida * $taxa;

    // Adiciona os juros à dívida para atualizar o saldo
    $divida += $juros;

    // Mostra os valores calculados de cada mês
    echo "Mês $mes - Juros: R$ $juros";
    echo " - Dívida: R$ $divida<br>";
}

?>