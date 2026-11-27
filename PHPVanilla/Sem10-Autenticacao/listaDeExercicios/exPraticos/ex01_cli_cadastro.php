<?php
declare(strict_types=1);

// Classe responsável pelo acesso aos usuários
class UsuarioDAO
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrar(string $nome, string $email, string $hash): bool
    {
        $sql = "INSERT INTO usuarios (nome, email, senha_hash)
                VALUES (:nome, :email, :senha)";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $hash
        ]);
    }
}

// Realiza a conexão com o PostgreSQL
try {
    $pdo = new PDO(
        "pgsql:host=127.0.0.1;port=5432;dbname=peca_senai",
        "postgres",
        "postgres"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dao = new UsuarioDAO($pdo);

    // Recebe os dados pelo terminal
    $nome = trim(readline("Digite o nome: "));
    $email = trim(readline("Digite o e-mail: "));
    $senha = readline("Digite a senha: ");

    // Valida os dados informados
    if (strlen($nome) > 80 || strlen($email) > 100 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Nome ou e-mail inválido!\n");
    }

    // Verifica a complexidade da senha
    $padrao = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/';

    if (!preg_match($padrao, $senha)) {
        exit("Senha não atende aos requisitos de segurança!\n");
    }

    // Gera o hash utilizando Argon2id
    $hash = password_hash($senha, PASSWORD_ARGON2ID);

    // Realiza o cadastro
    $dao->cadastrar($nome, $email, $hash);

    echo "Colaborador cadastrado com sucesso!\n";

} catch (PDOException $erro) {
    echo "Erro ao cadastrar colaborador: " . $erro->getMessage() . "\n";
}
