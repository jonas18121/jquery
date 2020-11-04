# J Q U E R Y

## EN JQUERY

$("#toto").val(); en GETTER

$("#toto").val(10); en SETTER


#### .done()
représente la réponse qui suit le $.ajax()

exemple :

        $("#envoi_reception").click(function(){

            $.ajax({
                url: "index.php",
                data: {
                    nombre: $("#nombre").val()
                },
                method: "POST"
            })
            .done(function(nombre){
                console.log(nombre);
            });

        });

#### .change()

c'est un évènnement sur le contenu


#### .append()

ajouter du html


#### .data()

Stockez les données arbitraires associées aux éléments correspondants.

exemple :

        for (let index = 0; index < nom.length; index++) {

            $("#liste_fruits").append('<li data-nom="' + nom[index] + '">' + nom[index] + '</li>');
            
        }

        // Ajout des elements terminé
        $("#liste_fruits li").click(function(){

            $("#recherche_fruit").val($(this).data("nom"));

        });

`ici data() va sélectoinner les valeurs(élélments) qui seront dans l'attribut data-nom dans le < li > `