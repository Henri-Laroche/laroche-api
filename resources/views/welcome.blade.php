<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laroche-API</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-blue-600">Laroche-API</h1>
            <p class="mt-1 text-gray-600">Funcionalidades técnicas em Laravel</p>
        </div>
        <a href="http://localhost:8000/api/documentation"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Documentação da API
        </a>
    </div>
</header>

<main class="container mx-auto px-6 py-8 space-y-8">
    <!-- Autor -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">👨‍💻 Autor</h2>
        <p><strong>Henri Laroche</strong></p>
    </section>

    <!-- Descrição -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">📖 Descrição do projeto</h2>
        <p class="leading-relaxed">
            Esta API REST desenvolvida com <strong>Laravel 12</strong> e <strong>PHP 8.4.5</strong> permite
            gerenciamento completo de administradores, perfis e comentários, incluindo autenticação segura via Laravel
            Sanctum, gerenciamento seguro de arquivos com Laravel Storage e documentação interativa via Swagger. A
            arquitetura respeita estritamente os princípios <em>S.O.L.I.D</em>.
        </p>
    </section>

    <!-- Observação -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">📝 Observação</h2>
        <p class="leading-relaxed">
            As implementações mais avançadas foram idealizadas e desenvolvidas por mim, inclusive a estruturação inicial
            de todo o
            projeto.
        </p>
    </section>

    <!-- Funcionalidades -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">🚀 Funcionalidades principais</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>Autenticação segura (Laravel Sanctum)</li>
            <li>Gerenciamento completo de perfis (CRUD, autorização via Policies)</li>
            <li>Comentários únicos por administrador em cada perfil (autorização via Policies)</li>
            <li>Documentação interativa completa (Swagger l5-swagger)</li>
            <li>Gerenciamento seguro de imagens com Laravel Storage</li>
            <li>Arquitetura limpa (S.O.L.I.D)</li>
            <li>Testes automatizados completos (PHPUnit)</li>
            <li>Middleware para verificar o papel mínimo requerido (admin)</li>
        </ul>
    </section>

    <!-- Pré-requisitos -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">⚙️ Pré-requisitos</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>PHP 8.2 ou superior</li>
            <li>Composer</li>
            <li>MySQL ou PostgreSQL</li>
        </ul>
    </section>

    <!-- Instalação -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">🛠 Instalação</h2>
        <ol class="list-decimal list-inside space-y-2">
            <li>
                <p>Clone o repositório:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>git clone https://github.com/ton-compte/laroche-api.git
cd laroche-api</code></pre>
            </li>
            <li>
                <p>Instale as dependências:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>composer install</code></pre>
            </li>
            <li>
                <p>Configure seu arquivo <code>.env</code>:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>cp .env.example .env
php artisan key:generate</code></pre>
            </li>
            <li>
                <p>Configure seu banco de dados em <code>.env</code>:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laroche-api
DB_USERNAME=postgres
DB_PASSWORD=</code></pre>
            </li>
            <li>
                <p>Migre o banco de dados:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>php artisan migrate --seed</code></pre>
            </li>
            <li>
                <p>Crie o link simbólico para os arquivos:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>php artisan storage:link</code></pre>
            </li>
            <li>
                <p>Inicie seu servidor Laravel:</p>
                <pre class="bg-gray-100 p-4 rounded"><code>php artisan serve</code></pre>
            </li>
        </ol>
    </section>

    <!-- Testes -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">✅ Testes</h2>
        <p>Execute os testes automatizados com PHPUnit:</p>
        <pre class="bg-gray-100 p-4 rounded"><code>php artisan test</code></pre>
    </section>

    <!-- Documentação -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">📗 Documentação da API (Swagger)</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>Gere a documentação:
                <pre class="bg-gray-100 p-4 rounded"><code>php artisan l5-swagger:generate</code></pre>
            </li>
            <li>Acesse a documentação interativa:
                <pre class="bg-gray-100 p-4 rounded"><code>http://localhost:8000/api/documentation</code></pre>
            </li>
        </ul>
    </section>

    <!-- Estrutura do projeto -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">🗂 Estrutura do projeto</h2>
        <pre class="bg-gray-100 p-4 rounded overflow-x-auto"><code>app/
├── Http
│   ├── Controllers        # Controladores da API
│   │   └── Api
│   │       └── V1         # Versionamento da API (ex: V1, V2, …)
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
</code></pre>
    </section>

    <!-- Segurança -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">🛡 Segurança e boas práticas</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>Validação rigorosa da entrada do usuário</li>
            <li>Criptografia de senhas (bcrypt)</li>
            <li>Proteção de rotas com middleware e Policies</li>
            <li>Armazenamento seguro de imagens com Laravel Storage</li>
            <li>Exibição condicional de campos sensíveis conforme autenticação</li>
        </ul>
    </section>

    <!-- Melhorias -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">🚩 Pontos de melhoria futuros</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>Dockerização</li>
            <li>CI/CD via GitHub Actions</li>
            <li>Análise estática de código (Laravel Pint, PHPStan)</li>
            <li>Gerenciamento avançado de papéis e permissões (Spatie Permission)</li>
            <li>Redis (para cache)</li>
            <li>Adição de try e catch</li>
        </ul>
    </section>

    <!-- Licença -->
    <section>
        <h2 class="text-2xl font-semibold mb-2">📜 Licença</h2>
        <p>Este projeto está sob licença <strong>MIT</strong>.</p>
    </section>
</main>

<footer class="bg-white mt-12 py-4 shadow-inner">
    <div class="container mx-auto px-6 text-center text-gray-600">
        &copy; 2025 Henri Laroche. Todos os direitos reservados.
    </div>
</footer>
</body>
</html>
