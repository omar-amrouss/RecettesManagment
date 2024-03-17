<p align="center">Projet PHP: Gestion de recette avec Laravel</p>

## Guide d'installation

### 1er étape: Pré-requis

- Installer Laravel. Un guide d'installation se trouve [ici](https://laravel.com/docs/8.x/installation).
- Faire un git clone de ce projet

### 2eme étape: Installation des dépendances et packages nécessaires.
- Installation des dépendances composer avec la commande : `composer install`
- Installation des dépendances npm avec la commande : `npm install`

#### Packages utilisés :
Ces commandes ne sont pas nécessaires pour l'installation.
- Installer le package [https://github.com/laravel/ui](laravel/ui) avec la commande `composer require laravel/ui --dev`
- Installer le package [https://laravelcollective.com/docs](laravelcollective/html) avec la commande `composer require laravelcollective/html` 
- Après l'installation du package précédent, executer cette commande: `php artisan ui bootstrap --auth`

### 3eme étape: Configuration de l'environnement
Dans *config/app.php* rajouter ces éléments si ils n'y sont pas : 

`'providers' => [
....
'Collective\Html\HtmlServiceProvider',
],
'aliases' => [
....
'Form' => 'Collective\Html\FormFacade',
],`
Cela va permettre l'utilisation de *Form* dans nos vues(.blade).

Puis vérifier que dans le fichier *.env* nous avons bien ces informations : 

`DB_CONNECTION=sqlite`
`DB_DATABASE=../database/database.db`

Cela va permettre l'utilisation de la base de donnée *database.db* <br />
<ins>N.B:</ins> Si le fichier **.env** n'existe pas créer celui-ci.

### 4eme étape: Mise en place de la base de donnée

La base de donnée est en principe déjà configurée et prête à être utilisée cependant vous pouvez à tout moment la réinitialiser et la re-populer avec les commandes suivantes: 

`php artisan migrate:fresh`
`php artisan db:seed`

N.B: La population de la base de donnée va permettre la génération de vraies recettes et d'un compte admin avant le remplissage de celle-ci via de fausses informations.


### 5eme étape: Lancement du serveur et identifiant

Une fois toute les étapes précédentes effectuées vous pouvez à présent lancer le serveur local avec la commande : `php artisan serve` <br/>
Il ne vous restera plus qu'à aller sur http://127.0.0.1:8000/ pour visiter le site web. 

Pour vous connecter en tant qu'administrateur il vous suffit de rentrer ces identifiants : 

email : admin@admin.com <br/>
password: adminadmin

Pour vous connecter en utilisateur lambda, vous pouvez créer un utilisateur via le bouton 'register'.

## Fonctionnalités du site

Le site propose différentes fonctionnalités en fonction de l'utilisateur et de si celui-ci est connecté ou non :

- Consulter des recettes : <br/>
A l'ouverture du site vous arrivez sur l'accueil de celui-ci dans cette endroit vous aurez la possibilité de consulter les 3 dernières recettes dans la liste des recettes en cliquant sur celle-ci. 
<p align="center"><img src="https://github.com/omar-amrouss/RecettesManagment/assets/133509604/722e24b2-2061-4877-bc42-55cd98b5ff74"
 width="600" title="home"></p>

Vous pouvez aussi sur le header du siteweb cliquer sur "Recettes" afin d'accéder à la liste compléte des recettes que vous pourrez par la suite consulter.
<p align="center"><img src="https://github.com/omar-amrouss/RecettesManagment/assets/133509604/79be8043-f06f-4c93-9b9d-a4b1f464021e" width="600" title="recette"></p>

- Saisir un formulaire de contact : <br/>
Il est possible de saisir un formulaire de contact dans l'onglet "Contact" du header et d'avoir un feedback de l'envoie de celui-ci juste après son envoie.
<p align="center"><img src="https://github.com/omar-amrouss/RecettesManagment/assets/133509604/72042707-d2a4-4756-86c1-45580c970171" width="600" title="contact"></p>

- l'Inscription : <br/>
Il est possible pour un utilisateur de s'inscrire pour avoir un comtpe utilisateur sur le site en cliquant sur "Register".
<p align="center"><img src="https://i.postimg.cc/85vbPCPx/register.png" width="600" title="register"></p>

- l'Authentification : <br/>
Il est également possible si l'utilisateur possède déjà un compte utilisateur de se connecter directement au site en cliquant sur "Login".
<p align="center"><img src="https://i.postimg.cc/fT1TYTw8/login.png" width="600" title="login"></p>

- Ajout de recette avec fichier média : <br/>
Après s'être identifié l'utilisateur aura à présent la possiblité d'ajouter des recettes en cliquant sur le bouton "ajouter une recette".
<p align="center"><img src="https://i.postimg.cc/x8t5B4dd/add-Recette.png" width="600" title="addRecette"></p>

Ce bouton amène l'utilisateur vers le formulaire d'ajout d'une recette dans lequel il pourra saisir les différentes informations de la recette et ajouter une image pour celle-ci, il aura également la possibilité d'avoir une "preview" de l'image avant l'ajout de celle-ci.
<p align="center"><img src="https://i.postimg.cc/3rVPBtqZ/add-Recette-Form.png" width="600" title="addRecetteForm"></p>

- Modifier et Supprimer : <br/>
Après l'ajout d'une recette l'utilisateur propriétaire (le créateur de la recette) aura la possibilité si il le souhaite de modifier ou de supprimer celle-ci en consultant la liste des recettes dans l'onglet "Recette". 
<p align="center"><img src="https://i.postimg.cc/QMC2mvj0/proprio-Recette.png" width="600" title="RecetteCreator"></p> <br/>

En cliquant sur l'icone de modification l'utilisateur va accéder au formulaire de modification, formulaire dans lequel les informations de la recette seront déjà pré-rempli. L'utilisateur n'aura plus qu'a y mettre ces modifications.
<p align="center"><img src="https://i.postimg.cc/Gtn3Zb2c/editForm.png" width="600" title="RecetteCreator"></p> <br/>

L'utilisateur aura aussi la possibiltié de supprimer sa recette en cliquant sur l'icône de suppression, résultant à la suppression de sa recette de la base de donnée.
<p align="center"><img src="https://i.postimg.cc/PqZ5KLX6/delete.png" width="600" title="RecetteDelete"></p> <br/>

- Visualisation du détail d'une recette : <br/>
L'utilisateur peut visualiser le détail d'une recette en cliquant sur l'oeil dans la liste des recettes (visible sur la capture d'écran précédente). Il sera alors redirigé vers la page suivante.
<p align="center"><img src="https://i.postimg.cc/MHtNg47C/Screenshot-2021-04-21-Cooking-Welcome-2.png" width="600" title="CommentOnRecette"></p> <br/>

- Liker un post : <br/>
Un utilisateur connecté a la possibilité de liker une recette. Si il n'est pas connecté, il pourra voir le nombre de likes, mais ne pourra pas ajouter le sien.
<p align="center"><img src="https://i.postimg.cc/d0129f37/Screenshot-2021-04-21-Cooking-Welcome-3.png" width="600" title="CommentOnRecette"></p> <br/>

- Ecrire des commentaires : <br/>
Après s'être connecté l'utilisateur va débloquer un nouvel aspect lors de la consultation d'une recette qui est la possibilité d'écrire des commentaires. (Soumission du formulaire en Ajax).
De plus, les utilisateurs peuvent supprimer les commentaires des recettes qui leurs appartiennent.
<p align="center"><img src="https://i.postimg.cc/xdRDVc3J/Screenshot-2021-04-21-Cooking-Welcome.png" width="600" title="CommentOnRecette"></p> <br/>


- Gestion des recettes par l'Administrateur : <br/>
Le site sépare les utilisateurs en 2 catégories ou rôles différents, les utilisateurs classique et les administrateurs.
Actuellement le site ne dispose que d'un administrateur par défaut. <br />
Pour rappel les identifiants de l'administrateur sont: admin@admin.com avec pour mot de passe: adminadmin . <br/>
**En tant qu'administrateur celui-ci a accés à toutes les fonctionnalités présenter précédement et cela pour toutes les recettes. 
Cette à dire consulter, modifier, supprimer, ajouter des recettes et même écrire des commentaires sur n'importe quelle recette.**
<p align="center"><img src="https://i.postimg.cc/VsKy2jNJ/Admin-View.png" width="600" title="AdminView"></p> <br/>

- Autres fonctionnalités : <br/>
Une vérification des formulaires est effectuer avant la validation de chaque formulaire afin d'éviter tout bug.

## Difficultés rencontrées : <br/>
Les premières difficultés que nous avons rencontrées sont dues à des problèmes de compréhension du sujet et du code fournis.
Nous avons aussi essayé en vain de mettre en place des components Vuejs, malheureusement cela n'a pas abouti et nous nous sommes contraints à des vues classiques.
Hormis ça, les difficultés mineurs sont dues au fait que nous ne connaissions pas ce framework, nous avons donc passé beaucoup de temps à nous documenter sur internet.
<br/>
Toutefois, nous avons beacoup appris durant ce projet, il reste donc une bonne experience.




