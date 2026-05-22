# Sixième Sens

Ce dépôt contient le projet d’intégration réalisé dans le cadre du Bachelor en Ingénierie des Médias à la HEIG-VD par le groupe **Sixième Sens**.

Le groupe est composé de :

- Sarah Furrer — Responsable gestion de projet & Scrum Master
- Marike Platen — Responsable UX & Product Owner
- Sacha Loskov — Responsable UI
- Ella Maiburg — Responsable marketing
- Steve Benjamin — Responsable développement front-end
- Benoît Jaques — Responsable développement back-end

## Table des matières

- [Objectif du projet](#objectif-du-projet)
- [Organisation du projet](#organisation-du-projet)
- [Configuration du projet](#configuration-du-projet)
- [Workflow Git](#workflow-git)

## Objectif du projet

Ce projet consiste à concevoir et développer une plateforme web dédiée au **Trophée de la générosité** des HUG, afin de valoriser les entreprises partenaires organisant des collectes de sang et de leur fournir un espace clair pour s’informer, participer aux campagnes en cours et accéder aux informations utiles à l’organisation d’une collecte. Le site doit notamment présenter le trophée et le Label CTS, mettre en avant les entreprises labellisées et les lauréats, proposer des formulaires de contact et de participation, ainsi qu’une version co-brandée accessible via un lien spécifique à chaque entreprise. L’objectif est également d’améliorer la participation aux collectes grâce à une communication plus attractive, à une meilleure diffusion des critères d’éligibilité au don et à un outil administrable, traduisible et mesurable pour le CTS.

## Organisation du projet

Le projet comprend :

- Une analyse des attentes et des problématiques du mandant
- Une page vitrine présentant le don du sang et le Trophée de la générosité
- Une page co-brandée permettant aux employé·e·s de s’informer sur les critères d’éligibilité au don du sang et d’accéder au lien d’inscription à une collecte
- Une interface d’administration pour la gestion des pages co-brandées
- Un kit de communication à destination des entreprises, comprenant des supports internes pour les employé·e·s, des supports externes pour valoriser leur engagement, ainsi qu’un label à mettre en avant
- Une définition de KPI afin d’évaluer la performance du projet
- Un rapport final de projet
- Une présentation finale de 15 minutes

Le projet s’appuie sur les outils et technologies suivants :

- [Jira](https://sixieme-sens.atlassian.net/jira/software/projects/SCRUM/boards/1/backlog) pour la gestion de projet et des sprints
- Figma pour l’idéation, la création des user flows, des wireframes et des maquettes
- MySQL pour la base de données
- Laravel pour le back-end
- Vue.js pour le front-end
- [Infomaniak](https://manager.infomaniak.com/v3/1183546/ng/home) pour l’hébergement et le déploiement

## Workflow Git

Pour chaque modification du code sur le dépôt GitHub, les étapes suivantes doivent être respectées :

1. Créer une issue décrivant l’implémentation ou la correction à réaliser
2. Créer une branche liée à cette issue
3. Développer la fonctionnalité ou le correctif
4. Push la branche sur le dépôt distant
5. Demander une review au responsable concerné :
    - Steve Benjamin pour le front-end
    - Benoît Jaques pour le back-end
6. Merger la branche une fois la review validée, puis supprimer la branche

**Ne jamais modifier directement la branche `main`.**

## Pré-requis

Afin de lancer ce projet, une stack compatible avec Laravel, est requise.

Voici les pré-requis nécessaires :

- PHP >= 8.0.
- Composer.
- Node.js et npm.
- Une base de données (MySQL, PostgreSQL, SQLite, etc.).
- Un serveur web (Apache, Nginx, etc.).

[Laravel Herd](https://helm.sh/docs/charts/laravel/) est recommandé pour une installation facile de Laravel et de ses dépendances.

> Dans l'environnement de développement, le sgdb sera MySQL
> Il est cependant possible (et recommandé) de développer localement en SQLite

### Développement local

Pour développer et tester le mini-projet en local, voici les étapes à suivre :

1. Cloner ce dépôt sur votre machine locale :

    ```bash
    git clone git@github.com:BenbounBigHydra/sixieme_sens.git

    cd sixieme_sens
    ```

2. Installer les dépendances avec npm et Composer :

    ```bash
    npm install

    npm run build

    composer install
    ```

3. Installer les dépendances Vue.js

> Aucune installation nécessaire pour le moment

4. Copier le fichier `.env.example` en `.env`.
5. Modifier les variables d'environnement si nécessaire (optionnel).
6. Générer la clé d'application Laravel :

    ```bash
    php artisan key:generate
    ```

7. Créer le lien symbolique pour les fichiers téléversés :

    ```bash
    php artisan storage:link
    ```

8. Créer la base de donnée, exécuter les migrations et seed :

    ```bash
    php artisan migrate
    ```

_S'il est nécessaire de réinitialiser la base de données durant le développement_

    ```bash
    php artisan migrate:reset --seed
    ```

9. Démarrer le serveur de développement Laravel :

    ```bash
    composer run dev
    ```

L'application sera accessible à l'adresse <http://localhost:8000>.

### Déploiement serveur de production

À chaque Merged pull request, le serveur Infomaniak se met à jour.

    ```bash
    cd ~/sites/sixieme_sens

    git pull origin main

    composer install --no-dev --optimize-autoloader

    php artisan migrate:fresh --seed --force

    php artisan config:cache

    php artisan route:cache

    php artisan view:cache
    ```

> [!CAUTION]
> Actuellement, la DB est totalement effacée, recréé et seedée à chaques fois. Au moment du déploiement réel, corriger cette fonctionnalité
