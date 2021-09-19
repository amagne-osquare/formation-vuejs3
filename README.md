# Formation Vue.js 3 [step-01]

## Contexte

Nous avons ajouter un morceau de **Vue.js** dans notre template Twig pour découvrir son 
fonctionnement basique.

## Objectif

Nous allons maintenant laisser de coté temporairement notre application Symfony et créer une 
application Vue.js indépendante pour approfondir notre connaissance de la lib.

## Pré-requis

- `npm` ou `yarn`
- Couper le watcher npm de Symfony Encore
- On peut couper les conteneurs Docker de la précédente étape pour le moment (`docker-compose stop`)

## Création de l'application Vue.js

Nous utilisons l'outil Vite pour créer notre application Vue.js :

```sh
$ npm init vite@latest vue-app -- --template vue
$ cd vue-app/
```

Nous avons à présent une application Vue.js 3 dans `vue-app`. Installons les dépendances et 
démarrons le serveur de développement :

```sh
$ npm install
$ npm run dev
```

La config de Vite et de ses plugins se trouve dans le fichier `vite.config.js`.  
L'application se trouve sur [http://localhost:3000/](http://localhost:3000/).
