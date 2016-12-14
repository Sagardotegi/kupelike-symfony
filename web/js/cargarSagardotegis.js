$(document).ready(function(){
    
    var listaSagardotegis = [];
    var accesToken;
    /**
     * Llamamos a la API de Facebook
     */
        
            
            /**
             * Generamos un access token de app
             */
            FB.api('/oauth/access_token', 'GET', {"client_id":"238649363223511","client_secret":"42b7ae25f21439cfcf10af9c3a88ac08","grant_type":"client_credentials"}, function(response) {
                  accesToken = response.accessToken;
              }
            );
            
            
            
            /**
             * Obtenemos las sagardotegis
             */ 
            FB.api('/1704315726496042', function(response){ // la pagina de facebook debe indicarse con su ID
                console.log(response);
                var kupelikeSagardotegia = response;
                listaSagardotegis.push(kupelikeSagardotegia);
            });
        
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
    * Llamamos a la función que obtiene las sagardotegis
    *
    $.ajax({
        url: '/web/app_dev.php/save-sagardotegis'
    });*/
    
    console.log(accesToken);
    
});