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
    
});