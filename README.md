# Influmatch (Docker)

## Lancer le projet
1) Construire et demarrer les conteneurs :
```
docker-compose up --build
```
2) Acceder au site : http://localhost:8080

## Ports utilises
- App: 8080 -> 80
- MySQL: 3306 -> 3306

## Identifiants MySQL
- Database: influmatch
- User: influmatch_user
- Password: influmatch_pass
- Root password: root

## Arreter les conteneurs
```
docker-compose down
```

## Reinitialiser la base
```
docker-compose down -v
```

## Initialisation automatique
Les fichiers `sql/bdd.sql` et `sql/data.sql` sont executes automatiquement au premier demarrage du conteneur MySQL.
# joh
