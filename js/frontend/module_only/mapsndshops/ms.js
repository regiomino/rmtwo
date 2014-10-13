jQuery(document).ready(function ($) {

 var debounce = function(func, wait, immediate) {
     
        var timeout;
        return function() {
                var context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                }, wait);
                if (immediate && !timeout) func.apply(context, args);
        };
    };
    
    var viewport = function () {
        var e = window, a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
    };
    
    
    var adjustWinH = debounce(function(){
        var w = viewport(),
            vpW = w.width;
        
        
        var sH = (vpW >= 768 )?(w.height - 65): 300;
        
            $('.sidebar').css({
                'height' : sH + 'px'
            });
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        
        },200);
    
    
    $(window).on('resize.wind', adjustWinH).resize();
    
    $('.label-details').click(function(e) { e.preventDefault(); }).popover({
      trigger: 'click hover',
      html: true
    })

    $('#filterShops').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.col-seller-item').hide();
        $('.col-seller-item').filter(function () {
            return rex.test($(this).data('title'));
        }).show();
        
    });
    
    var pathToTheme = Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme;

    var customIcons = {
        inactive_profile: {
            icon: pathToTheme + '/images/markers/inactive_profile.png',
            zindex: 1
        },
        prospect_profile: {
            icon: pathToTheme + '/images/markers/inactive_profile.png',
            zindex: 2
        },
        customer_profile: {
            icon: pathToTheme + '/images/markers/customer_profile.png',
            zindex: 3
        },
        seller_profile: {
            icon: pathToTheme + '/images/markers/seller_profile.png',
            zindex: 4
        },
    };

    var map = new google.maps.Map(document.getElementById("directoryGoogleMap"), {
        center: new google.maps.LatLng(49.800855, 11.017640),
        zoom: 9,
        mapTypeId: 'roadmap'
    });

    var latlng = [];

    var infoWindow = new google.maps.InfoWindow;

    downloadUrl(Drupal.settings.basePath + 'rm-shop-participantxml', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
            var type = markers[i].getAttribute("type");
            
            var point = new google.maps.LatLng(
                parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));
            if(type != 'inactive_profile') latlng.push(point);
            var html = "<b>" + name + "</b> <br/>" + address;
            var icon = customIcons[type] || {};
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon,
                zIndex: icon.zindex
            });
            bindInfoWindow(marker, map, infoWindow, html);
        }
        google.maps.event.trigger(map, "resize");
        var latlngbounds = new google.maps.LatLngBounds();
        for (var i = 0; i < latlng.length; i++) {
            latlngbounds.extend(latlng[i]);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    });

    function downloadUrl(url,callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
        });
    }
    
    function doNothing(){
        
    }



var RMS = RMS || {};

window.RMS = RMS;
RMS.init = function(){
    RMS.filter.init();
};


//////////////////////////////////
// RM Map
//////////////////////////////////
RMS.map = {};

//////////////////////////////////
// RM Ajax
//////////////////////////////////
RMS.ajax = {};



////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// RM Filter
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

RMS.filter = {};
RMS.filter.init = function() {
    RMS.filter.category.init();
    RMS.filter.distance.init();
};

/////////////////////////////////////
//No UI Slider + Pips Addon
/////////////////////////////////////

RMS.filter.distance = {};
RMS.filter.distance.$elem = $('#distance-slider');
RMS.filter.distance.value_temp = null;
RMS.filter.distance.sliderOptions = {
    start: [ 0 ],
    connect : 'lower',
    range: {
		'min': 25,
		'20%': 50,
		'40%': 75,
		'60%': 100,
		'max': 150
	},
    snap: true
}

RMS.filter.distance.pipsFormat = {
    postfix : ' km'
};

RMS.filter.distance.pipsOptions = {
    mode: 'values',
	values: [25, 50, 75, 100, 150],
	density: 4,
	stepped: true,
    format: wNumb(RMS.filter.distance.pipsFormat)
}

RMS.filter.distance.init = function() {
    RMS.filter.distance.$elem.noUiSlider(RMS.filter.distance.sliderOptions);
    RMS.filter.distance.$elem.noUiSlider_pips(RMS.filter.distance.pipsOptions );
    RMS.filter.distance.setCacheVal(RMS.filter.distance.getValue());
    console.info( RMS.filter.distance.value_temp );
    RMS.filter.distance.addListeners();
    RMS.filter.distance.addSuffix();
    
}
RMS.filter.distance.addListeners = function(){
    RMS.filter.distance.$elem.on('change', function(){
        var sliderVal = RMS.filter.distance.getValue();
        if (sliderVal !==  RMS.filter.distance.getCacheVal()  ) {
        RMS.filter.distance.setCacheVal(sliderVal);
           
           //trigger AJAX-Update
        }
    });
};

RMS.filter.distance.setCacheVal = function(val){
    RMS.filter.distance.value_temp = val;
};

RMS.filter.distance.getCacheVal = function() {
    return RMS.filter.distance.value_temp;
};

RMS.filter.distance.getValue = function(){
    var val = RMS.filter.distance.$elem.val();
    return val;
};

RMS.filter.distance.addSuffix = function(){
    $('.noUi-pips-horizontal').find('.noUi-value').first().prepend('<');
    $('.noUi-pips-horizontal').find('.noUi-value').last().prepend('>');
};

/////////////////////////////////////     
//Kategorien Filter
/////////////////////////////////////
//@TODO: Backdrop f Touch, Text austauschen im Head bei active, 

RMS.filter.category = {};
RMS.filter.category.$items = $('.category-filter').find('.filter');

RMS.filter.category.init = function() {
    
    RMS.filter.category.$items.each(function(){
         new RMS.filter.category.CatFilter(this).init();
    });
    
    $(document)
        .on('click.filterHandle', RMS.filter.category.clearDropdowns)
        .on('click.filterHandle','.filter-content', function (e) { e.stopPropagation() })
        .on('click.filterHandle','.filter-name', function(e){e.stopPropagation();})
};

RMS.filter.category.clearDropdowns = function(){
    
    RMS.filter.category.$items.each(function () {
        var $el = $(this);
        if (!$el.hasClass('open')) return;
        $el.removeClass('open');
    });
};

RMS.filter.category.CatFilter = function(elem){
    this.$el = $(elem);
    this.$filterHead = $('.filter-name',this.$el);
    this.$reset = $('.reset', this.$filterHead);
    this.$filterContent = $('.filter-content',this.$el);
    this.$termListItems = $('.term-wrapper li',this.$filterContent);
};

RMS.filter.category.CatFilter.prototype = {
    
    init : function () {
        var _self = this;
        _self.addListeners();
    },
    
    toggle : function() {
        var _self = this;
        var isActive = _self.$el.hasClass('open');
        if (!isActive) {
            RMS.filter.category.clearDropdowns();
        }   
        _self.$el.toggleClass('open');
    },
    
    addListeners : function(){
        var _self = this;
        _self.$filterHead.on('click.filterHead',$.proxy(_self.toggle, _self));
        _self.$termListItems.on('click.term', _self.termClick);
        _self.$el.on('changedSelection',$.proxy(_self.handleSelectionChange,_self));
        _self.$reset.on('click.reset',$.proxy(_self.resetItems,_self));
    },
    
    termClick : function() {
        var $el = $(this);
        $el.toggleClass('active');
        $el.parents('.filter').trigger('changedSelection');
    },
    
    countActive : function (){
         var _self = this;
        return _self.$filterContent.find('li.active').length;
    },
    
    handleSelectionChange : function(){
       var _self = this;
       var activeItems = _self.countActive();
       
       if (activeItems >= 1) {
        _self.highlightFilterName();
       } else {
        _self.resetFilterName();
       }
    },
    
    highlightFilterName : function(){
       var _self = this;
       _self.$el.addClass('selected-category');
    },
    
    resetFilterName: function(){
        var _self = this;
       _self.$el.removeClass('selected-category');
    },
    
    resetItems : function (e){
        e.stopPropagation();
        var _self = this;
        _self.$termListItems.removeClass('active');
        _self.$el.trigger('changedSelection');
        if (!_self.isOpen) {
            _self.toggle();
        }
    },
    
    isOpen : function (){
        var _self = this;
        if (_self.$el.hasClass('open')) {
            return true;
        } else {
            return false;
        }
    }
};

(function(){
    RMS.init();
})();



});

