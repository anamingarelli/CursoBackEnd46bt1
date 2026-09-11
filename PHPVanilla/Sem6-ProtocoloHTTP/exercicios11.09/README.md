# Parte A: Exercícios Teóricos de Fixação

### 1.  **Diferença Estrutural:** Explique a diferença física entre onde os dados são anexados em uma requisição `GET` e em uma requisição `POST`. 

 No método **GET**, os dados são anexados na URL depois do `?` e ficam totalmente visíveis na barra de endereços do navegador    
>exemplo: `produtos.php?nome=Notebook&preco_maximo=3000`
Já no metódo **POST**, os dados são enviados no corpo da requisição HTTP (`BODY`), não aparecendo na URL.

### 2. **Segurança e Privacidade:** Por que senhas de usuário nunca devem ser enviadas via método `GET`? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura.

As Senhas não devem ser enviadas por **GET** porque os dados ficam visíveis na URL e podem ser armazenados em locais como:

- Histórico de navegador: A URL com a senha fica salva no dispositivo do usuário.
- Logs de Servidor Web: O seridor registra a URL completa em arquivos de texto acessíveis por administradores.

    Por isso, para envios de senhas, normalmente utilizamos o **POST** e, em aplicações reais, também **HTTPS**.

### 3 .**Coalescência Nula:** Por que a instrução `$nome = $_POST['nome'];` dispara um `Warning` na primeira vez que a página é carregada no navegador? Como o operador `??` resolve isso? 

 Quando a página é aberta pela primeira vez, ainda não existe nenhum formulário enviado. Portanto, a chave `nome` ainda não existe dentro de `$_POST`.
>exemplo: `$_POST['nome'];` -> Pode gerar um `Warning: Undefined array key "nome".` Assim, na primeira abertura de página, a variável "nome"(`$nome`) recebe uma string vazia e não aparece o "Warning".

### 4.  **Idempotência:** O que significa dizer que uma requisição `GET` é idempotente? Por que atualizar ou deletar dados no banco usando links `GET` é uma má prática de segurança?

 Dizer que uma requisição **GET** é idempotente significa que realizar a mesma requisição várias vezes deve produzir o mesmo efeito no servidor. Por exemplo, consultar:
`/produto.php?id=10`
Isso pode ser feito várias vezes sem alterar o produto. Usar **GET** para atualizar ou deletar dados é uma má prática porque links podem ser acessados automaticamente, compartilhados, armazenados em histórico ou acionados por mecanismos como pré-carregamento. Uma ação que altera dados deve usar um método apropriado, como POST, e ter validações de segurança.

### 5. **Validação Client vs Server:** Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou `required` e `type="email"` em todas as tags HTML. Explique por que essa afirmação é falsa.

 A afirmação é falsa porque `required e type="email"` são validações feitas principalmente pelo navegador (client-side). 

O usuário pode desabilitar o HTML5 ou enviar uma requisição diretamente para o servidor sem passar pelo formulário. 

Por isso, o PHP precisa fazer a validação `server-side` também.

##  6. **XSS e Sanitização:** Qual é o risco de exibir dados vindos de um `$_POST` diretamente na tela sem utilizar `htmlspecialchars()`?

Se dados enviados pelo usuário forem exibidos diretamente na página, alguém pode tentar inserir código HTML ou JavaScript no formulário. 

Por exemplo, um usuário poderia enviar: 

`<script>alert('teste')</script>`

Se esse conteúdo for exibido diretamente, pode ocorrer um ataque de XSS (Cross-Site Scripting). 

Para evitar que o navegador interprete o conteúdo como HTML, usamos: `htmlspecialchars($nome) `

### 7. **Sticky Forms**: O que é a técnica de Sticky Forms e qual é o seu impacto na experiência do usuário (UX)?

**Sticky Forms** é uma técnica que mantém no formulário os dados que o usuário já digitou, principalmente quando ocorre algum erro de validação. 

Por exemplo, se o usuário preenche 5 campos e erra apenas um, não precisa preencher tudo novamente. 

Isso melhora a experiência do usuário (UX) e deixa o formulário mais confortável de usar.  

### 8. **DevTools**: Como você utilizaria a aba Network do navegador para comprovar que um formulário foi enviado via POST e não via GET?

Para verificar se um formulário foi enviado por POST eu: 

- Abriria o navegador.  

- Pressionaria F12.  

- Entraria na aba Network.  

- Enviaria o formulário.  

- Clicaria na requisição criada.  

- Verificaria o campo Request Method.  

Se aparecer: 

`Request Method: POST` 

o formulário foi enviado usando POST. 

Se fosse GET, apareceria: 
`Request Method: GET`