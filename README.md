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

###27/08/2026

J'ai créer les requetes sql pour les pages classe, cours, creneaux.
J'ai créer le diagramme de Gantt.
J'ai créer la db.

###03/09/2026

J'ai commencé la création des formulaires.
J'ai créer les pages de classes et creneaux ainsi que la page de cours.

###17/09/2026
J'ai créer la page principal.
Fini les formulaires.
Fini la stylisation.
Creation des test CRUD avec Bruno.
(Avancement à la maison le jeudi 10/09/2026)



###Dificulté rencontré
Je n'ai pas vraiment eu de dificulté, mais le manque de pratique, j'ai eu des oubli de comment faire une api de 0. Sinon tout c'est bien passé.


### Pourquoi cette methodologie 
En séparant les taches à faire que cette manière, cela nous permet de mieux nous organiser et de pas nous perdre de quoi faire. 
La separation des commits nous aide beaucoup, si nous voudrions revenir a un version ulterieur, nous saurons exactement ce que nous avion modifier.
