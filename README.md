# Laroche-api - Test technique

## 👨‍💻 Auteur

- **Henri Laroche** - [Lien vers ton GitHub ou LinkedIn]

---

## 📖 Description du projet

Ce projet est une API REST développée avec Laravel 12. 
Elle permet une gestion complète des administrateurs, 
des profils et des commentaires, 
incluant l’authentification sécurisée via Laravel Sanctum, 
la gestion sécurisée des fichiers avec Laravel Storage, 
et une documentation interactive via Swagger. 
L'architecture respecte strictement les principes S.O.L.I.D.

---

## 🚀 Fonctionnalités principales

- Authentification sécurisée (Laravel Sanctum)
- Gestion complète des profils (CRUD, autorisation via Policies)
- Commentaires uniques par administrateur sur chaque profil (autorisation via Policies)
- Documentation interactive complète (Swagger l5-swagger)
- Gestion sécurisée des images avec Laravel Storage
- Architecture propre (S.O.L.I.D)
- Tests automatisés complets (PHPUnit)
- Middleware pour vérifier le rôle minimum requis (admin)

---

## ⚙️ Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL ou PostgreSQL
- Redis (optionnel pour cache)
- Docker (optionnel)

---

## 🛠 Installation

1. Clone le dépôt :
```bash
git clone https://github.com/ton-compte/laroche-api.git
cd laroche-api
```

2. Installe les dépendances :
```bash
composer install
```

3. Configure ton fichier `.env` :
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure ta base de données dans `.env` :
```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=api-laroche
DB_USERNAME=postgres
DB_PASSWORD=laroche-api
```

5. Migrer la base de données :
```bash
php artisan migrate --seed
```

6. Crée le lien symbolique pour les fichiers :
```bash
php artisan storage:link
```

7. Lance ton serveur Laravel :
```bash
php artisan serve
```

---

## ✅ Tests

Lance les tests automatisés avec PHPUnit :
```bash
php artisan test
```

---

## 📗 Documentation de l’API (Swagger)

- Génère la documentation :
```bash
php artisan l5-swagger:generate
```

- Accède à la documentation interactive :
```
http://localhost:8000/api/documentation
```

---

## 🗂 Structure du projet

```text
app/
├── Http
│   ├── Controllers        # Contrôleurs d’API
│   │   └── Api
│   │       └── V1         # Versionnement de l’API (ex: V1, V2,…)
│   ├── Middleware         # Middleware de l’application
│   ├── Requests           # Classes de validation des requêtes
│   └── Resources          # Transformateurs/Resource pour formater les réponses JSON
├── Models                 # Modèles Eloquent
├── Policies               # Gestion des autorisations
├── Repositories           # Accès aux données
│   ├── Contracts          # Contrats pour les repositories
│   └── Eloquent           # Implémentations concrètes basées sur Eloquent
├── Services               # Logique métier découplée
│   ├── Contracts          # Interfaces pour les services
│   └── Implementations    # Implémentations concrètes des services
```

---

## 🛡 Sécurité & bonnes pratiques

- Validation stricte de l'entrée utilisateur
- Cryptage des mots de passe (bcrypt)
- Protection des routes avec middleware & Policies
- Stockage sécurisé des images avec Laravel Storage
- Affichage conditionnel des champs sensibles selon authentification

---

## 🚩 Points d’amélioration futurs

- Dockerisation
- CI/CD via GitHub Actions
- Analyse statique du code (Laravel Pint, PHPStan)
- Gestion avancée des rôles et permissions (Spatie Permission)

---

## 📜 Licence

Ce projet est sous licence MIT

