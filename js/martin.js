jQuery(document).ready(function ($) {
    if($('#suggestModal #edit-mollom-captcha').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    if($('#suggestModal #edit-mollom-captcha').hasClass('error')) {
        $('#suggestModal').modal('show');
    }
    
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