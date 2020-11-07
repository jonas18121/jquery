'use strict'

$(function () {
    
    /////////// Afficher et masquer les réponses d'un message précis ////////

    $("#cache_reponse").hide();

    $("#voir_reponse").click(function(){

        $("#affiche_reponse").empty();

        $("#voir_reponse").hide();
        $("#cache_reponse").show(); 
        

        $.ajax({
            url: "../../index_ajax.php",
            data: {
                id_message: $("#id").val() 
            },
            method: "POST",
            dataType: "json"
        })
        .done(function(reponse){ 
            
            if (reponse.length == '') {
                $("#affiche_reponse").append('<p>Il n\'ya pas encore de reponse, soyer le premier à écrire une réponse </p>');
            }

            for (let index = 0; index < reponse.length; index++) {

                console.log(reponse[index]);
                $("#affiche_reponse").append(
                    '<div>'  +
                        '<p> publier par ' + reponse[index].pseudo + ' le ' + reponse[index].date_at.date + '</p>' +
                        '<p>' + reponse[index].content + '</p>'
                    + '</div>'
                );
            }
            
        });

        $("#cache_reponse").click(function(){
            $("#voir_reponse").show();
            $("#cache_reponse").hide();
            $("#affiche_reponse").hide();
        });

        $("#voir_reponse").click(function(){
            $("#voir_reponse").hide();
            $("#cache_reponse").show();
            $("#affiche_reponse").show();
        });

    });

    /////////// Fin de afficher et masquer les réponses d'un message précis ////////
            
    
});