# API de Gerenciamento de Tarefas com Laravel e Vue.js

Este projeto é uma aplicação web completa para gerenciamento de tarefas, construída com Laravel 10 para o backend e Vue.js 3 para o frontend. Ele permite que usuários autenticados criem, visualizem, editem, excluam e marquem suas tarefas como concluídas.

## Funcionalidades Principais

### Backend (Laravel):

- **Autenticação:**
    - Registro de novos usuários com validação de dados.
    - Login seguro com tokens Sanctum.
    - Logout para encerrar a sessão do usuário.

- **Gerenciamento de Tarefas (CRUD):**
    - Criar novas tarefas com título, descrição e data de vencimento (opcional).
    - Listar todas as tarefas do usuário autenticado.
    - Visualizar os detalhes de uma tarefa específica.
    - Editar tarefas existentes.
    - Excluir tarefas.
    - Marcar tarefas como concluídas, atualizando automaticamente a data de conclusão.

- **Validação:**
    - Utiliza Form Requests para validar os dados de entrada das requisições.
    - Validação customizada para garantir que a data de vencimento seja uma data futura.

- **Recursos (Resources):**
    - Formatação das respostas da API em um formato consistente e legível.

- **Testes:**
    - Testes de funcionalidades (Feature Tests) com PEST para garantir o funcionamento correto das rotas de autenticação e tarefas.
    - Testes de autorização para garantir que os usuários só possam acessar e modificar suas próprias tarefas.

- **Documentação da API:**
    - Geração automática da documentação da API utilizando o Laravel Request Docs.

### Frontend (Vue.js):

- **Componentes:**
    - `Login`: Formulário de login.
    - `Register`: Formulário de registro.
    - `Logout`: Componente para deslogar usuário.
    - `TaskList`: Componente principal para listar e gerenciar tarefas.
    - `TaskItem`: Componente para exibir cada tarefa individualmente.
    - `TaskForm`: Componente para criar e editar tarefas (modal).

- **Roteamento:**
    - Vue Router para navegação entre as páginas de login, registro e lista de tarefas.

- **Gerenciamento de Estado:**
    - Pinia para gerenciar o estado de autenticação do usuário e as tarefas.

- **Consumo da API:**
    - Axios para fazer requisições à API Laravel.
    - Arquivo `api.js` para centralizar a configuração do Axios e gerenciar o token de autenticação.

- **Estilização:**
    - Bootstrap 5 para a estrutura básica e estilos dos componentes.
    - Arquivo CSS personalizado (`base.css`) para estilos adicionais.

## Pré-requisitos

- PHP >= 8.1
- Laravel 10
- Composer
- Node.js e npm
- MySQL (ou outro banco de dados compatível com o Laravel)

## Instalação e Execução

### Backend:

1. Clone o repositório:
   ```bash
   git clone <repositorio>
   ```
2. Instale as dependências do PHP:
   ```bash
   composer install
   ```

3. Crie o arquivo .env a partir do .env.example:
   ```bash
   cp .env.example .env
   ```

4. Configure as variáveis de ambiente no .env (banco de dados, etc.).

5. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

6. Execute as migrations:
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

### Frontend:

1. Gere a chave da aplicação:
   ```bash
   cd frontend
   ```

2. Execute as migrations:
   ```bash
   npm install
   ```

3. Inicie o servidor de desenvolvimento:
   ```bash
   npm run dev
   ```

## Acesso à Documentação da API

Acesse [http://localhost:8000/request-docs](http://localhost:8000/request-docs) (ou a URL da sua aplicação) para visualizar a documentação da API gerada pelo Laravel Request Docs.

## Testes

1. Para executar os testes do backend (PEST), volte para a pasta raiz do projeto e execute:
   ```bash
    cd ..
    ./vendor/bin/pest
   ```

Com essas instruções, os usuários poderão configurar e executar tanto o backend quanto o frontend, além de acessar a documentação da API e executar os testes necessários. Se precisar de mais ajustes ou informações, sinta-se à vontade para perguntar!




