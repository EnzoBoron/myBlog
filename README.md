# 🧠 MyBlog – Application Laravel

MyBlog est une application web développée avec Laravel (backend PHP) et Vite (frontend build).
Elle gère la création d’utilisateurs, leurs interactions, et met en place une architecture MVC propre et évolutive.

## ⚙️ Installation et lancement

Assurez-vous d’avoir PHP ≥ 8.2, Composer, Node.js et npm installés sur votre machine.

## 🔧 1. Installation
```bash
make install
```

### Cette commande :

- installe les dépendances PHP (via Composer)
- installe les dépendances front (via npm)
- crée le fichier .env à partir de .env.example
- génère la clé d’application Laravel
- prépare la base SQLite
- lance les migrations et seeders
- compile les assets avec Vite (npm run build)

## 🚀 2. Lancer le serveur
make serve

```bash
L’application sera accessible à l’adresse :
👉 http://127.0.0.1:8000
```

## 🧩 Stack technique
Élément	Description
Laravel 11	Framework PHP moderne basé sur le modèle MVC<br>
Vite	Outil de build ultra rapide pour JS/CSS<br>
SQLite	Base de données légère, prête à l’emploi (aucune config requise)<br>
Blade	Moteur de templates intégré à Laravel<br>
Eloquent ORM	Gestion des modèles et relations entre les données

## 🧠 Laravel, c’est quoi ?

Laravel est un framework PHP open source qui facilite le développement d’applications web robustes, modernes et sécurisées.
Il repose sur l’architecture MVC (Model–View–Controller) :

Model → représente les données et leur logique (ex : User, Post)
View → gère l’affichage (templates Blade)<br>
Controller → fait le lien entre la logique et la vue (gère les requêtes, les actions utilisateur)

C’est un modèle clair, organisé et idéal pour séparer les responsabilités dans le code.

## 🧪 Fonctionnalités

- Création d’utilisateurs via les formulaires Laravel<br>
- Gestion des rôles et permissions (Spatie)<br>
- Migrations & seeders automatisés<br>
- Interface responsive servie par Vite<br>
- Système d’authentification Laravel natif<br>
- Architecture MVC propre et évolutive

🧱 Commandes utiles

Installe et configure tout le projet
```bash
make install
```

Lance le serveur Laravel
```bash
make serve
```

Compile les fichiers front (Vite)
```bash
make build
```

Réinitialise la base SQLite
```bash
make reset
```

Vide les caches Laravel
```bash
make clean
```
