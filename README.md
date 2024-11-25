# ENSG-ING2-DevWeb
Projet Développement Web en ING2 à l'ENSG-Géomatique, réalisé par Vivien Boucher et Bruce Pourny.

Seul le dossier /Core-master contient les données du projet. Le dossier /Cours nous a servi pour nous échanger des codes que nous avons fait pendant le cours.

## Guide d'installation
### Récupération de la base de données et intégration au site
Version : PostGreSQL 17
Site et port : localhost:5432
Base de données : objets
Identifiant : postgres
MDP : VI22ol14

La base de données vous est fournie sous deux formats, dans le dossier /Core-master/assets/ :
- soit au format "Plain", avec le code permettant de recréer la base avec des requêtes SQL ;
- soit au format "Custom" proposé par PgAdmin : il vous suffit simplement de créer une nouvelle base de données vide, puis de faire clic droit sur cette BD et "Restore".

NB : si vous avez rencontré le même problème que nous pour utiliser les fonctions "Backup" et "Restore" (un problème de version de PostGreSQL), sachez que vous pouvez le régler en faisant "File > Preferences > Paths > Binary paths". Dans "PostgreSQL Binary Path", vous pouvez remplacer "$DIR/../runtime" par le dossier où vous avez installé PostGreSQL, puis "./PostGreSQL/17/bin"

### GeoServer
Le workspace du GeoServer se trouve dans ./Core-master/assets/geoserver

## Déroulement des énigmes
Le jeu se passe à l'échelle du campus Descartes.
1. Le jeu débute avec un livre très bien caché, à proximité de l'ENSG.
2. Vous avez ensuite trouvé un objet... "GTA"... au niveau du bâtiment Bois de l'Étang. En ayant le livre de départ, vous pouvez le débloquer et avoir un trophée.
3. Ce trophée est cependant bloqué par un code, que vous trouverez au niveau de la stade de la Butte verte (à l'ouest de l'ENSG).
4. Ce qui vous permet de débloquer le trophée, et vous donner un trésor !

## Des pistes d'amélioration
- Dans certains endroits, nous appelons /API/objets/N en fixant le N...
- La structure préconisée pour la base de données n'a été que partiellement respectée
- Notamment avec les deux éléments précédentes, mais aussi la structure générale de notre code, nous aurions du mal à ajouter des objets à cet espace game
- Il aurait été également pertinent d'ajouter une colonne Victoire dans la table "objets" pour savoir quel objet permet de déclencher un événement de victoire
- Le code n'est certainement pas protégé contre les attaques par injections SQL. Mais nous connaissons très bien cette méthode.