/** Search open **/

$(document).ready(function($) {

    $('#searchButton').on('click', function(){
        $(this).toggleClass('active');
        $('.desktop-menu').toggleClass('col-md-7 col-lg-8 visible-md visible-lg').addClass('hidden');
        $('#navbar-search').parent().toggleClass('col-md-1 col-md-8 col-lg-9');
        $('.searchBox').toggleClass('hidden').css('width', '350');
        $('.searchBox').focus();
        $('#searchIcon').toggleClass('fa-times');
        $('.searchResults').slideToggle(500);
        //$("head").append('<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">');
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
      $('.accessWrapper').fadeIn();
      $("#accessWindow").css('display','block');
      $('#username').focus();
    });
    
    $('#closeAccess').click(function(){
	    $('.accessWrapper').fadeOut();		
	    $('#accessWindow').fadeOut();
	});
	
	$(document).mouseup(function (e) {
     var access = $("#accessWindow");
     if (!access.is(e.target) && access.has(e.target).length == 0) {
         access.fadeOut(500);
     }
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

function cambiarActive(){
    var url = window.location.pathname;
    
    if ( url.indexOf("/es/") > -1 ) {
        $('.idiomas .es').addClass('idiomas-active');
        $('.idiomas-side .es').addClass('idiomas-side-active');
    } else if( url.indexOf("/eus/") > -1 ){
        $('.idiomas .eus').addClass('idiomas-active');
        $('.idiomas-side .eus').addClass('idiomas-side-active');
    } else if( url.indexOf("/en/") > -1 ){
        $('.idiomas .en').addClass('idiomas-active');
        $('.idiomas-side .en').addClass('idiomas-side-active');
    }
}

function seguro(){
confirmar=confirm("¿Seguro?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}
