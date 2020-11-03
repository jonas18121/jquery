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