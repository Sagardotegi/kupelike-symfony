$(document).ready(function($) {

    $('.searchBox').on('focus', function(){
        $(this).removeClass('form-control').addClass('form-control-widen');
       // $('#navbar-search').removeClass('col-xs-6 pull-right').addClass('col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-0');
        $('.searchResults').slideDown(1000);
    });
    
   $('.searchBox').on('blur', function(){
        $(this).removeClass('form-control-widen').addClass('form-control');
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
    
$(document).ready(function(){
  $('.parallax').parallax();
});