jQuery(document).ready(function ($) {

    $('#side-menu').metisMenu();
    $('.salesDataTable').dataTable();
    
    $('.panel-heading a[data-toggle]').on('click.panelHeading', function(){
        var $el = $(this);
        $elPanel = $el.parents('.panel-heading');
        $('.panel-heading').not($elPanel).removeClass('active');
        $elPanel.toggleClass('active');
    });
    
    /*
     * Tooltip für Darstellung von Empfehlern im Salestool
     */
    $('.suggester-tooltip').tooltip();
    

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
 
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });
    
var flotOptions = {
    xaxis: {
        mode: "time",
        timeformat: "%d-%m-%Y"
    },
    
    legend :  {
        show : true
    },
    
    series: {           
        lines: {
            show: true,
            fill: true
        },
        points: {
            show: true
        }
    },
    
    grid: {
        hoverable: true
        
    },
    tooltip: true,
    tooltipOpts: {
        content: "'%s' of %x.1 is %y.4",
       // content: "%y.4",
        shifts: {
            x: -60,
            y: 25
        }
    }
};


 
 
var flotPath = "/rm-sales-getstatistics";

/* $graphs = array(
        'profiles' => array(
            array(
                'label' => t('created profiles'),
                'data' => $flotCreatedProfiles,
            ),
            array(
                'label' => t('created customer profiles'),
                'data' => $flotCreatedCustomerProfiles,
            ),
            array(
                'label' => t('created seller profiles'),
                'data' => $flotCreatedSellerProfiles,
            ),
            array(
                'label' => t('created trader profiles'),
                'data' => $flotCreatedTraderProfiles,
            ),
        ),
    );*/

    

function initFlot() {
    
    $.ajax({
       url: flotPath,
       type: "POST",
       dataType : 'json',
 
   }).success(function(data) {
        
        for (var p in data) {
            
           $.plot($('#'+ p+''),data[p],flotOptions);
        }
     
    });
}

initFlot();
    
});
 
 