/** Search open **/

$(document).ready(function($) {

    $('#searchButton').on('click', function(){
        $(this).toggleClass('active');
        $('.searchBox').slideToggle().css('width', '350');
        $('#searchIcon').toggleClass('fa-times');
        $('.searchResults').slideToggle(1000);
    });
    
    cambiarActive();
    //$('#search').textinput('option','preventFocusZoom',false);
    
    
});


/** Menu Open **/
$(document).on('click', function(e) {
  if($(e.target).is('.navbar-ham *')) {
    $('.menu').addClass('visible-menu');
  } else {
    $('.menu').removeClass('visible-menu');
  }
});

/** Scroll to Sagardotegiak **/
$(document).on('click','.btn-encuentra', function(event) {
    event.preventDefault();
    var target = "#" + this.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top -130
    }, 1500);
});

/** Access window open **/

  $(document).ready(function($) {

    $('.btn-access').on('click', function(){
        $$("#contactdiv").css("display", "block");
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
    
/* APP info script */

/*$(document).ready(function($) {
  
      $('.info-icon').hover(function(){
          $(this).slideToggle(1000);
          $(this).siblings('.info-textarea').slideToggle(1000);
       
    });
});*/

function cambiarActive(){
    var url = window.location.pathname;
    
    if ( url.indexOf("/es/") > -1 ) {
        $('.es').removeClass('lang-non-active');
        $('.es').addClass('lang-active');
        $('.eus').removeClass('lang-active');
        $('.en').removeClass('lang-active');
        $('.eus').addClass('lang-non-active');
        $('.en').addClass('lang-non-active');
    } else if( url.indexOf("/eus/") > -1 ){
        $('.eus').removeClass('lang-non-active');
        $('.eus').addClass('lang-active');
        $('.es').removeClass('lang-active');
        $('.en').removeClass('lang-active');
        $('.es').addClass('lang-non-active');
        $('.en').addClass('lang-non-active');
    } else if( url.indexOf("/en/") > -1 ){
        $('.en').removeClass('lang-non-active');
        $('.en').addClass('lang-active');
        $('.eus').removeClass('lang-active');
        $('.es').removeClass('lang-active');
        $('.eus').addClass('lang-non-active');
        $('.es').addClass('lang-non-active');
    } else {
        $('.es').removeClass('lang-active');
        $('.eus').removeClass('lang-active');
        $('.en').removeClass('lang-active');
        $('.es').addClass('lang-non-active');
        $('.eus').addClass('lang-non-active');
        $('.en').addClass('lang-non-active');
    }
}


/* APP info script */

/*$(document).ready(function($) {
      $('.single-kupela').onClick(function(){
          $(this).find('.single-kupela-info').slideToggle(1000);
       
    });
});*/


/*function showResult(str) {
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
}*/



