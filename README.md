# Horaire des classes du CFPT

Application web PHP  permettant la gestion des classes, des cours et des horaires (créneaux) au CFPT.

## Auteur

Henrique Torres Bryan

## Structure du projet

ProjetRevision-/
├── index.php                 # Accueil
├── config/
│   └── database.php          # Constantes de connexion
├── connexion/
│   └── db.php                # Connexion PDO
├── functions/
│   ├── classes.php           # CRUD classes
│   ├── cours.php             # CRUD cours
│   └── creneaux.php          # CRUD créneaux
├── includes/
│   ├── header.php            # En-tête + navigation
│   └── footer.php            # Pied de page
├── pages/
│   ├── classes.php           # Saisie / suppression des classes
│   ├── cours.php             # Saisie / suppression des cours
│   └── horaire.php           # Saisie / consultation / suppression des créneaux
├── api/
│   ├── index.php             # Point d'entrée API
└── sql/
    └── init.sql              # Création de la base + données d'exemple


## Journal de bord

