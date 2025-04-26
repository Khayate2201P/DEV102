                                                 #Authentification System en PHP

Système d'authentification simple en PHP utilisant MySQL et sessions.

##Fonctionnalités :

-Inscription d'utilisateurs,

-Connexion d'utilisateurs,

-Déconnexion,

-Tableau de bord pour utilisateurs connectés,

-Protection des pages par sessions,

##Technologies utilisées:

-PHP ,

-MySQL,

-HTML/CSS ,

##Installation:

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

##Pages Disponibles


—'index.php' - Page d'accueil

—'register.php' - Page d'inscription

—'login.php' - Page de connexion

—'dashboard.php' - Tableau de bord privé

—'logout.php' - Déconnexion

