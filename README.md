# Laroche-api - Teste técnico

## 👨‍💻 Autor

- **Henri Laroche**

---

## 📖 Descrição do projeto

Este projeto é uma API REST desenvolvida com Laravel 12 e PHP 8.4.5.  
Ele permite um gerenciamento completo de administradores, perfis e comentários, incluindo autenticação segura via
Laravel Sanctum, gerenciamento seguro de arquivos com Laravel Storage e documentação interativa via Swagger.  
A arquitetura respeita estritamente os princípios S.O.L.I.D.

---

## 📝 Observação

As implementações mais avançadas foram idealizadas e desenvolvidas por mim, inclusive a estruturação inicial de todo o
projeto.

---

## 🚀 Funcionalidades principais

- Autenticação segura (Laravel Sanctum)
- Gerenciamento completo de perfis (CRUD, autorização via Policies) - Minha ideia
- Comentários únicos por administrador em cada perfil (autorização via Policies) - Minha ideia
- Documentação interativa completa (Swagger l5-swagger) - Minha ideia
- Gerenciamento seguro de imagens com Laravel Storage - Minha ideia
- Arquitetura limpa (S.O.L.I.D) - Minha ideia
- Testes automatizados completos (PHPUnit)
- Middleware para verificar o papel mínimo requerido (admin)

---

## ⚙️ Pré-requisitos

- PHP 8.2 ou superior
- Composer
- MySQL ou PostgreSQL

---

## 🛠 Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/ton-compte/laroche-api.git
   cd laroche-api
   ```

2. Instale as dependências:

   ```bash
   composer install
   ```

3. Configure seu arquivo `.env`:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure seu banco de dados em `.env`:

   ```dotenv
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=laroche-api
   DB_USERNAME=postgres
   DB_PASSWORD=
   ```

5. Migre o banco de dados:

   ```bash
   php artisan migrate --seed
   ```

6. Crie o link simbólico para os arquivos:

   ```bash
   php artisan storage:link
   ```

7. Inicie seu servidor Laravel:

   ```bash
   php artisan serve
   ```

---

## ✅ Testes

Execute os testes automatizados com PHPUnit:

```bash
php artisan test
```

---

## 📗 Documentação da API (Swagger)

- Gere a documentação:

  ```bash
  php artisan l5-swagger:generate
  ```

- Acesse a documentação interativa:

  ```
  http://localhost:8000/api/documentation
  ```

---

## 🗂 Estrutura do projeto

```text
app/
├── Http
│   ├── Controllers        # Controladores da API
│   │   └── Api
│   │       └── V1         # Versionamento da API (ex: V1, V2,…)
│   ├── Middleware         # Middleware da aplicação
│   ├── Requests           # Classes de validação das requisições
│   └── Resources          # Transformadores/Resource para formatar as respostas JSON
├── Models                 # Modelos Eloquent
├── Policies               # Gerenciamento de autorizações
├── Repositories           # Acesso aos dados
│   ├── Contracts          # Contratos para os repositórios
│   └── Eloquent           # Implementações concretas baseadas em Eloquent
├── Services               # Lógica de negócio desacoplada
│   ├── Contracts          # Interfaces para os serviços
│   └── Implementations    # Implementações concretas dos serviços
```

---

## 🛡 Segurança e boas práticas

- Validação rigorosa da entrada do usuário
- Criptografia de senhas (bcrypt)
- Proteção de rotas com middleware e Policies
- Armazenamento seguro de imagens com Laravel Storage
- Exibição condicional de campos sensíveis conforme autenticação

---

## 🚩 Pontos de melhoria futuros

- Dockerização
- CI/CD via GitHub Actions
- Análise estática de código (Laravel Pint, PHPStan)
- Gerenciamento avançado de papéis e permissões (Spatie Permission)
- Redis (para cache)
- Adição de try e catch

---

## 📜 Licença

Este projeto está sob licença MIT  
