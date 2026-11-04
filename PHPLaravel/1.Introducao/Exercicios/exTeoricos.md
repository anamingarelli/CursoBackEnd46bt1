LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA

### Parte A: Questões Teóricas de Fixação

1. **Evolução Arquitetural:** Quais foram os principais aprendizados técnicos obtidos na construção do MVC artesanal da Semana 12 que permitiram que você compreendesse o Laravel 11 com facilidade?

R: A construção de um MVC artesanal consolida o entendimento do padrão Front Controller (onde uma única porta de entrada `index.php` processa todas as requisições), a implementação manual de roteamento, autocarregamento de classes via PSR-4, injeção de dependências e a separação de responsabilidades (camadas de apresentação, lógica e dados). Compreender esses mecanismos fundamentais desmistifica a "mágica" do Laravel, facilitando a navegação por seus *Service Providers, Facades e Container de Serviços*.

2. **A Nova Arquitetura do Laravel 11:** O que mudou na estrutura de inicialização do Laravel 11 em relação às versões anteriores (Laravel 9 e 10)? Onde fica o novo ponto central de configuração?

R: O Laravel 11 enxugou a estrutura de diretórios padrão, removendo pastas e arquivos como `app/Http/Middleware/`,`app/Console/Kernel.php` e `app/Exceptions/Handler.php`. O novo ponto central de inicialização e configuração é o arquivo `bootstrap/app.php`, que utiliza a API fluida `Application::configure()` para registrar rotas, middlewares, comandos de console e tratadores de exceção em um único local.

3. **Padrão 12-Factor App:** Por que é uma violação grave de segurança gravar senhas de banco de dados diretamente dentro do arquivo `config/database.php` em vez de utilizar o arquivo `.env`?

R: O 12-Factor App estabelece a separação estrita entre código e configuração. Gravar credenciais no  `config/database.php` resulta na exposição de segredos no repositório de código-fonte (Git), permitindo acesso não autorizado por qualquer pessoa com acesso ao projeto. Além disso, inviabiliza a execução do mesmo código em múltiplos ambientes (desenvolvimento, homologação e produção) com credenciais distintas sem alterar o código-fonte.

4. **O Papel da `APP_KEY`:** Qual é o risco técnico de alterar a `APP_KEY` de uma aplicação que já está em produção há meses com usuários reais cadastrados?

R: A `APP_KEY` é a chave simétrica utilizada pelo ecossistema de criptografia do Laravel (AES-256 ou AES-128) para assinar cookies, encriptar sessões e proteger dados armazenados via `Crypt::encryptString()`. Alterar essa chave em produção fará com que todas as sessões ativas sejam invalidadas e todos os dados gravados no banco de dados que utilizem a criptografia nativa se tornem indecriptáveis, gerando exceções do tipo `DecryptException`.

5. **Isolamento de Diretórios:** Por que um servidor web de produção (Nginx/Apache) deve apontar rigorosamente para a pasta `public/` e nunca para a raiz do projeto Laravel?

R: Apontar o servidor web para a pasta `public/` garante que apenas arquivos estáticos públicos (CSS, JS, imagens) e o `index.php` fiquem acessíveis via HTTP. Se o servidor apontar para a raiz do projeto, arquivos confidenciais como `.env` (contendo senhas e chaves), logs (`storage/`), dependências (`vendor/`) e o próprio código-fonte poderão ser baixados ou lidos diretamente pela web:
```bash
([https://site.com/.env]
(https://site.com/.env))
```

6. **Artisan CLI:** Qual é a diferença prática entre executar um script PHP procedural com `php arquivo.php` e executar comandos através do `php artisan`?

R: Executar `php arquivo.php` roda um script PHP isolado em modo CLI sem carregar a infraestrutura do framework. Já o `php artisan` inicializa todo o ecossistema do Laravel (carrega o `.env`, inicializa o container de dependências, registra os *Service Providers*, conecta ao banco de dados Eloquent e disponibiliza a suíte de comandos Symfony Console), permitindo interagir diretamente com todas as classes e serviços da aplicação.

7. **O Arquivo `.env.example`:** Por que manter o arquivo `.env.example` sempre atualizado é indispensável para o sucesso de equipes de desenvolvimento que utilizam Git?

R: Como o arquivo `.env` contém credenciais locais/sensíveis e é ignorado pelo Git (`.gitignore`), o `.env.example` serve como a especificação de contrato de ambiente do projeto. Mantê-lo atualizado garante que outros desenvolvedores da equipe ou ambientes de integração contínua (CI/CD) saibam exatamente quais chaves e variáveis precisam ser configuradas para o funcionamento do sistema.

8. **Motor de Templates Blade:** Qual é a diferença entre a diretiva Blade `{{ $variavel }}` e a diretiva `{!! $variavel !!}` em termos de proteção contra ataques Cross-Site Scripting (XSS)?

R: A diretiva `{{ $variavel }}` aplica automaticamente a função PHP `htmlspecialchars()`, convertendo caracteres especiais HTML (como < e >) em entidades seguras para prevenir ataques de Cross-Site Scripting (XSS). A diretiva `{!! $variavel !!}` exibe o conteúdo bruto (raw) sem sanitização; se usada com dados não confiáveis inseridos por usuários, permite a injeção e execução de scripts maliciosos no navegador.

9. **Responsabilidade do Controller:** Em uma aplicação profissional com Laravel, por que um método de Controller deve ser curto (≤ 20 linhas) e não deve conter consultas SQL cruas ou regras de negócio extensas?

R: O Controller deve atuar estritamente como um orquestrador HTTP (receber a requisição, validar dados com Form Requests, delegar a execução para a camada de domínio e retornar uma resposta/view). Controllers extensos ("Fat Controllers") violam o princípio SRP (Single Responsibility Principle), dificultam a criação de testes unitários automatizados, impedem a reusabilidade do código (ex.: reaproveitar lógica entre API e Web) e aumentam drasticamente o custo de manutenção.

10. **A Ferramenta Tinker:** Para que serve o comando `php artisan tinker` e em quais situações ele economiza tempo do desenvolvedor durante testes de laboratório?

R: O `php artisan tinker` é um REPL (*Read-Eval-Print Loop*) interativo alimentado pelo PsySH que executa código PHP com todo o contexto do Laravel carregado. Ele economiza tempo durante testes de laboratório ao permitir testar rapidamente consultas do Eloquent, relacionamentos de Models, disparo de Jobs ou Events e validação de métodos de serviço diretamente pelo terminal, sem a necessidade de criar rotas temporárias ou atualizar a interface gráfica no navegador.

---