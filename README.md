# Prompts AI

Application web de gestion de prompts IA, construite avec **Laravel 13** et **Tailwind CSS 4**.  
Organisez, recherchez et copiez vos prompts en un clic.

---

## Aperçu

| Page | Description |
|------|-------------|
| Accueil | Hero page avec 3 cartes cliquables vers les fonctionnalités |
| Liste | Tableau paginé avec recherche full-text et filtre par famille |
| Détail | Affichage complet avec bouton "Copier" le prompt |
| Création | Formulaire avec compteur de caractères en temps réel |
| Édition | Modification avec validation inline par champ |

---

## Stack technique

- **PHP** 8.5
- **Laravel** 13.9
- **Tailwind CSS** 4.x — chargé via CDN (pas de compilation Vite requise)
- **SQLite** (base de données par défaut)

---

## Prérequis

- PHP >= 8.3
- Composer

> **Note :** Node.js / npm ne sont **pas nécessaires** — Tailwind CSS est chargé via CDN dans le layout.

---

## Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/votre-utilisateur/prompts-ai.git
cd prompts-ai

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé d'application
php artisan key:generate

# 5. Créer la base de données SQLite
touch database/database.sqlite

# 6. Lancer les migrations
php artisan migrate

# 7. (Optionnel) Peupler avec des données d'exemple
php artisan db:seed
```

---

## Démarrage

```bash
php artisan serve
```

L'application est accessible sur [http://127.0.0.1:8000](http://127.0.0.1:8000).

> Pas besoin de `npm run dev` — Tailwind CSS est chargé directement depuis le CDN.

---

## Structure du projet

```
prompts-ai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PromptController.php   # CRUD complet + recherche & filtre
│   │   └── Middleware/
│   │       └── AuthMiddleware.php
│   └── Models/
│       ├── Prompt.php                 # Modèle prompt (titre, description, prompt_text)
│       └── Famille.php                # Modèle famille (titre, type)
├── database/
│   ├── migrations/                    # Tables prompts et familles
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/app.blade.php      # Layout principal — Tailwind via CDN
│       ├── welcome.blade.php          # Page d'accueil avec cartes cliquables
│       ├── index.blade.php            # Liste avec recherche et filtres
│       ├── show.blade.php             # Détail + bouton copier
│       ├── create.blade.php           # Formulaire de création
│       └── edit.blade.php             # Formulaire d'édition
└── routes/
    └── web.php                        # Routes resourceful
```

---

## Fonctionnalités

- **CRUD complet** — créer, lire, modifier, supprimer des prompts
- **Familles** — classement des prompts par catégorie (titre + type)
- **Recherche full-text** — filtre sur le titre, la description et le prompt_text
- **Filtre par famille** — combinable avec la recherche, persistant à la pagination
- **Copier en un clic** — bouton clipboard sur la page de détail
- **Compteur de caractères** — affiché en temps réel sur les textareas
- **Validation inline** — erreurs affichées champ par champ
- **Pagination** — 9 prompts par page avec conservation des filtres (`withQueryString`)
- **Notifications flash** — confirmation visuelle après chaque action CRUD
- **Cartes d'accueil cliquables** — navigation directe vers Créer, Rechercher et Copier
- **Tailwind CSS via CDN** — aucune étape de compilation front-end requise

---

## Modifications apportées

### Correction Vite manifest introuvable
Le layout `resources/views/layouts/app.blade.php` utilisait `@vite(...)` ce qui causait une erreur  
`ViteManifestNotFoundException` au démarrage sans compilation préalable.  
**Fix :** remplacement par un tag `<script src="https://cdn.tailwindcss.com">` — l'application fonctionne sans `npm run build`.

### Recherche & filtre fonctionnels
La méthode `index()` du `PromptController` ne passait pas `$familles` à la vue et n'implémentait pas  
la logique de recherche/filtre malgré le formulaire présent dans `index.blade.php`.  
**Fix :** refactoring de `index()` pour accepter les paramètres `search` et `famille_id`, filtrer  
la requête Eloquent en conséquence, et passer `$familles` à la vue.

### Cartes d'accueil cliquables
Les 3 cartes "Ce que vous pouvez faire" dans `welcome.blade.php` étaient de simples `<div>` non interactifs.  
**Fix :** conversion en balises `<a>` avec effets hover (ring coloré, ombre, texte indicatif au survol).

---

## Commandes utiles

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh --seed   # Réinitialiser + seeder

# Cache
php artisan config:clear
php artisan view:clear

# Tests
php artisan test
```

---

## Contribution

Les contributions sont les bienvenues.

1. Forkez le dépôt
2. Créez une branche : `git checkout -b feature/ma-fonctionnalite`
3. Commitez vos changements : `git commit -m "feat: description"`
4. Poussez la branche : `git push origin feature/ma-fonctionnalite`
5. Ouvrez une Pull Request

---

## Licence

Ce projet est sous licence [MIT](LICENSE).
