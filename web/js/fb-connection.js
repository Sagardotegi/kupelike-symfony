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
    
    FB.getLoginStatus(function(response) {
        if(response.status === 'connected'){
            console.log("Estás conectado con Facebook");
        } else if(response.status === 'not_authorized') {
            console.log("No estás conectado con Facebook");
        }
    });
    
};
    
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
    
 