$(document).ready(function(){
    
    var listaSagardotegis = [];
    
    /**
     * Llamamos a la API de Facebook
     */
        window.fbAsyncInit = function() {
            // iniciamos la aplicación de Facebook
            FB.init({
                appId      : '238649363223511',
                status     : true,
                xfbml      : true,
                cookie     : true
            });
            
            /**
             * Generamos un access token de app
             */
            var accesToken;
             
            FB.api('https://graph.facebook.com/oauth/access_token?client_id=238649363223511&client_secret=42b7ae25f21439cfcf10af9c3a88ac08&grant_type=client_credentials ', function(response){
                accesToken = response.accessToken;
                console.log(accesToken);
            });
            
            
            /**
             * Obtenemos las sagardotegis
             */ 
            FB.api('/1704315726496042', function(response){ // la pagina de facebook debe indicarse con su ID
                console.log(response);
                var kupelikeSagardotegia = response;
                listaSagardotegis.push(kupelikeSagardotegia);
            });
        };
        
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
        type: "POST",
        url: '/save-sagardotegis',
        data: listaSagardotegis
    });*/
    
});