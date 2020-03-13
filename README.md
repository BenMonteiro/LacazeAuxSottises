# LacazeAuxSottises
Création du site de l'association culturelle Lacaze aux Sottises

## Description du site
Le site est un site destiné à faire connaître l'association et à diffuser les informations relatives à ses actions. 
Ce site à été réalisé via le framework [Symfony4](https://symfony.com/). Il intègre [twig](https://twig.symfony.com/) et [Bootstrap4](https://getbootstrap.com/docs/4.3/getting-started/introduction/) et est composé d'un côté client et d'un côté administration. 

## Installation
Afin de faire fonctionner le projet, il faut au préalable :
1) Installer composer
2) Renseigner les données de connexions de votre bdd dans le fichier .env
3) Créer la base de donnée via php bin/console doc:data:create
4) Jouer les migrations via la commande php bin/console doc:mig:mig
5)Lancer les fixtures via la commande php bin/console doc:fix:load
6) Les fixtures créés simulent des données et créé deux compte, un administrateur et un utilisateur. Les logins et mots de passe sont à récupérer dans src/DataFixtures/UserFixtures.php

## Fonctionnement
### Administration
La partie administration du site est sécurisé par un mot de identifiant et un mot passe. Il est nécéssaire d'avoir le statut d'administrateur pour s'y connecter. 
Via l'espace administration, il est possible d'ajouter, modifier ou supprimer:
- Des compagnies qui peuvent accueillir plusieurs représentation (un formulaire imbriqué à été mis en place afin d'ajouter les représentations relatives à la compagnie en même temps que la création de la dite compagnie)
- Des événements qui peuvent eux aussi accueillir plusieurs représentation.
- Des représentations (Chaque représentation fais obligatoirement partie d'une compagnie et d'un événements. Lors de l'ajout, un [système d'autocompletion](https://github.com/algolia/autocomplete.js/) réalisé en JS via un appel Ajax à été mis en place pour trouver la compagnie correspondant àla représentation)
- Des partenaires
- Des membres d'équipe
- Des administrateurs
- Des documents accessibles à la presse
- Des paragraphes dans les pages souhaités (Un champ appearanceOrder a été inclus pour déterminer l'ordre d'apparition des paragraphes dans la page). 

Un système de partage de documents à été intégrer. ainsi, avec un compte administrateur, on peut ajouter ou supprimer des documents qui seront récupérable par les utilisateurs via un compte utilisateur. Ces compte utilisateurs ont uniquement accès à la page de partage et ne peuvent que télécharger les documents. 

Un système WYSIWYG ([TinyMCE](https://www.tiny.cloud/)) a été intégrer pour faciliter la rédaction. 

Le téléchargement de document liés aux différents entitées (image de compagnie, images illustrant un paragraphe...) Sont uploader via [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle)

### Côté client
La partie client du site est gérée via le controller PageController. La grande majorité des pages du site sont générées via la méthode displayPage de ce controller dont les données sont fournies en fonction du slug de la page à afficher via le service PageDataProvider.


