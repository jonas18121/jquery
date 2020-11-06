'use strict'

$(function () {

    console.log($("#id").val());
    $("#cache_reponse").hide();
    
    $("#voir_reponse").click(function(){

        $("#affiche_reponse").empty();

        $("#voir_reponse").hide();
        $("#cache_reponse").show();
        

        $.ajax({
            url: "index_ajax.php",
            data: {
                id_message: $("#id").val() 
            },
            method: "POST",
            dataType: "json"
        })
        .done(function(reponse){ 

            //console.log(reponse);
            

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
    
});