# Formation Vue.js 3 [step-00]

## Contexte

Nous partons d'un projet **Symfony** "classique" utilisant des templates en **Twig**.

## Objectif

Nous allons ajouter des parties dynamiques utilisant **Vue.js** dans nos templates Twig pour faire 
connaissance avec la lib.

## Pré-requis

- [Docker Compose](https://docs.docker.com/compose/install/)
- **Stopper tous les conteneurs docker** éventuels qui pourraient être lancés en dehors de ce 
  projet pour éviter les conflits de port. La commande `docker ps` doit retourner une liste vide
- Ce projet utilise **PHP 8.0**, n'oubliez pas de configurer l'interpreteur PHP de votre IDE pour 
  une meilleure reconnaissance

## Lancement du projet

```sh
$ docker-compose up --build -d
``` 

Il est possible de consulter les **logs** :
```shell
$ docker-compose logs -f
```

La commande `docker ps` devrait retourner les deux conteneurs docker :
- **php** : contient le code php de l'application, le service php-fpm
- **caddy** : reverse proxy 
- **database** : la base de données
- **mailer** : le catcher de mails

Il suffit ensuite d'ouvrir la page `https://localhost` dans le navigateur web et d'[accepter le 
certificat TLS auto-généré](https://stackoverflow.com/a/15076602/1352334).

***
Ce projet support utilise le template [Symfony Docker de Kévin Dunglas](https://github.com/dunglas/symfony-docker).
