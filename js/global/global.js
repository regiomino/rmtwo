jQuery(document).ready(function ($) {
    
    /*
     * Wenn das Captcha Formular falsch abgeschickt wird oder ein anderes Formularfeld
     * nicht validiert, wird der suggestModal direkt wieder ge�ffnet.
     */
    if($('#suggestModal').find('input').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
    /*
     * Fehlermeldungen von Drupal/PHP werden in Form eines Bootstrap Modals
     * ins Template geschrieben und m�ssen immer �berall automatisch ge�ffnet werden
     */
    $('#messageModal').modal('show');
    
    
    $form = $('#rm-sales-suggest-form').add('#rm-sales-suggest-form--2');
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


    $f = $('#user-register-form');
    $p_p = $('#edit-phone--2').add('#edit-postal-code--2');
    $s = $f.find('#edit-submit--4');
   
    
    $s.on('click', function(e){
      
        e.preventDefault();
        $p_p.val(function(index,val){
            var newVal = $.trim(val.replace(/\D/g,''));
            return newVal;
        });
        
        $f.submit();
    });
    
});