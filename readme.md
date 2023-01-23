**Comment ajouter une énigme ?**

1) Ajouter une entrée dans le fichier json : json/games 

```
"exemple": {
"name": "Le nom de l'énigme,
"description": "La description de l'énigme,
"solution": "le sha1() de la solution après passage dans la fonction Page->stringToCleanUrl()",
"creator": "Le nom du créateur"
}
```


2) Créer les fichiers html, css et js en utilisant la clé du jeu

En gardant l'exemple de l'étape 1), la clé du nouveau jeu s'appelle "exemple" (la clé de l'entrée dans le fichier json), il faut donc créer au minimum un fichier html : ``html/games/exemple.html`` avec uniquement le code HTML du jeu, tout le reste est géré.
Le MVC détecte s'il y a des fichiers CSS et JS avec la même nomenclature pour les charger s'ils existent, ils doivent être rangés respectivement dans ``js/games/`` et ``css/games``, la miniature de l'énigme suit le même schéma et doit être ajoutée dans ``images/games-thumbnails`` (il doit s'agir d'un fichier .png).