
# Installation

## Première installation
1. creer un fichier .env.local et y ajouter les informations de connexion à la base de données


2. Installation des dépendances

```shell
composer install
```

3. creer la base de données
```shell
php bin/console doctrine:database:create
```

4. creer le fichier de migration
```shell
php bin/console make:migration
```

5. migration de la base de données
```shell
symfony console doctrine:migrations:migrate
```

6. fixtures
```shell
symfony console doctrine:fixtures:load
```
## Lancement
```shell
symfony server:start
```