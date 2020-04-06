# tp1ApiPph

##Quel est l'intérêt de créer une API plutôt qu'une application classique ?
L'interet de creer une api est de pouvoir avoir un front à part (angualr,react,...), mais aussi de 
pouvoir donner l'acces a nos ressource pour differentes platforme (application web et mobile qui on le meme back)


##Résumez les étapes du mécanisme de sérialisation implémenté dans Symfony
Pour passer d'un objet a un json on normalise l'objet en tableau puis ensuite on encode dans le format voulu
Pour passer d'un format encodé a un objet on decode l'élément en tableau puis ensuite on denormalise le tableau afin d'avoir un objet


##Qu'est-ce qu'un groupe de sérialisation ? A quoi sert-il ?
Les groupes de sérialization servent a afficher les attributs annoté du groupe, ce qui permet d'éviter les serialisation circulaire


##Quelle est la différence entre la méthode PUT et la méthode PATCH ?
La méthode patch permet d'update le nombre de champs que l'on veut (si je veux changer que le nom  je renseigne uniqument)
alors que le put lui vas "écraser" l'entitée que l'on modifie afin d'en recreer une avec les nouveaux champs

##Quels sont les différents types de relation entre entités pouvant être mis en place avec Doctrine ?
 #####ManyToOne    
       Each Article relates to (has) one category.
       Each category can relate to (can have) many Article objects

  #####OneToMany    
      Each Article can relate to (can have) many category objects.
      Each category relates to (has) one Article

  #####ManyToMany   
       Each Article can relate to (can have) many category objects.
       Each category can also relate to (can also have) many Article objects

  #####OneToOne     
       Each Article relates to (has) exactly one category.
       Each category also relates to (has) exactly one Article.



##Qu'est-ce qu'un Trait en PHP et à quoi peut-il servir ?

c'est un bout de code que l'on peut utiliser dans toute l'application (eviter la redondance)