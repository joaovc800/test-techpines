# 📦 Api discography

Bem-vindo ao **Api discography**! Este é um guia rápido sobre como configurar e iniciar o backend do projeto.

## 🚀 Instruções de Configuração

Siga os passos abaixo para configurar o ambiente, instalar as dependências e iniciar a aplicação.

### 1. Configuração Inicial

Antes de instalar as dependências, certifique-se de que a variável `extension=zip` está descomentada no arquivo `php.ini` para permitir a instalação das dependências via Composer.

### 2. Instalar as Dependências

Execute o comando abaixo para instalar as dependências do Composer:

```bash
composer install
```

### 3. Rodar as Migrations

Para configurar o banco de dados e criar as tabelas necessárias, execute:

```bash
php artisan migrate
```

### 4. Iniciar a Aplicação

Inicie o servidor backend com o comando:
```bash
php artisan serve --port=8000
```

A aplicação estará disponível em `http://localhost:8000`.

## 🛠 Tecnologias Utilizadas

-   **Laravel** - Framework PHP para desenvolvimento de aplicações web
-   **Sanctum** - Sistema de autenticação simples para SPA (Single Page Applications) e APIs
-   **SQLite** - Banco de dados leve e embutido
-   **Eloquent ORM** - Mapeamento Objeto-Relacional para interagir com o banco de dados

## 🔄 Rotas da API

Aqui estão as rotas principais da API configuradas no projeto:

### Autenticação

-   **Registrar**: `POST /register`  
    Controlador: `AuthController` - Método: `register`
    
-   **Login**: `POST /login`  
    Controlador: `AuthController` - Método: `login`
    
-   **Logout**: `POST /logout`  
    Controlador: `AuthController` - Método: `logout`  
    Protegido por autenticação `auth:sanctum`
    
-   **Usuário Atual**: `GET /user`  
    Retorna o usuário autenticado  
    Protegido por autenticação `auth:sanctum`
    

### Rotas da API (Prefixo `v1`)

-   **Buscar Álbuns**: `GET /v1/album/search`  
    Controlador: `AlbumController` - Método: `search`
    
-   **Buscar Faixas**: `GET /v1/track/search`  
    Controlador: `TrackController` - Método: `search`
    
-   **Álbuns**: `GET, POST, PUT, DELETE /v1/album`  
    Controlador: `AlbumController` - Métodos: `index`, `store`, `show`, `update`, `destroy`
-   **Faixas**: `GET, POST, PUT, DELETE /v1/track`  
    Controlador: `TrackController` - Métodos: `index`, `store`, `show`, `update`, `destroy`
