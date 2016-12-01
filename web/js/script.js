$(document).ready(function($) {

    $('.searchBox').on('focus', function(){
        $(this).removeClass('form-control').addClass('form-control-widen');
        $('#navbar-search').removeClass('navbar-search').addClass('navbar-search-widen');
       // $('#navbar-search').removeClass('col-xs-6 pull-right').addClass('col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-0');
        $('.searchResults').slideDown(1000);
    });
    
   $('.closeSearch').on('click', function(){
        $('.searchBox').removeClass('form-control-widen').addClass('form-control');
        $('#navbar-search').removeClass('navbar-search-widen').addClass('navbar-search');
        //$('#navbar-search').removeClass('col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-0').addClass('col-xs-6 pull-right');
        $('.searchResults').slideUp(1000);
    });
            
});

$(document).ready(function($) {
        $('.toggle-button').click(function() {
            $('.menu').addClass('visible-menu');
        });
        
        $('.close-menu').click(function() {
            $('.menu').removeClass('visible-menu');
        });
    });
    
//* Search zoom disable *//    
    
$(".searchBox").mouseover(zoomDisable).mousedown(zoomEnable);
function zoomDisable(){
  $('head meta[name=viewport]').remove();
  $('head').prepend('<meta name="viewport" content="user-scalable=0" />');
}
function zoomEnable(){
  $('head meta[name=viewport]').remove();
  $('head').prepend('<meta name="viewport" content="user-scalable=1" />');
}
    
    


function showResult(str) {
  if (str.length==0) { 
    document.getElementById("searchResults").innerHTML="";
    document.getElementById("searchResults").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("searchResults").innerHTML=this.responseText;
      document.getElementById("searchResults").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","searchResults.php?q="+str,true);
  xmlhttp.send();
}


