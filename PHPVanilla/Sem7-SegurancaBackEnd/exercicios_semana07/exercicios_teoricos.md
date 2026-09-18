## LISTA DE EXERCÍCIOS: SEGURANÇA E HIGIENIZAÇÃO DE DADOS 

**Perguntas**

1º **Conceituação OWASP**: A sigla `XSS` significa *Cross-Site* Scripting. É uma vulnerabilidade que permite que um código malicioso seja inserido em uma página e executado no navegador da vítima. É considerada uma vulnerabilidade do lado do cliente (*Client-Side*) porque o código acaba sendo executado no navegador do usuário. Mesmo assim, o Back-End deve prevenir o problema, principalmente validando os dados recebidos e codificando corretamente as informações antes de enviá-las para o navegador.

2º **Reflected vs Stored**: A O XSS Refletido acontece quando o código malicioso é enviado em uma requisição e imediatamente refletido na resposta da página, normalmente sem ficar armazenado no servidor. Já o XSS Stored (Gravado) acontece quando o código malicioso é salvo no sistema, por exemplo, em um comentário ou cadastro, e depois é exibido para outros usuários. O `XSS Stored` pode ter um impacto maior, pois o código fica armazenado e pode ser executado para várias pessoas que acessarem o conteúdo afetado. Assim, o alcance do ataque pode ser maior dentro de uma empresa.

3ª **Mecanismo de Escapamento**: A função `htmlspecialchars()` transforma caracteres especiais do HTML em entidades HTML. Por exemplo:

< -> `&lt;`
> -> `&gt;`

Dessa forma, se o usuário tentar enviar algo como uma tag HTML, os caracteres `<` e `>` deixam de ser interpretados pelo navegador como parte de uma tag. O navegador passa a exibir aquele conteúdo como texto, em vez de interpretar e executar o código HTML ou JavaScript.

4ª **Flags de Proteção**:A flag `ENT_QUOTES` faz com que a função `htmlspecialchars()` também converta aspas simples `(')` e aspas duplas `(")` em entidades *HTML*.

Isso é importante principalmente em campos como: 

```php
<input value="...">
```

> Se as aspas não forem tratadas corretamente, um valor fornecido pelo usuário pode tentar fechar o atributo `value` e adicionar outro atributo ou código HTML. Por isso, usar `ENT_QUOTES` aumenta a proteção ao colocar dados do usuário dentro de atributos HTML.

5º **Anti-Alucinação PHP**: Não devemos utilizar `FILTER_SANITIZE_STRING` em projetos modernos com PHP 8.3 porque esse filtro foi descontinuado (deprecated) no PHP 8.1 e removido nas versões posteriores. Portanto, em PHP moderno, devemos utilizar técnicas específicas para cada situação, *como validação dos dados na entrada* e `htmlspecialchars()` na saída, em vez de depender desse filtro.

6º **Validação de E-mail**: `empty($email)` apenas verifica se a variável está vazia ou possui um valor considerado vazio. Ela *não verifica se o contéudo realmente possui um formato do e-mail válido.
 Já:

```php
filter_var($email, FILTER__VALIDATE_EMAIL)
```
> Verifica se o valor possui um formato reconhecido como e-mail válido.

Por exemplo, `"ana"` pode não estar vazio, mas não possui formato de e-mail. Portanto, `empty()` pode aceitar o valor, enquanto `FILTER_VALIDATE_EMAIL` pode rejeitá-lo.

7ª **Roubo de Sessão**: Em determinadas situações, uma brecha XSS pode permitir que um atacante execute JavaScript no navegador de um usuário. Se o cookie de sessão estiver acessível por JavaScript, por exemplo, sem a proteção `HttpOnly`, esse código pode tentar acessar o cookie e enviá-lo para um servidor controlado pelo atacante.

Com o cookie de sessão, o atacante pode tentar se passar pelo usuário logado. Por isso, além de prevenir XSS, é importante utilizar proteções nos cookies, como `HttpOnly`, `Secure` e configurações adequadas de `SameSite`.

8ª **Segurança em Camadas**: Sanitizar os dados na entrada, por exemplo usando `strip_tags()` não substitui a codificação na saída com `htmlspecialchars()`.

Isso acontece porque um mesmo dado pode ser utilizado em diferentes contextos. A melhor prática é validar os dados de acordo com o que o sistema espera e, quando o dado for colocado dentro de HTML, codificá-lo na saída.

Por exemplo:
```php
echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
```

Assim, mesmo que algum conteúdo perigoso tenha conseguido passar pela etapa de entrada, ele será tratado como texto quando for exibido no HTML. Essa abordagem cria uma segurança em camadas, reduzindo o risco de XSS.