/**
 * Created by Martin on 04.08.14.
 */
jQuery(document).ready(function ($) {

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

/*    $('#directoryModal').on('shown.bs.modal', function () {
        google.maps.event.trigger(map, "resize");
        var latlngbounds = new google.maps.LatLngBounds();
        for (var i = 0; i < latlng.length; i++) {
            latlngbounds.extend(latlng[i]);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    });

    $('#filterDirectory').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.searchable tr').hide();
        $('.searchable tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });*/

    $('#filterShops').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.panel-default').hide();
        $('.panel-default').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
});