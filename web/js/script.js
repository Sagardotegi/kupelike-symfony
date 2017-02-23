/*global $*/
/* global navigator */
$(document).ready(function($) {
/** Search open **/
//$(document).ready(function($) {
    $('#searchButton').on('click', function(){
        $(this).toggleClass('active');
        $('.desktop-menu').toggleClass('col-md-7 col-lg-8 visible-md visible-lg').addClass('hidden');
        $('#navbar-search').parent().toggleClass('col-md-1 col-md-8 col-lg-9');
        $('.searchBox').toggleClass('hidden').css('width', '345');
        $('.searchBox').focus();
        $('#searchIcon').toggleClass('fa-times');
        $('.searchResults').slideToggle(500);
        //$("head").append('<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">');
    });
    
    cambiarActive();
    //$('#search').textinput('option','preventFocusZoom',false);
    
    
//});


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

//$(document).ready(function($) {

    $('.btn-access').on('click', function(){
      $('.accessWrapper').fadeIn();
      $("#accessWindow").css('display','block');
      $('#user').focus();
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
//});

/** Stat window open **/

//$(document).ready(function($) {

    $('.btn-stats').on('click', function(){
      //id = event.target.id;
      $('.statsWrapper').fadeIn(150);
      $("."+event.target.id).css('display','block');
      //$(window).width($(document).width());
      //window.dispatchEvent(new Event('resize'));
      //setTimeout(toggleZoomScreen, 1000);
    });
    
    $('.closeStats').click(function(){
	    $('.statsWrapper').fadeOut();
	    $('.stats').fadeOut();
	});
	//function toggleZoomScreen() {
    //document.body.style.zoom="100%";
  //} 
	
	$(document).mouseup(function (e) {
     var stats = $(".stats");
     if (!stats.is(e.target) && stats.has(e.target).length == 0) {
         stats.fadeOut(500);
     }
  });
//});
    
/* Search zoom disable */   
    
$("#searchButton").on('click', zoomDisable);
function zoomDisable(){
  $('head meta[name=viewport]').remove();
  $('head').prepend('<meta name="viewport" content="user-scalable=no" />');
  setTimeout(zoomEnable, 1000);
}

function zoomEnable(){
  $('head meta[name=viewport]').remove();
  $('head').prepend('<meta name="viewport" content="user-scalable=yes" />');
}


/* cambiar idiomas */
function cambiarActive(){
    var url = window.location.pathname;
    
    if ( url.indexOf("/es/") > -1 ) {
        $('.idiomas').children('.es').removeClass('idiomas-non-active');
        $('.idiomas-side').children('.es').removeClass('idiomas-side-non-active');
        $('.idiomas').children('.es').addClass('idiomas-active');
        $('.idiomas-side').children('.es').addClass('idiomas-side-active');
        $('.idiomas').children('.eus').removeClass('idiomas-active');
        $('.idiomas-side').children('.eus').removeClass('idiomas-side-active');
        $('.idiomas').children('.eus').addClass('idiomas-non-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-non-active');
        $('.idiomas').children('.en').removeClass('idiomas-active');
        $('.idiomas-side').children('.en').removeClass('idiomas-side-active');
        $('.idiomas').children('.en').addClass('idiomas-non-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-non-active');
    } else if( url.indexOf("/eus/") > -1 ){
        $('.idiomas').children('.eus').removeClass('idiomas-non-active');
        $('.idiomas-side').children('.eus').removeClass('idiomas-side-non-active');
        $('.idiomas').children('.eus').addClass('idiomas-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-active');
        $('.idiomas').children('.es').removeClass('idiomas-active');
        $('.idiomas-side').children('.es').removeClass('idiomas-side-active');
        $('.idiomas').children('.es').addClass('idiomas-non-active');
        $('.idiomas-side').children('.es').addClass('idiomas-side-non-active');
        $('.idiomas').children('.en').removeClass('idiomas-active');
        $('.idiomas-side').children('.en').removeClass('idiomas-side-active');
        $('.idiomas').children('.en').addClass('idiomas-non-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-non-active');
    } else if( url.indexOf("/en/") > -1 ){
        $('.idiomas').children('.en').removeClass('idiomas-non-active');
        $('.idiomas-side').children('.en').removeClass('idiomas-side-non-active');
        $('.idiomas').children('.en').addClass('idiomas-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-active');
        $('.idiomas').children('.eus').removeClass('idiomas-active');
        $('.idiomas-side').children('.eus').removeClass('idiomas-side-active');
        $('.idiomas').children('.eus').addClass('idiomas-non-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-non-active');
        $('.idiomas').children('.es').removeClass('idiomas-active');
        $('.idiomas-side').children('.es').removeClass('idiomas-side-active');
        $('.idiomas').children('.es').addClass('idiomas-non-active');
        $('.idiomas-side').children('.es').addClass('idiomas-side-non-active');
    }
}

var confirmar;
function seguro(){
confirmar = confirm("¿Seguro?"); 
    if (confirmar) {
        // si pulsamos en aceptar
        return true;
    }else{ 
        // si pulsamos en cancelar
        return false;
    }           
}

/* global filepicker */
/*filepicker de filestack*/
//$(document).ready(function($) {
    $("#foto2").click(function(){
        filepicker.setKey("AnjcKYi0oTomOZxBk7c7Ez");
        filepicker.pick(
          {
            imageQuality: 50,
            //imageMax: [800, 600],
            //imageMin: [300, 200],
            //imageDim: [400, 300],
            mimetype: 'image/*',
            container: 'window',
            services: ['COMPUTER', 'FACEBOOK', 'INSTAGRAM', 'GOOGLE_DRIVE', 'DROPBOX']
          },
          function(Blob){
            $("#foto").val(Blob.url);
          },
          function(FPError){
            console.log(FPError.toString());
         });
        
    });
//});


/*contacto sidrerias*/
//$(document).ready(function($) {
  
  var mostrado = false;
    
  $("#contactoSidreria").click(function(){
    if(mostrado == false){
     $("#mostrarcontacto").fadeIn(1000);
     mostrado = true;
    }else if(mostrado == true){
     $("#mostrarcontacto").fadeOut(1000); 
     mostrado = false;
    } 
     
  });
  
  
  
//});

/* Swipe para abrir menu */

//$(document).ready(function($) {
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
    //var url = window.location.pathname;
    
    //if ( url.indexOf("/index") <= -1 ) {
    
      $(document).bind("touchstart",empezar);
      $(document).bind("touchend",terminar);
    //}
  }
//});

var eancho;
var ealto;
var sancho;
var salto;
var mancho;
var malto;
var stop = 0;
var stop2;
var mstop;
function empezar(event) {
  malto = 0;
	var touch = event.originalEvent.changedTouches[0];
	eancho = touch.pageX;
	ealto = touch.pageY;
	stop = $(this).scrollTop();
}

function terminar(event) {
	var touch = event.originalEvent.changedTouches[0];
	stop2 = $(this).scrollTop();
	sancho = touch.pageX;
	salto = touch.pageY;
	mancho = sancho - eancho;
	malto = salto - ealto;
	mstop = stop - stop2;
	if (mstop < 0){
	    mstop = mstop* -1;
	}
	if (malto < 0){
	    malto = malto* -1;
	}
	if (mancho < 0){
	    mancho = mancho* -1;
	}
	malto = malto*3;
	if (mancho > malto) {
	  if (mancho > mstop) {
	    //history.back();
	    if (eancho > sancho){
	      $('.menu').removeClass('visible-menu');
	    } else if (sancho > eancho){
	      $('.menu').addClass('visible-menu');
	    }
	    
	  }
	}
  //console.log("Movido: "+mstop+" Desde: "+eancho+" Hasta: "+sancho);
}
/* Swipe end */
});