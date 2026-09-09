<!-- Exercício 2: Perfil do Usuário -->

<?php
$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];

?> 

    <div class="mini-card">
    <div class="perfil-conteudo"> 

        <h3> 
            <?= $usuario['nome'] ?>
            <?= $usuario['premium']? '⭐' : '' ?>
        </h3>
        
        <p>Idade: <?= $usuario['idade'] ?> anos</p>

        <p class="localizacao"><?= $usuario['cidade'] . " - " . $usuario['estado'] ?></p>
        
        
        
    </div>
</div>
    
</body>
</html>

