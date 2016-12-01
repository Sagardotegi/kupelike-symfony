/**
* carga el SDK de Facebook
*/ 
window.fbAsyncInit = function() {
    FB.init({
      appId      : '238649363223511',
      cookie     : true,
      version    : 'v2.8'
    });

    return false;
    
};
    
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function login()
{
    FB.login(function(response){
        if(response.authResponse){
            // cuando está conectado a Facebook
            console.log("Cookie");
        } else {
            // cuando no lo está
            console.log("no cookie");
        }
    });
}
    
 