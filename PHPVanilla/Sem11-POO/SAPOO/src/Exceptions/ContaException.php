<?php
declare(strict_types=1);

//Classe base para erros das regras de negócio

class ContaException extends DomainException { // herança da base de erros do sistema
    // Declaração do contrutor usando property promotion
    #[Override] // reescrevendo o construtor
    public function __construct(string $message = "Falha na Operação Bancária!")
    {
        parent::__construct($message);
    }
}
?>