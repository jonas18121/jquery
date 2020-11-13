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

                //console.log(reponse[index]);
                $("#affiche_reponse").append(
                    '<div>'  
                        + '<p> publier par <strong> ' + reponse[index].pseudo + ' </strong> le ' + reponse[index].date_at.date + '</p>' 
                        + '<p>' + reponse[index].content + '</p>'
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
            
    ////////// Créer un message et afficher les derniers message poster ///////////////

    $("#enregistrer_message").click(function(){

        $("#affiche_new_message").empty();
        
        $.ajax({
            url: "index_ajax.php",
            data: {
                post_pseudo: $("#pseudo").val(),
                post_title: $("#title").val(),
                post_content: $("#content").val()
            },
            method: "POST",
            dataType: "json"
        })
        .done(function(reponse){

            $("#affiche_new_message").append(

                '<div>'
                    + '<h2>Dernier message poster :</h2>'
                    + '<h3>' + reponse.title + '</h3>'
                    + '<p>publié par <strong>' + reponse.pseudo + '</strong> le ' + reponse.date_at.date + '</p>'
                    + '<a href="template/message/get_one_message.phtml?id_message= ' + reponse.id + '">'
                        + '<p>' + reponse.content + '</p>'
                    + '</a>' 
                + '</div>'
            );
        });
    });    

    ////////// Fin créer un message et afficher les derniers message poster  ///////////////

    ////////// Compteur Like et no like de message //////////

    $("#like").click(function(){

        $("#affiche_like").empty();
        

        $.ajax({
            url: "../../index_ajax.php",
            data: {
                id_message_id: $("#id").val(),
                yes_like: $("#like").val()
            },
            method: "post",
            dataType: "json"
        })
        .done(function(reponse){

            $("#affiche_like").append(reponse.yes_like);

        });
    });

    $("#no_like").click(function(){

        $("#affiche_no_like").empty();

        $.ajax({
            url: "../../index_ajax.php",
            data: {
                id_message_id: $("#id").val(),
                like_no: $("#no_like").val()
            },
            method: "post",
            dataType: "json"
        })
        .done(function(reponse){

            $("#affiche_no_like").append(reponse.no_like);
        });
    });

    //////////////////// new correct adri

    $('.like_dislike').click(function(){

        let id_message = $(this).data('id_message');
        let value   = $(this).data('value');

        $("#affiche_like").empty();
        $("#affiche_no_like").empty();
        
        $.ajax({
            url : "../../index_ajax.php",
            data: {
                id_message_id: id_message,
                value_like: value
            },
            method: "post",
            dataType: "json"
        })
        .done(function(reponse){

            console.log(reponse);
            $("#affiche_like").append(reponse.yes_like);
            $("#affiche_no_like").append(reponse.no_like);
        });

    });
    

    ////////// Fin compteur Like et no like de message ////////// 
});