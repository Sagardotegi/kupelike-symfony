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
        $('.idiomas').children('.es').addClass('idiomas-active');
        $('.idiomas-side').children('es').addClass('idiomas-side-active');
    } else if( url.indexOf("/eus/") > -1 ){
        $('.idiomas').children('.eus').addClass('idiomas-active');
        $('.idiomas-side').children('.eus').addClass('idiomas-side-active');
    } else if( url.indexOf("/en/") > -1 ){
        $('.idiomas').children('.en').addClass('idiomas-active');
        $('.idiomas-side').children('.en').addClass('idiomas-side-active');
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

/*filepicker de filestack*/
$(document).ready(function($) {
    $("#foto2").click(function(){
        filepicker.setKey("AnjcKYi0oTomOZxBk7c7Ez");
        filepicker.pick(
          {
            imageQuality: 80,
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