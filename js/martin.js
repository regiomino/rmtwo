jQuery(document).ready(function ($) {
    
    /*
     * GLOBAL
     * Wenn das Captcha Formular falsch abgeschickt wird, wird der suggestModal direkt wieder geöffnet
     */
    if($('#suggestModal').find('input').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
    /*
     * FRONTEND
     * Wenn als parameter ?suggest=1 der URL übergeben wird, wir das suggestModal direkt geöffnet
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
     * Tooltip für Darstellung von Empfehlern
     */
    $('.suggester-tooltip').tooltip();
    
    /*
     * GLOBAL
     * messages are placed inside a bootstrap modal #messageModal. this triggers it, when it's there.
     */
    $('#messageModal').modal('show');
});