<!-- Exercício 3: Folha de Pagamento do RH -->

<?php
$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End ", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva ", "cargo" => "Estagiário", "salario" => 1500.00],
];

$totalFolha = 0;

?>

<table> 
    <thead> 
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Salário</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($funcionarios as $func): ?>
            <?php
            $totalFolha += $func['salario'];
            ?>
            <tr>
                <td><?= $func['id'] ?></td>
                <td><?= $func['nome'] ?></td>
                <td><?= $func['cargo'] ?></td>
                <td>R$ <?=  number_format($func['salario'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"> Total da Folha: </td>
            <td> R$ <?= number_format($totalFolha, 2, ',', '.')  ?></td>
        </tr>
    </tfoot>
</table>