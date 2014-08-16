/**
 * Created by Martin on 04.08.14.
 */
jQuery(document).ready(function ($) {
    
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
    
    // Counter
    $("ul.countdown").jCounter({
		date: "25 august 2014 12:00:00",
		timezone: "Europe/Berlin",
		format: "dd:hh:mm:ss",
		twoDigits: 'on',
                dateSource: 'remote',
                serverDateSource : 'https://www.regiomino.de/dateandtime.php'
	  
	});
    
});