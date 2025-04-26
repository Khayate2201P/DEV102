                                                 # Authentification System en PHP

Système d'authentification simple en PHP utilisant MySQL et sessions.

## Fonctionnalités :

- Inscription d'utilisateurs,

- Connexion d'utilisateurs,

- Déconnexion,

- Tableau de bord pour utilisateurs connectés,

- Protection des pages par sessions,

## Technologies utilisées:

- PHP ,

- MySQL,

- HTML/CSS ,

## Installation:

1.Cloner ou télécharger le projet : git clone [votre-lien-du-repo]

2.Copier le dossier auth-system dans votre serveur local (ex: htdocs pour XAMPP).

3.Créer une base de données MySQL et importer les tables nécessaires (ex: users).

4.Configurer votre connexion à la base de données dans : config/db.php

<?php
$host = "localhost";
$db_name = "nom_de_votre_db";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $db_name);
?>

5.Démarrer Apache et MySQL via XAMPP (ou autre serveur local).

6.Accéder au projet depuis votre navigateur :   http://localhost/auth-system/index.php

## Pages Disponibles

- `index.php` — Page d'accueil
 
- `register.php` — Page d'inscription
  
- `login.php` — Page de connexion
  
- `dashboard.php` — Tableau de bord
  
- `logout.php` — Déconnexion

## Base de données

Créer une base de données (ex: auth_system) puis une table users avec la structure suivante :

CREATE DATABASE auth_system;

USE auth_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

## Explication des colonnes :

id : Identifiant unique de l'utilisateur.

username : Nom d'utilisateur.

email : Adresse email de l'utilisateur (doit être unique).

password : Mot de passe hashé.

created_at : Date et heure d'inscription.



