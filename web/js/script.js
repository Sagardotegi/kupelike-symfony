/*global $*/

/** Search open **/

$(document).ready(function($) {

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
});
    
//* Search zoom disable *//    
    
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


/*cambiar idiomas*/
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
        /*//$('.idiomas').children('.eus').addClass('idiomas-non-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-non-active');
        //$('.idiomas').children('.en').addClass('idiomas-non-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-non-active');*/
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
        /*//$('.idiomas').children('.es').addClass('idiomas-non-active');
        $('.idiomas-side').children('.es').addClass('idiomas-side-non-active');
        //$('.idiomas').children('.en').addClass('idiomas-non-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-non-active');*/
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
        /*//$('.idiomas').children('.eus').addClass('idiomas-non-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-non-active');
        //$('.idiomas').children('.es').addClass('idiomas-non-active');
        $('.idiomas-side').children('.es').addClass('idiomas-side-non-active');*/
    }
}

/*function cambiarActive(){
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
}*/

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
$(document).ready(function($) {
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
});


/*contacto sidrerias*/
$(document).ready(function() {
  
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
  
  
  
});

/* Swipe right para ir a la página anterior */
// https://github.com/mattbryson/TouchSwipe-Jquery-Plugin
/*global history*/
/*$(function() {
  $(document).swipe( {
    //Generic swipe handler for all directions
    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
      alert("You swiped " + direction );
      history.back();
    }
  });
});*/

/*slides
.on('swipeleft', function(e) {
  slides.eq(i + 1).addClass('active');
})
.on('swiperight', function(e) {
  slides.eq(i - 1).addClass('active');
});*/

/*$(document).ready(function() {
$(document).on('swiperight', function (e) {
    alert("aa");
    //history.back();
});
});*/
/*$(document).bind('swiperight', function () {
    history.back();
});*/
/*$.mobile.defaultPageTransition = 'slide';
$( "body" ).on( 'swiperight', function() {history.back()}); 
$( "body" ).on( 'swipeleft', function() {history.forward()});   
$("a").attr("data-transition", "fade");*/


/* eliminar archivos de filestack*/
/*
filepicker.setKey("AnjcKYi0oTomOZxBk7c7Ez");

var blob = {
  url: ''
};
    console.log(JSON.stringify(blob));
    var cdn_url = blob.url;
    console.log("Removing...");
    filepicker.remove(
      blob, {
        policy: 'eyJleHBpcnkiOjE2ODgxMzkwNTJ9',
        signature: '89b33aeb5bd917c9df3b5949396460bba8a3f4f41e2f6b7c9854e29b965ceed5'
      },
      function(blob) {
        console.log("Removed");
        filepicker.remove(
          cdn_url,
          function(FPError) {
            console.log(FPError.toString());
          },
          function(metadata) {
            console.log("removing file again (expected result: error 171)...");
            console.log(JSON.stringify(metadata));
          }
        );
      }
    );
    */