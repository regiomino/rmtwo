jQuery(document).ready(function ($) {
    
    /*
     * Wenn das Captcha Formular falsch abgeschickt wird oder ein anderes Formularfeld
     * nicht validiert, wird der suggestModal direkt wieder geöffnet.
     */
    if($('#suggestModal').find('input').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
    /*
     * Fehlermeldungen von Drupal/PHP werden in Form eines Bootstrap Modals
     * ins Template geschrieben und müssen immer überall automatisch geöffnet werden
     */
    $('#messageModal').modal('show');
    
    
    $form = $('#rm-sales-suggest-form');
    $phone_postal = $('#edit-phone').add('#edit-postal-code');
    $submit = $form.find('input[type="submit"]');
   
    
    $submit.on('click', function(e){
        e.preventDefault();
        $phone_postal.val(function(index,val){
            var newVal = $.trim(val.replace(/\D/g,''));
            return newVal;
        });
        
        $form.submit();
    });


    $form = $('#user-register-form');
    $p_p = $('#edit-phone--2').add('#edit-postal-code--2');
    $submit = $form.find('#edit-submit--4');
   
    
    $submit.on('click', function(e){
        console.info("dad");
        e.preventDefault();
        $p_p.val(function(index,val){
            var newVal = $.trim(val.replace(/\D/g,''));
            return newVal;
        });
        
        $form.submit();
    });
    
});