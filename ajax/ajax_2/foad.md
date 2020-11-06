# FOAD 06/11 et 09/11

Échéance :9 novembre 2020 23:59

Instructions

`Objectif : mettre en pratique l'utilisation d'AJAX, de la POO et des requêtes avec statement.`

Vous devez `créer une plateforme d'échanges de messages` (un forum anonyme), dans laquelle les utilisateurs peuvent :
   
    - publier des messages
    
    - répondre aux messages publiés
    
    - La connexion à la base de donnée se fera à l'aide d'un singleton.
    
    - Les requêtes se feront avec des statements.
    
    - liker ou disliker les messages (en AJAX)
    Le like et le dislike se feront en AJAX, le serveur renverra le nouveau nombre de likes et de dislikes, ce qui mettra à jour le compteur.

    - Un utilisateur ne peut pas liker plusieurs fois, ni liker et disliker en même temps.
    
    - Il faudra créer les classes "message" et "réponse".
    Un utilisateur peut publier, répondre, liker, disliker sans avoir besoin de s'identifier, pour le distinguer d'un autre utilisateur, on utilisera son adresse IP accessible avec $_SERVER['REMOTE_ADDR']

    - Un "message" contiendra des "réponses" et donc la classe message une méthode getReponses().