# Lista de Exercícios de Fixação e Prática – Controllers e Routes no Laravel

## Parte A – Questões Teóricas de Fixação

### 1. Semântica RESTful

Uma ação de exclusão nunca deve utilizar uma requisição HTTP do tipo GET porque esse método deve ser utilizado apenas para consultar informações, sem modificar os dados do sistema. Caso a exclusão seja realizada por GET, robôs de busca e outros serviços automáticos podem acessar a URL e executar a exclusão sem a intenção do usuário, causando perda de informações.

### 2. Idempotência

Idempotência significa que realizar a mesma requisição várias vezes deve produzir o mesmo resultado final que realizá-la apenas uma vez. O método PUT é considerado idempotente porque enviar a mesma atualização várias vezes mantém o recurso no mesmo estado. Já o POST não é idempotente, pois cada requisição pode criar um novo registro, gerando dados duplicados.

### 3. Resource Controllers

O comando `php artisan make:controller NomeController --resource` cria um controller com sete ações principais:

- **index():** apresenta a listagem dos registros.
- **create():** exibe o formulário de cadastro.
- **store():** recebe e salva um novo registro.
- **show():** apresenta os detalhes de um registro específico.
- **edit():** exibe o formulário de edição.
- **update():** atualiza um registro existente.
- **destroy():** exclui um registro.

Essas ações seguem o padrão REST e facilitam a organização das operações CRUD.

### 4. Injeção de Dependências

O Service Container do Laravel é responsável por gerenciar e fornecer automaticamente as dependências necessárias para os métodos dos controllers. Quando declaramos `Request $request` como parâmetro de um método, o Laravel identifica o tipo solicitado e entrega uma instância da requisição atual, sem a necessidade de utilizar `new Request()`.

### 5. Method Spoofing

Os formulários HTML convencionais permitem enviar requisições utilizando principalmente os métodos GET e POST. Para utilizar PUT, PATCH ou DELETE, o Laravel oferece o recurso Method Spoofing, por meio da diretiva Blade `@method()`. Ela cria um campo oculto que informa ao Laravel qual método HTTP deve ser considerado na requisição.

### 6. Ataques CSRF

Cross-Site Request Forgery (CSRF) é um tipo de ataque em que um site malicioso tenta induzir um usuário autenticado a realizar uma ação em outro sistema sem sua autorização. No Laravel, a diretiva `@csrf` gera um token de segurança exclusivo para a sessão. Esse token é enviado junto ao formulário e verificado pelo sistema, dificultando a falsificação de requisições.

### 7. Constraints de Rota

As constraints são utilizadas para limitar os formatos dos parâmetros recebidos pelas rotas. Por exemplo, `whereNumber('id')` permite apenas valores numéricos, enquanto `whereAlphaNumeric('codigo')` aceita letras e números. Quando o parâmetro não corresponde ao formato definido, a rota não é encontrada e o Laravel retorna o código HTTP 404 (Not Found).

### 8. Rotas Nomeadas

As rotas nomeadas oferecem vantagens como a facilidade de manutenção e a organização do código. Utilizando `route('clientes.show', $id)`, o Laravel gera automaticamente a URL correspondente à rota cadastrada. Assim, caso o endereço da rota seja alterado, não é necessário modificar manualmente todos os links espalhados pelas views.

### 9. Single Responsibility no Controller

A validação deve ser mantida organizada e objetiva para que cada método tenha uma responsabilidade bem definida. Utilizar `$request->validate()` ou Form Requests ajuda a separar a validação do restante da lógica da aplicação. Isso facilita a leitura, a manutenção e a reutilização do código, além de contribuir para manter os métodos curtos, respeitando o limite de 20 linhas estabelecido na atividade.

### 10. A Ferramenta route:list

O comando `php artisan route:list` apresenta todas as rotas cadastradas na aplicação, incluindo seus métodos HTTP, endereços, nomes e controllers responsáveis. Essa ferramenta facilita a documentação, a conferência e a auditoria dos endpoints, permitindo que os integrantes da equipe identifiquem quais funcionalidades estão disponíveis e como acessá-las.

