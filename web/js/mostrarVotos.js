$('document').ready(function(){
    
    
    $.ajax({
        url:'/web/app_dev.php/mostrar-votos/1',
        action:"GET",
        dataType: "json",
        data: response,
        success: function(response){
            
        }
    })
    
    
   
         /** xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
           document.getElementById('id').innerHTML=xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","Kupela.php?id=" + $id + "numVotos" + $numVotos,true);
          xmlhttp.send();**/
       
       
    
   
    
    
    
    
});