# Lista de Exercícios de Fixação e Prática - Conexão Banco de Dados PDO

## Parte A: Exercícios Teóricos de Fixação

1. **Abstração de Dados**: O PDO (*PHP Data Objects*) é uma extensão nativa do PHP orientada a objetos que fornece uma forma padronizada de conectar e trabalhar com diferentes bancos de dados. Em projetos corporativos, ele é preferível a extensões procedurais específicas, como o antigo `pgsql`, porque permite utilizar uma mesma estrutura de código para diferentes `SGBDs` (portabilidade), facilita o tratamento de erros por meio de exceções e oferece recursos nativos de segurança, como consultas preparadas (*Prepared Statements*).

2. **Ciclo do DSN**: A DSN (*Data Source Name*) é uma `string` de configuração que informa ao PDO qual driver utilizar, onde encontrar o servidor e qual banco de dados será acessado. No PostgreSQL, sua estrutura segue o padrão:

   ```php
   $dsn = "pgsql:host=127.0.0.1;port=5432;dbname=senai";
   ```

   - `pgsql`: Informa que o driver utilizado é o PostgreSQL.
   - `host`: Informa o endereço IP ou domínio do servidor do banco de dados.
   - `port`: Informa a porta de rede utilizada pelo serviço do PostgreSQL.
   - `dbname`: Informa o nome específico do banco de dados ao qual será feita a conexão.

3. **Padrão de Portas**: A porta padrão de escuta do SGBD PostgreSQL é a `5432`. Dentro da string de conexão (DSN), ela é referenciada pelo parâmetro `port=5432`, separado dos demais parâmetros por ponto e vírgula (`;`), logo após o `host`:

   ```php
   $dsn = "pgsql:host=localhost;port=5432;dbname=meu_banco";
   ```

4. **Flags de Integridade**: Ao definir o atributo `PDO::ATTR_ERRMODE` com o valor `PDO::ERRMODE_EXCEPTION`, o PDO passa a lançar uma exceção do tipo `PDOException` sempre que ocorre uma falha de conexão ou erro na execução de uma instrução SQL, permitindo capturar e tratar o problema de forma segura dentro de blocos `try...catch`. Caso essa flag não fosse definida, o comportamento padrão (até o PHP 7.4) seria o `PDO::ERRMODE_SILENT`, no qual o PDO apenas registra o código do erro internamente sem interromper o fluxo ou emitir alertas, exigindo verificação manual via `errorCode()` ou `errorInfo()`. *(A partir do PHP 8.0, `PDO::ERRMODE_EXCEPTION` tornou-se o comportamento padrão).*

5. **Fetch Mode**: Por padrão, o PDO utiliza o modo `PDO::FETCH_BOTH`, que retorna cada linha da consulta duplicada na memória: indexada tanto pelo nome da coluna quanto pelo índice numérico (`0`, `1`, `2`...). Ao configurar `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`, o PDO retorna apenas os índices associativos (nomes das colunas), reduzindo aproximadamente pela metade o consumo de memória RAM do servidor ao processar grandes volumes de registros.

6. **Padrão Singleton**: No PostgreSQL, cada chamada a `new PDO()` abre uma nova conexão TCP/IP e aloca um processo exclusivo do sistema operacional no servidor de banco de dados. Se a aplicação instanciar uma nova conexão a cada consulta executada (especialmente dentro de laços de repetição ou sob múltiplos acessos simultâneos), os *slots* disponíveis rapidamente atingirão o limite configurado em `max_connections` no arquivo `postgresql.conf`, fazendo com que o servidor recuse novas requisições com o erro fatal *"too many clients already"*.

7. **Encapsulamento do Singleton**: O construtor (`__construct()`) da classe `ConexaoBanco` precisa ser declarado como `private` para impedir que códigos externos criem instâncias diretamente com o operador `new`, obrigando o uso do método estático centralizador (`getInstance()`). Além dele, dois métodos mágicos devem ser bloqueados para garantir a unicidade da instância:
   - `__clone()`: Declarado como `private` (ou lançando exceção) para impedir que o objeto de conexão seja duplicado com o comando `clone`.
   - `__wakeup()` (e `__unserialize()`): Bloqueado com lançamento de exceção para impedir que uma nova instância independente seja recriada caso o objeto seja desserializado com `unserialize()`.

8. **Segurança de Credenciais**: Deixar usuário e senha do banco salvos de forma estática (*hardcoded*) nos scripts PHP expõe a aplicação a falhas graves de segurança:
   - **Vazamento em repositórios**: Ao enviar o código para sistemas de versionamento (Git/GitHub), as credenciais ficam visíveis no histórico do projeto.
   - **Exposição por falha no servidor**: Caso o servidor web sofra uma má configuração e entregue o arquivo `.php` como texto puro, as senhas ficarão expostas publicamente.
   - **Dificuldade de manutenção**: Dificulta a separação entre ambientes (desenvolvimento, homologação e produção) e obriga a modificar o código-fonte a cada troca de senha. O recomendado é armazená-las em variáveis de ambiente (arquivos `.env` fora da pasta pública).

9. **Tratamento de Exceções & LGPD**: Exibir diretamente `$e->getMessage()` na tela do navegador configura uma falha de **Information Disclosure** (exposição indevida de informações), pois a mensagem interna do `PDOException` costuma revelar o SGBD utilizado, endereço IP do host, nome do banco, usuário, estrutura de tabelas/colunas e caminhos de diretórios do servidor. Atacantes utilizam esses detalhes para estruturar ataques direcionados (como *SQL Injection* avançado) que podem resultar no vazamento de dados pessoais, violando os princípios de segurança e prevenção exigidos pela **LGPD** (Lei Geral de Proteção de Dados).