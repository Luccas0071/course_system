## Projeto de Cadastro de Cursos

Este é um projeto de cadastro de cursos com módulos, conteúdos e usuários, além de uma parte para geração de relatórios. A aplicação foi desenvolvida utilizando Laravel para o backend e Blade para o frontend. A autenticação é realizada através de JWT, e o banco de dados utilizado é o PostgreSQL. A estrutura do projeto segue uma arquitetura de três camadas: controller, service, e repository.

## Tecnologias Utilizadas
 - Laravel: Framework PHP para desenvolvimento web
 - Blade: Template engine do Laravel para renderização do frontend
 - JWT: Para autenticação de usuários
 - PostgreSQL: Banco de dados relacional

## Funcionalidades
 - Login: Sistema divido por camada de usuário administrador e usuário padrao.
 - 
 - Cadastro de Cursos: Permite o registro de cursos, cada um contendo módulos e conteúdos.
 - Cadastro de Usuários: Controle de acesso dos usuários através de autenticação JWT.
 - Relatórios: Visualize relatórios sobre cursos, módulos e usuários cadastrados.
 - Vizualizar Conteudo: 

## Estrutura de Arquitetura
O projeto segue a arquitetura em três camadas:

 - Controller: Responsável por receber as requisições e interagir com a camada de serviço.
 - Service: Realiza a lógica de negócios e comunica-se com a camada de repositório.
 - Repository: Faz a comunicação direta com o banco de dados.

## Como Executar o Projeto
    1. Clone o repositório git
    2. Configuração do ambiente
        - Duplique o arquivo .env.example e altere o nome para .env, configure as variaveisde ambiente;
    4. Instale as dependências
        - composer install
    5. Gere a chave da aplicação
        - php artisan key:generate
    6. Execute as migrações
        - php artisan migrate
    7. Execute os seeders (Opcional) 
        - php artisan db:seed
    8. Acesse a aplicação
        - http://localhost:8000


