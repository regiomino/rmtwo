jQuery(document).ready(function ($) {
    
    /*
     * Wenn das Captcha Formular falsch abgeschickt wird, wird der suggestModal direkt wieder geöffnet
     */
    if($('#suggestModal #edit-mollom-captcha').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
    /*
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
});