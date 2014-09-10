 
jQuery(document).ready(function ($) {
    
    var timeout;
    
    if ( !Modernizr.input.placeholder) {
        $('body').addClass('no-placeholder');
    }

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

    $('.delivery-meta a').popover({
         html : true,
         placement: 'bottom',
         trigger : 'hover',
         container : 'body'
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
  
    $('.add-to-cart-area').click(function(){
        clearTimeout(timeout);
        var $el = $(this);
        
        $el.find('.fa-shopping-cart').addClass('hidden');
        $el.find('.fa-check-circle').removeClass('hidden');
        
            timeout = setTimeout(function(){
                $el.find('.fa-shopping-cart').toggleClass('hidden');
                $el.find('.fa-check-circle').toggleClass('hidden');
            },860)
        
    
    });
    
    
});