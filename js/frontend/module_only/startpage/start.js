jQuery(document).ready(function ($) {

//FPM, Front Page Map
var FPM = FPM || {};
window.FPM = FPM;
FPM.pathToTheme = Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme;
FPM.downloadUrl = Drupal.settings.basePath + 'rm-shop-participantxml';
FPM.mapContainer = "frontpageGoogleMap";
FPM.latlng  = [];
FPM.popUpWindow = new google.maps.InfoWindow();
FPM.mapOptions = {
    center: new google.maps.LatLng(49.800855, 11.017640),  
    zoom: 10,
    mapTypeId: 'roadmap',
    mapTypeControl : false,
    streetViewControl : false,
    zoomControl: true,
    scrollwheel: false   
};
FPM.customerMarker = [];
FPM.sellerMarker = [];
FPM.$mapControl = $('#map-control');

FPM.customIcons = {
    
    seller_profile: {
        icon: FPM.pathToTheme + '/images/markers/seller_profile.png'
    },
    
    customer_profile: {
        icon: FPM.pathToTheme + '/images/markers/customer_profile.png'
    } 
};

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
            _self.showCustomerMarker();
        }
        else if (type === 'seller') {
            _self.showSellerMarker();
        }
    }
    else {
         if (type === 'customer') {
            _self.hideCustomerMarker();
        }
        else if (type === 'seller') {
            _self.hideSellerMarker();
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

FPM.showSellerMarker = function(){
    var _self = this;
    for (var i = 0, length = _self.sellerMarker.length; i<length;i++) {
        _self.sellerMarker[i].setMap(_self.map);
    }
};

FPM.hideSellerMarker = function(){
    var _self = this;
     
    for (var i = 0, length = _self.sellerMarker.length; i<length;i++) {
        _self.sellerMarker[i].setMap(null);
    }
};

FPM.buildMap = function(){
    var _self = this;
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
        if (type === 'inactive_profile' || type === 'prospect_profile') {
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
           // zIndex: _self.customIcons[type].zindex,
        });
        
        if (type === 'seller_profile') {
            _self.sellerMarker.push(gmMarker);
        }
        else if (type === 'customer_profile') {
            _self.customerMarker.push(gmMarker);
        }
        
        _self.fitMarker();
        
        google.maps.event.addListener(gmMarker, 'click', function(e) {
            _self.openPopUp(gmMarker,popUpHtml);
        });
    });
};

FPM.fitMarker = function(){
    var _self = this;
    var latlngbounds = new google.maps.LatLngBounds();
    for (var k = 0; k < _self.latlng.length; k++) {
        latlngbounds.extend(_self.latlng[k]);
    }
    _self.map.fitBounds(latlngbounds);
}

FPM.openPopUp = function(marker,html){
    var _self = this;
    _self.popUpWindow.setContent(html);
    _self.popUpWindow.open(_self.map, marker);
};


(function() {
   FPM.init();
})();

 
            
      


    $('#gastro').click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 800, function(){
             $('#edit-zipcode').focus();
        });
    });
    
     $('a[href*=#]:not([href=#])').click(function() {
        
            var target = $(this.hash),
                hash = this.hash;
            
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                      scrollTop: target.offset().top - 65
                    }, 800, function(){
                        location.hash = hash;
                        });
                    return false;
                }
        
        });
    
 
});