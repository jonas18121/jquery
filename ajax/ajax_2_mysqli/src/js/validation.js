'use strict';

$(function(){

    jQuery.validator.setDefaults({
        debug: false, // avec true le formulaire n'est pas soumis
        success: "valid"
    }); 

    $("#form_connexion_user").validate({

        submitHandler: function(form) {
            form.submit();
        },

        invalidHandler: function(event, validator)
        {
            let errors = validator.numberOfInvalids();

            if (errors) {
                
                let message = (errors == 1) ? 'Vous avez ' + errors + ' erreur à corriger' : 'Vous avez ' + errors + ' erreurs à corriger';
                $('div#error span').html(message); 
                $('div#error').show();
            }
            else{
                $('div#error').hide();
            }
        },

        rules: {
            email: {
                required: true,
                email: true
            },
            password_verif: {
                equalTo: '#password'
            }
        },
        messages: {
            email: {
                required: ' Vous êtes obliger de mettre votre adresse email',
                email: ' Votre email doit contenir un @, sinon ce n\'est pas un email'
            },
            password: {
                required: ' Vous êtes obliger de mettre un mot de passe ',
                minlength: jQuery.validator.format(' Votre mot de passe doit contenir minimun 2 caractères')
            },
            password_verif: {
                required: ' Vous êtes obliger de mettre un mot de passe de comfirmation ',
                equalTo: '  Votre mot de passe de comfirmation doit correspondre à votre premier mot de passe'
            }
        } 

    });
    

    
});