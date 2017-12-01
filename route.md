# Idées initiales concernant les méthodes
|Action|Méthode|form-data|$_POST/$_GET|
|-|-|-|-|
|Créer une liste|POST|listName|name=STRING|
|Modifier le nom d'une liste|POST|listId, listNewName|id=INT, newName=STRING|
|Créer un post-it|POST|title, resume, content, categories|title=STRING, resume=STRING, content=STRING, categories=INT|
|Modifier le nom d'un post-it|POST|taskId, taskNewTitle|id=INT, newTitle=STRING|
|Lire un résumé|GET|taskResume|?taskResume=INT|
|Supprimer une liste|GET|listDelete|?listDelete=INT|
|Supprimer un post-it|GET|taskDelete|?taskDelete=INT|

# URL
Liste des URL et méthodes choisis que l'on utilisera dans notre application.
### Listes
- Créer une liste : `POST /list/create`
- Modifier le nom d'une liste : `POST /list/update`
- Supprimer une liste : `GET /list/123/delete`

### Tâches
- Créer une tâche : `POST /task/create`
- Modifier le nom d'une tâche : `POST /task/update`
- Supprimer une tâche : `GET /task/123/delete`
- Déplacer une tâche : `/task/` ??? Difficile à déterminer pour l'instant

### Pages
- Home : `GET /`
- Contact : `GET /pages/contact`
- Validation formulaire de contact : `POST /pages/contact`
- Qui sommes-nous ? : `GET /pages/qui-sommes-nous`
