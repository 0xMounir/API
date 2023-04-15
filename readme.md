
# Création API REST

## **PROJET**
Premier projet pour crér une API REST.  
Cette API permettra d'afficher et créer des animes et ses différentes catégories.  

## **BASE DE DONNÉES**
Importer le fichier `tables.sql` dans votre base de données.  
La base de données contient 2 tables `animes` & `categories` et sont relier par une clé étrangère.  

## **MÉTHODE GET**
Afficher tous les animes `localhost/api/animes/readAnime.php`  
Afficher toutes les catégories `localhost/api/categories/readCategorie.php`

## **MÉTHODE POST**
#### *- EXEMPLE CRÉATION NOUVELLE COLONNE ANIME EN JSON*  
`localhost/api/animes/createAnime.php` 
```json
{
    "nom": "One Piece",
    "synopsis": "Il fut un temps où Gold Roger était le plus grand de tous les pirates, le 'Roi des Pirates' était son surnom. A sa mort, son trésor d'une valeur inestimable connu sous le nom de 'One Piece' fut caché quelque part sur 'Grand Line'. De nombreux pirates sont partis à la recherche de ce trésor mais tous sont morts avant même de l'atteindre. Monkey D. Luffy rêve de retrouver ce trésor légendaire et de devenir le nouveau 'Roi des Pirates'. Après avoir mangé un fruit du démon, il possède un pouvoir lui permettant de réaliser son rêve. Il lui faut maintenant trouver un équipage pour partir à l'aventure !",
    "season": 20,
    "episodes": 1056,
    "image": "https://fr.web.img5.acsta.net/pictures/19/08/09/14/53/1842996.jpg",
    "studio": "Toei Animation",
    "start_date": 1999,
    "categories_id": 1
}
```
 
#### *- EXEMPLE CRÉATION NOUVELLE CATÉGORIE EN JSON*  
`localhost/api/categories/createCategorie.php`
```json
{
    "nom": "Shonen"
}
```