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
        scrollTop: $(target).offset().top
    }, 1500);
});

/** Access window open **/

$(document).ready(function($) {

    $('.btn-access').on('click', function(){
      $('.accessWrapper').fadeIn();
      $("#accessWindow").css('display','block');
    });
    
    $('#closeAccess').click(function(){
			  $('.accessWrapper').fadeOut();		
			  $('#accessWindow').fadeOut();
		  return false;
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



