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
    
});