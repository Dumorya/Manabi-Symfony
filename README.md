# Manabi-Symfony

Pour installer le projet correctement, il faut suivre plusieurs étapes.

##Cloner le projet

Placez-vous dans le répertoire souhaité puis lancez la commande suivante

```shell
git clone https://github.com/Dumorya/Manabi-Symfony.git
```

## Installation

Récupérer les dépendances PHP
```shell
composer install
```

Créer la base de données
```shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Charger les données de test
```shell
php bin/console doctrine:fixtures:load
```

Démarrer le serveur
```shell
php bin/console server:run
```

Copier coller le fichier .env et le renommer en .env.local puis copier les deux lignes suivantes :
```shell
# change login, password, 8889 and database_name by your data
DATABASE_URL=mysql://login:password@127.0.0.1:8889/database_name

# username is your full Gmail or Google Apps email address
# change email@gmail.com by your adress mail and gmailPassword by your Gmail password
MAILER_URL=gmail://email@gmail.com:gmailPassword@localhost
```

Si une erreur concernant BCrypt survient, essayer de changer bcrypt par argon2i dans config/packages/security.yaml
```shell
        App\Entity\User:
        # change bcrypt by argon2i
            algorithm: bcrypt
```
C'est tout ! Normalement vous êtres prêt à utiliser Manabi sans problème !
