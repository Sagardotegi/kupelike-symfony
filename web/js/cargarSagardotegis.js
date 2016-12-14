$(document).ready(function(){
    
    var listaSagardotegis = [];
    var accesToken;
    
        window.fbAsyncInit = function() {
            // iniciamos la aplicación de Facebook
            FB.init({
                appId      : '238649363223511',
                status     : true,
                xfbml      : true,
                cookie     : true
            });
        }
        
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/all.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    
            /**
             * Obtenemos una sagardotegi
             */
            FB.api(
                '/1704315726496042',
                'GET',
                {
                    "fields":"posts,phone", 
                    "access_token":"238649363223511|42b7ae25f21439cfcf10af9c3a88ac08"
                },
                function(response) {
                    console.log(response);
                }
            );
        
        
    
   /**
    * Llamamos a la función que obtiene las sagardotegis
    *
    $.ajax({
        url: '/web/app_dev.php/save-sagardotegis'
    });*/
    
});