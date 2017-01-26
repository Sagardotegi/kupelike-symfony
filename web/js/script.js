/** Search open **/

$(document).ready(function($) {

    $('#searchButton').on('click', function(){
        $(this).toggleClass('active');
        $('.searchBox').slideToggle().css('width', '350');
        $('#searchIcon').toggleClass('fa-times');
        $('.searchResults').slideToggle(1000);
    });
});


/** Menu Open **/
$(document).on('click', function(e) {
  if($(e.target).is('.navbar-ham *')) {
    $('.menu').addClass('visible-menu');
  } else {
    $('.menu').removeClass('visible-menu');
  }
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

$(document).ready(function($) {
  
      $('.info-icon').hover(function(){
          $(this).slideToggle(1000);
          $(this).siblings('.info-textarea').slideToggle(1000);
       
    });
});


/* APP info script */

$(document).ready(function($) {
  
      $('.single-kupela').onClick(function(){
          $(this).find('.single-kupela-info').slideToggle(1000);
       
    });
});


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



