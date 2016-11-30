/**
* carga el SDK de Facebook
*/ 
window.fbAsyncInit = function() {
    FB.init({
      appId      : '238649363223511',
      xfbml      : true,
      version    : 'v2.8'
    });

    FB.AppEvents.logPageView();
    
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
        if(response.status === 'connected'){
            // cuando está conectado a Facebook
            document.getElementById("login-btn").innerHTML = getDatos();
        } else if(response.status === 'not_authorized') {
            // cuando no lo está
        }
    });
}

function getDatos()
{
    return FB.api('/me', 'GET', { fields: 'first_name, last_name, picture' }, function(response){
        console.log(response);
        document.getElementById("login-btn").innerHTML = "<img src='" + response.picture.data.url + "' />";
    });
}
    
 