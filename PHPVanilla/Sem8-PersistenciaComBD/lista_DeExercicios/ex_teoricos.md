## Parte A: Exercícios Teóricos de Fixação

1. **Abstração de Dados**: O PDO(PHP Data Objects) é uma extensão ddo PHP que fornece uma forma padronizada de conectar e trabalhar com diferentes banco de dados. Ele é preferível a extensões procedurais específicas, como o antigo `pgsql`, porque permite utilizar uma mesma estrutura de código para diferentes `SGBDS`, facilita o tratamento de exceções e oferece recursos de segurança, como consultas preparadas.

2. **Ciclo Do DNS**: A DNS (Data Source Name) é uma `string` que informa ao PDO onde e como encontrar o banco de dados.
No PostGreSQL, podemos ter:
```sql
$dsn = "pgsql:host=127.0.0.1;port=5432;dbname=senai"; 
```
- `pgsql`: informa que o driver utilizadp é o PostgreSQL.
- `host`: Informa o endereço do servidor do bando de dados
- `port`: Informa a porta utilizada pelo PostgreSQL
- `dbname`: Informa o nome do banco de dados ao qual será feita a conexão.