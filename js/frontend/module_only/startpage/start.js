jQuery(document).ready(function ($) {
//FPM, Front Page Map
var FPM = FPM || {};
window.FPM = FPM;
FPM.pathToTheme = Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme;
FPM.downloadUrl = Drupal.settings.basePath + 'rm-shop-participantxml';
FPM.mapContainer = "frontpageGoogleMap";
FPM.latlng  = [];
FPM.customerMarker = [];
FPM.sellerMarker = [];
FPM.$mapControl = $('#map-control');



FPM.clusterSellerStyle = [
    {   
        url: FPM.pathToTheme + '/images/markers/seller_cluster_small.png',
        height: 60,
        width: 60,
        textColor: '#fff',
        textSize: 20,
            
    }, 
    {
       url: FPM.pathToTheme + '/images/markers/seller_cluster_medium.png',
        height: 80,
        width: 80,
        textColor: '#fff',
        textSize: 20,
        
    }, 
    {
        url: FPM.pathToTheme + '/images/markers/seller_cluster_large.png',
        width: 100,
        height: 100,
        textSize: 20,
        textColor: '#fff',
    }
];

FPM.clusterCustomerStyle = [
    {   
        url: FPM.pathToTheme + '/images/markers/cutomer_cluster_small.png',
        height: 60,
        width: 60,
        textColor: '#fff',
        textSize: 20,
            
    }, 
    {
       url: FPM.pathToTheme + '/images/markers/cutomer_cluster_medium.png',
        height: 80,
        width: 80,
        textColor: '#fff',
        textSize: 20,
        
    }, 
    {
        url: FPM.pathToTheme + '/images/markers/cutomer_cluster_large.png',
        width: 100,
        height: 100,
        textSize: 20,
        textColor: '#fff',
    }
];

FPM.init = function(){
    var _self = this;
    _self.buildMap();
    _self.displayMarker();
    _self.addListeners();
};

FPM.addListeners = function() {
    var _self = this;
    _self.$mapControl.on('click', 'div.control',{obj: _self} ,_self.handleControlClick);
};

FPM.handleControlClick = function(e){
    var _self = e.data.obj;
    var $el = $(this);
    var type = $el.data('type');
    $el.toggleClass('active');
   
  if ( $el.hasClass('active')) {
        if (type === 'customer') {
            // _self.showCustomerMarker();
            _self.clusterCustomer.addMarkers( _self.customerMarker);
        }
        else if (type === 'seller') {
            // _self.showSellerMarker();
            _self.clusterSeller.addMarkers( _self.sellerMarker);
        }
    }
    else {
         if (type === 'customer') {
            // _self.hideCustomerMarker();
            _self.clusterCustomer.removeMarkers( _self.customerMarker);
        }
        else if (type === 'seller') {
            // _self.hideSellerMarker();
            _self.clusterSeller.removeMarkers( _self.sellerMarker);
        }
    }
}

FPM.showCustomerMarker = function(){
    var _self = this;
    for (var i = 0, length = _self.customerMarker.length; i<length;i++) {
        _self.customerMarker[i].setMap(_self.map);
    }
}

FPM.hideCustomerMarker = function(){
    var _self = this;
    for (var i = 0, length = _self.customerMarker.length; i<length;i++) {
        _self.customerMarker[i].setMap(null);
    }
};

FPM.buildMap = function(){
    var _self = this;

    _self.customIcons = {

        seller_profile: {
            icon: new google.maps.MarkerImage(FPM.pathToTheme + '/images/markers/marker-sprite.png', new google.maps.Size(27, 36), new google.maps.Point(0, 0)),
        },
        
        customer_profile: {
            icon: new google.maps.MarkerImage(FPM.pathToTheme + '/images/markers/marker-sprite.png', new google.maps.Size(27, 36), new google.maps.Point(32, 0)),
        } 
    };

    _self.popUpWindow = new google.maps.InfoWindow();
    _self.mapOptions = {
        center: new google.maps.LatLng(49.800855, 11.017640),  
        zoom: 10,
        mapTy_selfd: 'roadmap',
        mapTypeControl : false,
        streetViewControl : false,
        zoomControl: true,
        scrollwheel: false   
    };

    _self.map = new google.maps.Map(document.getElementById(_self.mapContainer),_self.mapOptions);
};

FPM.displayMarker = function(){
    var _self = this;
    
    $.ajax({
        url: _self.downloadUrl,
        type: "POST",
        dataType : 'xml',
  
    }).success(function(data) {
       
       var markers = $(data).find('marker');
       FPM.injectMarker(markers);
    });
};

FPM.injectMarker = function(marker) {
    var _self = this;
    
   $.each(marker,function(i,item) {
        var type = item.getAttribute('type');
        
        if (type === 'inactive_profile' || type === 'prospect_profile' || type === 'trader_profile') {
            return;
        }
        
        var point =  new google.maps.LatLng(
            parseFloat(item.getAttribute('lat')),
            parseFloat(item.getAttribute('lng'))
        );
        _self.latlng.push(point);
        var name = item.getAttribute('name');
        var address = item.getAttribute('address');
        var popUpHtml = "<b>" + name + "</b> <br/>" + address;
        
        var gmMarker = new google.maps.Marker({
            position : point,
            map : _self.map,
            title : name,
            icon : _self.customIcons[type].icon,
           
        });
        
        if (type === 'seller_profile') {
            _self.sellerMarker.push(gmMarker);
        } 

        else if (type === 'customer_profile') {
            _self.customerMarker.push(gmMarker);
        }
       
        
        google.maps.event.addListener(gmMarker, 'click', function(e) {
            _self.openPopUp(gmMarker,popUpHtml);
        });
    });

    _self.clusterCustomer =  new MarkerClusterer(_self.map, _self.customerMarker, {
        gridSize :80,
        styles :  _self.clusterCustomerStyle,
        minimumClusterSize : 2,
        maxZoom : 12
    });

    _self.clusterSeller =  new MarkerClusterer(_self.map, _self.sellerMarker, {
        gridSize : 80,
        styles :  _self.clusterSellerStyle,
        minimumClusterSize : 3,
        maxZoom : 14
    });
    _self.clusterSeller.fitMapToMarkers();
};

FPM.fitMarker = function(){
    var _self = this;
    var latlngbounds = new google.maps.LatLngBounds();
    for (var k = 0; k < _self.latlng.length; k++) {
        latlngbounds.extend(_self.latlng[k]);
    }
    _self.map.fitBounds(latlngbounds);
};

FPM.openPopUp = function(marker,html){
    var _self = this;
    _self.popUpWindow.setContent(html);
    _self.popUpWindow.open(_self.map, marker);
};


$('#gastro').click(function(){
    $('html,body').animate({
        scrollTop: 0
    }, 800, function(){
         $('#edit-zipcode').focus();
    });
});
    
$('a[href*=#]:not([href=#])').click(function() {
   
    var target = $(this.hash),
       
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 65
        }, 800)
        return false;
    }
});

function injectGMaps(){
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +'callback=FPM.init';
    document.body.appendChild(script);
};
 
window.onload = injectGMaps;  
 

 $('#testimonials').carousel();
 
});