<?php
declare(strict_types=1);

// Isolar as operações de busca e cadastro de usuários
// Nessa camada é aplicado o hash de senha`password_hash()`;
final class UsuarioDAO{
    //Atributos
    private PDO $pdo; // Atributo de conexão com o banco

    // Construtor => permite instanciaar obj dessa classe
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    // Métodos 
    // Cadastrar => com cryptografia
    public function cadastrar(
            string $nome, string $email, string $senha, string $perfil = "OPERADOR"
            ):bool{
        $sql = "INSERT INTO usuarios (nome, email, senha_hash, perfil) 
                VALUES (:nome, :email, :hash, :perfil)";
        
        $stmt = $this->pdo->prepare($sql);
        // Fazer o algoritmo de hash da senha
        $algoritmo = defined ("PASSWORD_ARGON2ID") ?
        PASSWORD_ARGON2ID : PASSWORD_BCRYPT;
        $hash = password_hash($senha, $algoritmo); //vai criar senha cryptografada
        return $stmt->execute([
            ":nome"     =>trim($nome),
            ":email"    =>strtolower(trim($email)),
            ":hash"     => $hash,
            ":perfil"   => $perfil
        ]);
    }

    //buscar por Email
    public function buscarPorEmail(string $email): ?array{
        $sql = "SELECT * FROM usuarios
                WHERE "

    }

}