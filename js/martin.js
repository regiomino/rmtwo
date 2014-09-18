jQuery(document).ready(function ($) {
    
    /*
     * GLOBAL
     * Wenn das Captcha Formular falsch abgeschickt wird oder ein anderes Formularfeld
     * nicht validiert, wird der suggestModal direkt wieder geöffnet.
     */
    if($('#suggestModal').find('input').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
    /*
     * FRONTEND
     * Wenn als parameter ?suggest=1 der URL übergeben wird, wir das suggestModal direkt geöffnet
     * Ist wichtig für die Seite www.regiomino.de/vorschlagen
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
    
    /*
     * BACKEND
     * Tooltip für Darstellung von Empfehlern im Salestool
     */
    $('.suggester-tooltip').tooltip();
    
    /*
     * GLOBAL
     * Fehlermeldungen von Drupal/PHP werden in Form eines Bootstrap Modals
     * ins Template geschrieben und müssen immer überall automatisch geöffnet werden
     */
    $('#messageModal').modal('show');
});