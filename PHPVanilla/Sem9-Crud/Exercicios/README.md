# Parte A: Exercícios Teóricos de Fixação

### Perguntas

1. **Definição de CRUD:** 

 O acrônimo CRUD significa Create, Read, Update, Delete (Criar, Ler, Atualizar e Excluir), teoricamente falando ele mapeia o ciclo de vida do dado na Álgebra Racional. A correspondência direta de cada umas das letras é:

- Create (Inserção de Tupla): Transiciona o dado da inexistência para a persistência. Mapeado no PostgreSQL pelo operador de inclusão de tupla t em uma relação R (`INSERT`).

- Read (Seleção/Projeção): Recupera dados sem alterar o estado do sistema. Mapeado pelas operações algébricas de seleção σ (linhas) e projeção π (colunas) (`SELECT`).

- Update (Mutação de Atributo): Altera o estado interno de uma tupla existente preservando sua identidade/chave primária (`UPDATE`).

- Delete (Remoção de Tupla): Remove a tupla da relação R, encerrando seu ciclo de vida no espaço de estados visível (`DELETE`).

2. **Anatomia do SQL Injection:** 

A alteração da lógica de uma consulta, quando o código utiliza concatenação de strings com `$_GET` ou `$_POST`, acontece por meio de uma vulnerabilidade clássica chamada **SQL Injection (Injeção de SQL)**. Quando o código junta duas strings para montar uma instrução SQL, o banco de dados não consegue distinguir (diferenciar) o que é a estrutura original do comando e o que é o dado enviado pelo usuário. O interpretador SQL trata tudo como uma única instrução unificada.

3. **Mecanismo das Prepared Statements:**

Primeiro o banco recebe e compila a query com os marcadores (prepare), já sabendo que eles são só dados. Depois recebe os valores (execute). Como a estrutura já está pronta, o que o usuário digitar nunca vira comando SQL: o banco apenas procura esse texto como valor.

4. **Marcadores Nomeados:**

A vantagem é a clareza e a facilidade de manutenção. Marcadores nomeados deixam claro o propósito de cada parâmetro na consulta e dispensam a necessidade de manter a ordem exata de vinculação, o que seria obrigatório e propenso a erros com o ponto de interrogação.

5. **Diferença entre Bindings:**

O método `bindValue()` vincula o valor **imediatamente**, no momento em que é chamado.
```php
$id = 10;
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$id = 20;
$stmt->execute();
```
Nesse caso, o valor utilizado será **10**, porque esse era o valor no momento do `bindValue()`.

O método `bindParam()` vincula uma variável por **referência**. O valor é lido somente quando o `execute()` é executado.
```php
$id = 10;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$id = 20;
$stmt->execute();
```
Nesse caso, o valor utilizado será **20**.

| Método | Comportamento |
| :--- | :--- |
| `bindValue()` | Guarda o valor no momento da vinculação. |
| `bindParam()` | Guarda uma referência e lê o valor no momento da execução. |

Na maioria dos casos, `bindValue()` é mais simples. O `bindParam()` pode ser útil quando a mesma variável será modificada e reutilizada em um laço (loop).

6. **Tipagem no PDO:**

Omitir o tipo de um valor que deveria ser inteiro, como em LIMIT, pode fazer o PDO tratá-lo como texto. Isso pode provocar erros, resultados inesperados ou incentivar soluções inseguras.

7. **Padrão DAO:**

O DAO separa o código responsável pelo acesso ao banco de dados das demais partes do sistema. Isso facilita a manutenção e segue o princípio da Responsabilidade Única (SRP) do SOLID.

8. **Operações de Update:**


Sem a cláusula `WHERE`, a instrução `UPDATE` altera os valores de **todas as linhas** da tabela indiscriminadamente. Em produção, isso sobrescreve dados consolidados do sistema, resultando na perda irreversível de integridade da informação.


9. **Impacto da LGPD:**

Caso ocorra vazamento de dados de clientes por falhas de segurança como SQL Injection, a empresa pode sofrer sanções administrativas da ANPD. As penalidades incluem advertências, multas que podem chegar a 2 por cento do faturamento limite de 50 milhões de reais por infração, bloqueio ou eliminação dos dados afetados, além de danos à reputação da empresa e processos judiciais promovidos pelos clientes afetados.