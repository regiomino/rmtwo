 
jQuery(document).ready(function ($) {
    
    if ( !Modernizr.input.placeholder) {
        $('body').addClass('no-placeholder');
    }
    
    $('.grid-l').affix({
         'offset' : 40
    });
     
     
    $('#read-more').on('click', function(e){
        e.preventDefault();
        $('#short-desc').hide();
        $('#long-desc').show();
    });
    
     $('#read-less').on('click', function(e){
        e.preventDefault();
        $('#long-desc').hide();
        $('#short-desc').show();
    });

    
    
    $('#partner-logos a').tooltip();
    
    //messages are placed inside a bootstrap modal #messageModal. this triggers it, when it's there.
    $('#messageModal').modal('show');

    //makes sure external links are opened in new window
    $('a').each(function() {
        var a = new RegExp('/' + window.location.host + '/');
        if(!a.test(this.href)) {
            $(this).click(function(event) {
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, '_blank');
            });
        }
    });
  
    
    
});