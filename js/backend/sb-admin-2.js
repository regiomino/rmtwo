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
    
    var json = {
        "graphs": [ 
        
            {
                "container" : "#createdProfiles",
                "flotStuff" : {
                    "label" : "erstellte Profile",
                    "data" : [[1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]]
                }
            },
        
            {
               "container" : "#createdCustomerProfiles",
               "flotStuff" : {
                    "label" : "erstellte Kunden-Profile",
                    "data" : [[1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]]
               }
            },
        
            {
               "container" : "#createdSellerProfiles",
               "flotStuff" : {
                    "label" : "erstellte Verkäufer-Profile",
                    "data" : [[1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]]
               }
            },
        
            {
               "container" : "#createdTraderProfiles",
               "flotStuff" : {
                    "label" : "erstellte Händler-Profile",
                    "data" : [[1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]]
               }
            }
        ]
    };
 /*   
    {
    "label": "Japan",
    "data": [[1999, -0.1], [2000, 2.9], [2001, 0.2], [2002, 0.3], [2003, 1.4], [2004, 2.7], [2005, 1.9], [2006, 2.0], [2007, 2.3], [2008, -0.7]]
}
    
    // Sales Übersicht
   //$.plot($("#placeholder"), data, options);
   
    var rawData = [
    [1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]
];
 */
var flotOptions = {
    xaxis: {
        mode: "time"
    }
};

var a = [[1325347200000, 60], [1328025600000, 100], [1330531200000, 15], [1333209600000, 50]];

function initFlot() {
    
  /*   $.ajax({
        url: _self.PATH_GET_LOCATIONS,
        type: "POST",
        data :  _self.sq.getQuery(),
        dataType : 'json',
  
    }).success(function(data) {
             
    });
    */
  
   $.each(json.graphs,function(i,item) {
    console.info(item);
        var $container = $(item.container);
         
        $.plot($container, [item.flotStuff],flotOptions);
         
   });
    
}
 initFlot();

 /*$.plot($('#createdProfiles'),[
        {                    
            data: a
        }
    
    
    ],flotOptions);
    
    */
    
    
});
 
 
