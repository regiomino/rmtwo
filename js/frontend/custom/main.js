 
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
    
    $('.media-body span').popover({
         html : true,
         placement: 'top',
         trigger : 'hover',
         container : 'body'
        });
    
    /*$('a[data-toggle="modal"]').click(function(e) {
        e.preventDefault();
        console.info("Click Link");
    });*/

    function isTouch() {
        var regex = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i;
            return regex.test(navigator.userAgent);
        }
        
        if (!isTouch()) {
             $('#edit-zipcode').focus();
        }

    $('#partner-logos a').tooltip();
    
    //messages are placed inside a bootstrap modal #messageModal. this triggers it, when it's there.
    $('#messageModal').modal('show');

    //makes sure external links are opened in new window
    $('a').each(function() {
        var a = new RegExp('/' + window.location.host + '/');
        var b = new RegExp('javascript:gaOptout');
        
        if(!a.test(this.href) && !b.test(this.href)) {
            
            $(this).click(function(event) {
                console.info(this.href);
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, '_blank');
            });
        }
    });
  
   
    
     /*
      *Suggest
     * Wenn als parameter ?suggest=1 der URL �bergeben wird, wir das suggestModal direkt ge�ffnet
     * Ist wichtig f�r die Seite www.regiomino.de/vorschlagen
     */
    
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    var suggest = getParameterByName('suggest');
    if(suggest == 1) {
        $('#suggestModal').modal('show');
    }
    
    $('.delivery-select label').add('.payment-select label').click(function () {
        $(this).tab('show');
    });
    
    
    
    
    //Checkout
    
   var d =  $('#edit-delivery').add('#edit-paymenttypes').find('input[type=radio]:checked').parent().addClass('active');
    

    $('#edit-delivery input[type=radio]').add('#edit-paymenttypes input[type=radio]').on('change', function (e) {
        if ( !this.checked) return
         $(this).parents('.form-radios').find('.form-type-radio').removeClass('active');
         $(this).parent().addClass('active');
    });
    
  
    
});