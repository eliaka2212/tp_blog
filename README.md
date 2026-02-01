# TP Blog - Application de Blog Laravel

Ce projet est une application de blog complète développée avec Laravel 12. Elle permet aux utilisateurs de s'inscrire, de gérer leur profil, de rédiger des articles, et d'interagir via des commentaires. 

## 🛠 Technologies

-   **Backend** : Laravel 12 (PHP 8.2+)
-   **Frontend** : Blade, Tailwind CSS, Alpine.js, Vite
-   **Base de données** : MySQL
-   **Authentification** : Laravel Breeze

## ✨ Fonctionnalités Principales

### 👤 Espace Utilisateur
-   **Authentification** : Inscription, Connexion, Mot de passe oublié.
-   **Tableau de Bord (Dashboard)** : Vue d'ensemble des activités.
-   **Gestion du Profil** : Modification des informations, suppression de compte.

### 📝 Gestion des Articles (CRUD)
-   **Créer** : Rédaction d'articles avec titre, contenu, catégories et tags.
-   **Lire** : Consultation des articles via une URL publique.
-   **Mettre à jour** : Modification des articles existants.
-   **Supprimer** : Retrait des articles.

### 🌐 Partie Publique
-   **Page d'accueil** : Présentation du blog.
-   **Page Auteur** : Chaque utilisateur possède une page publique (`/{user}`) listant ses articles.
-   **Lecture** : Page détaillée d'un article (`/{user}/{article}`).
-   **Commentaires** : Les visiteurs peuvent laisser des commentaires sur les articles.

## 🚀 Installation

1.  **Cloner le projet**
    ```bash
    git clone <votre-url-repo>
    cd tp_blog-main
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Installer les dépendances JS/CSS**
    ```bash
    npm install
    ```

4.  **Configuration**
    Copiez le fichier d'environnement et générez la clé d'application.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Base de données**
    Configurez votre fichier `.env` avec vos accès MySQL :
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tp_blog
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Migrations et Jeux de Données (Seeders)**
    ```bash
    php artisan migrate --seed
    ```

7.  **Lancer le projet**
    Lancez le serveur de développement Laravel et Vite en parallèle (dans deux terminaux distincts ou via un outil comme concurrently si configuré) :
    
    Terminal 1 :
    ```bash
    php artisan serve
    ```
    
    Terminal 2 :
    ```bash
    npm run dev
    ```

8.  **Accès**
    Ouvrez votre navigateur sur `http://localhost:8000`.

## 🧪 Tests

Pour exécuter les tests automatisés :
```bash
php artisan test
```

## 📂 Structure Notable

-   `app/Http/Controllers` : Contient la logique métier (Articles, Commentaires, Utilisateurs).
-   `routes/web.php` : Définition des routes publiques et protégées.
-   `resources/views` : Vues Blade (Pages, Composants, Layouts).
