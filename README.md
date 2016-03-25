# Outils et langages utilisés

## Développement

Symfony 2.8
Composer
PHP
Ajax

## Tests

Behat
Mink
Selenium

# Instructions de mise en route :

## Procédure de lancement :

> git clone https://github.com/Kunamatata/readitlater.git
> git clone https://github.com/Kunamatata/ReadItLaterChromeExtension.git

Pour lancer le site, aller dans le dossier du projet, puis lancer :

> composer update
> php bin/console server:start

Pour l'extension, aller dans Chrome → Extension → Charger extension non empaquetée, et choisir le dossier cloné de l'extension.

## Exécution des tests

Télécharger http://goo.gl/IHP6Qw (Selenium Standalone Server 2.53.0)

Dans un terminal, lancer la commande :

> java -jar selenium-server-standalone-2.53.0.jar 

Exécuter les tests avec la commande suivante à la racine du projet :

> vendor/bin/behat

# Travail réalisé :

## Fonctionnalités du site

- Extraction et sauvegarde d'un article. Cliquez sur le bouton “Add Link”, renseigner le lien dans le champ affiché, puis valider.
- Affichage des titres des différents articles sauvegardés non lus sur la page principale.
- Possibilité de lire l'article extrait en entier en appuyant sur le bouton « Read more... » en dessous de chaque titre d'article.
- Suppression d'un article. Cliquez sur la croix en bas des articles affichés (pas de rafraîchissement car la suppression d'un article réalisée avec Ajax).
- Archivage d'un article. Cliquez sur le bouton d'archivage à gauche de chaque article (pas de rafraîchissement car l'archivage est réalisé avec Ajax).
- Visualiser les articles archivés. Cliquez le bouton « Archived » en haut de la page (pas de rafraîchissement car l'affichage des bons articles est effectué avec Ajax).
- Rajouter une nouvelle catégorie pour classifier les articles. Pour cela, cliquer sur « Add Folder », et renseignez le nom de la catégorie.
- Classifier un article dans une catégorie. Cliquez sur le bouton de classification en dessous du nom de l'article, puis sélectionnez la catégorie dans laquelle vous souhaitez classer l'article.
- Visualiser tous les articles liés à une catégorie. Cliquez sur le nom de la catégorie (pas de rafraîchissement car l'affichage des bons articles est réalisé avec Ajax).
- Utiliser une extension pour sauvegarder un article. Cliquer sur le bouton de l'extension sur une page afin d'en extraire le possible article.
- Mise en place d'un design minimal.
- Versioning du projet.

Le stockage des données a été réalisé à partir de deux fichiers json. Le premier, links.json, sauvegarde l'ensemble des articles, avec pour chaque article son titre, son contenu, son url, le fait qu'il soit archivé ou non, et sa possible catégorie. Le second, categories.json, sauvegarde le nom des différentes catégories de l'utilisateur.

## Tests

Développement de tests testant :

- Le bon affichage de la page principale.
- Le bon ajout d'un article.
- La possibilité de visualiser la page d'un article extrait.
- L'archivage et le désarchivage d'un article.
- La possibilité de catégoriser un article.
- La bonne suppression d'un article.

Tous les tests sont positifs après exécution.

## Ce qui n'a pas été réalisé

- La suppression d'une catégorie, car nous n'avons pensé à cette fonctionnalité qu'à la fin.
- La possibilité de supprimer la catégorie d'un article pour qu'il ne soit plus associé à aucune catégorie. Si nous l'avions implémenté, nous aurions rajouté une possibilité dans la liste des possibilités de catégories, du type « Aucune ».
- L'API. Nous avons préféré prendre le temps d'apprendre à utiliser Symfony ainsi que la mise en place des tests, et avons volontairement délaissé l'API dans cette optique.
