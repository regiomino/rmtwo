/**
 * Created by Martin on 04.08.14.
 */
jQuery(document).ready(function ($) {
    
    $('#partner-logos a').tooltip();
    
    //messages are placed inside a bootstrap modal #messageModal. this triggers it, when it's there.
    $('#messageModal').modal('show');

    //displays popovers in header steps on hover and click (for tablets)
    $('#steps_shop, #steps_payment, #steps_delivery, .label-details').popover(
        {
            trigger: 'hover click',
            html: true
        }
    );

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

    $('.salesguys select').change(function() {
        var nidstring = $(this).attr('id');
        var res = nidstring.split("_");
        
        data = new Object;
		data['nid'] = res[1];
		data['uid'] = $(this).val();

		callback_url = Drupal.settings.basePath + 'manage/sales/assignprofile/' + data['nid'] + '/' + data['uid'];
            
		$.ajax({
			url: callback_url,
			type: 'POST',
			data: data,
		});
    });

    $('#filterShops').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.panel-default').hide();
        $('.panel-default').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
    
    // Counter
    $("ul.countdown").jCounter({
		date: "25 august 2014 12:00",
		timezone: "Europe/Berlin",
		format: "dd:hh:mm:ss",
		twoDigits: 'on',
                serverDateSource : 'https://www.regiomino.de/dateandtime.php'
	  
	});
    
});