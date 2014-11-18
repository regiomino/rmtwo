jQuery(document).ready(function ($) {
/*
  $.ajaxSetup({
             'beforeSend':function () {
                          console.log("ajax request: "+this.url);}
           });
           
      console.info(Drupal.settings.rm_shop);
  
 
*/



var RMS = RMS || {};
window.RMS = RMS;
RMS.PATH_TO_THEME = Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme;
RMS.$sellerArea = $('#sellers');
RMS.$sellerItemsArea = $('#sellers > .row');
RMS.init = function(){
    RMS.map.init();
    RMS.filter.init();
    RMS.fav.init();
};


//////////////////////////////////
// RM Ajax
//////////////////////////////////

// Filterauswahl schicken
// return: neue Marker + Ergebnisse
RMS.ajax = {};
RMS.ajax.LOADER_CLASSNAME = 'loading';
RMS.ajax.PATH_GET_LOCATIONS = '/rm-shop-filter';

RMS.ajax.Query = function() {
    
    this.qvalues = {
        map_bounds_ne_lat : Drupal.settings.rm_shop.map_bounds_ne_lat,
        map_bounds_ne_lng : Drupal.settings.rm_shop.map_bounds_ne_lng,
        map_bounds_sw_lat : Drupal.settings.rm_shop.map_bounds_sw_lat,  
        map_bounds_sw_lng : Drupal.settings.rm_shop.map_bounds_sw_lng,
        map_center : Drupal.settings.rm_shop.map_center,
        seller_name : Drupal.settings.rm_shop.seller_name,
        delivery_options : Drupal.settings.rm_shop.delivery_options,
        payment_types : Drupal.settings.rm_shop.payment_types,
        seller_type : Drupal.settings.rm_shop.seller_type
    }
};

RMS.ajax.Query.prototype = {
    update : function(newVals){
        var _self = this;
        $.extend(true, _self.qvalues, newVals);
        
    },
    
    getValue : function (key) {
        var _self = this;
        return _self.qvalues.key;
    },
    
    getQuery : function() {
        var _self = this;
        return  _self.qvalues;
    }
};

RMS.ajax.sq = new RMS.ajax.Query();
  
 
RMS.ajax.addLoader = function(){
    RMS.$sellerArea.addClass(RMS.ajax.LOADER_CLASSNAME);
}

RMS.ajax.removeLoader = function(){
    RMS.$sellerArea.removeClass(RMS.ajax.LOADER_CLASSNAME);
}
  
RMS.ajax.updateSearchResults = function(trigger){
    var _self = this;
    _self.addLoader();
    var url = window.location.href;
    var prefix;
    var newUrl;
     
    prefix = (url.indexOf(_self.PATH_GET_LOCATIONS) != -1) ? url.substring(0,url.indexOf(_self.PATH_GET_LOCATIONS)) : prefix = url;
    newUrl = prefix + _self.PATH_GET_LOCATIONS + '?' + $.param(_self.sq.getQuery());
    history.pushState({}, '',newUrl);
    
    $.ajax({
        url: _self.PATH_GET_LOCATIONS,
        type: "GET",
        data :  _self.sq.getQuery(),
        dataType : 'json',
  
    }).success(function(data) {
            RMS.$sellerItemsArea.html(data.html);
            RMS.map.updateMarker(data.marker);
            if(trigger === "map") {
                RMS.filter.ta.updateBloodhound('products', data.products);
                RMS.filter.ta.updateBloodhound('seller', data.marker);
            }
            _self.removeLoader();
    });
}

RMS.ajax.toggleFavs = function(path) {
    var _self = this;
     $.ajax({
        url: path,
        type: "POST"
  
    }).success(function() {
            
    });
};


/////////////////////////////////////     
//Favorite-Selection
/////////////////////////////////////


RMS.fav = {};
RMS.fav.$favToggle = RMS.$sellerArea.find('.seller-item .fav-toggle');
RMS.fav.init = function(){
    var _self = this;
    _self.addListeners();
};
RMS.fav.activeText = "Als Favoriten entfernen";
RMS.fav.inactiveText = "Als Favoriten speichern";

RMS.fav.addListeners = function() {
    var _self = this;
    
    RMS.$sellerArea.on(
    {
        "mouseenter.favToggle": _self.toggleHoverIn,

        "mouseleave.favToggle": _self.toggleHoverOut
        
    }, '.seller-item .fav-toggle');
    
    RMS.$sellerArea.on('click.favToggle', '.seller-item .fav-toggle',{obj: _self}, _self.clickToggle);
};

RMS.fav.toggleHoverIn = function() {
    var $el = $(this);
    
    $el.tooltip('show');
};

RMS.fav.toggleHoverOut = function(){
    var $el = $(this);
    $el.tooltip('hide');
};

RMS.fav.clickToggle = function(e) {
    e.preventDefault();
    var _self = e.data.obj;
    var $el = $(this);
    var $parent = $el.parents('.seller-item');
    var path = $el.data('link');
    RMS.ajax.toggleFavs(path);
    $parent.toggleClass('active');
    
    if ($parent.hasClass('active')) {
        
        _self.togglePopUpText($el,true);

    } else {
         
        _self.togglePopUpText($el,false);
    }
}

RMS.fav.togglePopUpText = function($el,active) {
    var _self = this;
    if (active) {
       $el.attr('title',_self.activeText).tooltip('fixTitle').tooltip('show');
    }
    else {
         $el.attr('title',_self.inactiveText).tooltip('fixTitle').tooltip('show');
    }
}

//////////////////////////////////
// RM Map
//////////////////////////////////

RMS.map = {};
RMS.map.mapContainer = "map";
RMS.map.maxZoom = 10;// zoom = 20 rein, zoom = 1 raus
/*RMS.map.popUpOptions = {
    alignBottom : true,
    pixelOffset: new google.maps.Size(-135, -40),
    boxStyle: { 
        width: "270px",
        "z-index" : 30,
	},
    closeBoxURL: "",
    closeBoxMargin : ""
};
RMS.map.popUpWindow = new InfoBox(RMS.map.popUpOptions);*/

RMS.map.latlng = [];
RMS.map.focusedMarkerID;
RMS.map.sellerLocations = {};
RMS.map.firstLoad = true;

RMS.map.getCenter = function(){
    var _self = this;
    var c = Drupal.settings.rm_shop.map_center.split(',');
    var map_center = {
        lat : parseFloat(c[0]),
        lng : parseFloat(c[1])
    };
    return map_center;
};

RMS.map.getBounds = function() {
    var _self = this;
    var newBounds = {
        map_bounds_ne_lat : _self.gm.getBounds().getNorthEast().lat(),
        map_bounds_ne_lng : _self.gm.getBounds().getNorthEast().lng(),
        map_bounds_sw_lat : _self.gm.getBounds().getSouthWest().lat(),
        map_bounds_sw_lng : _self.gm.getBounds().getSouthWest().lng()
    };
    return newBounds;
};

RMS.map.setMapOptions = function(){
    var _self = this;

    _self.mapOptions = {
        center: RMS.map.getCenter(),  
        zoom: 10,
        mapTypeId: 'roadmap',
        mapTypeControl : false,
        panControl : false,
        streetViewControl : false,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position : google.maps.ControlPosition.LEFT_CENTER 
        }
    };

    _self.popUpWindow = new google.maps.InfoWindow();
    _self.customIcons = {
        user_home: {
            icon : new google.maps.MarkerImage(RMS.PATH_TO_THEME+ '/images/markers/marker-sprite.png', new google.maps.Size(27, 36), new google.maps.Point(64, 0)),
            zindex: 2
        },
        
        seller_profile: {
            icon: new google.maps.MarkerImage(RMS.PATH_TO_THEME+ '/images/markers/marker-sprite.png', new google.maps.Size(27, 36), new google.maps.Point(0, 0)),
            zindex: 1
        },
        
        seller_profile_hover: {
            icon: new google.maps.MarkerImage(RMS.PATH_TO_THEME+ '/images/markers/marker-sprite.png', new google.maps.Size(27, 36), new google.maps.Point(32, 0)),
            zindex: 3
        },
    };

};

RMS.map.init = function(){
    var _self = this;
    var marker = Drupal.settings.rm_shop.map_marker;
    _self.setMapOptions();
    _self.gm = new google.maps.Map(document.getElementById(_self.mapContainer),_self.mapOptions);
    _self.centerMarker = new google.maps.Marker({
        map:  _self.gm,
        position: _self.mapOptions.center,
        icon : _self.customIcons.user_home.icon,
        zIndex: _self.customIcons.user_home.zindex
    });
    _self.trackMarker(_self.mapOptions.center.lat, _self.mapOptions.center.lng);
    
    if (marker != undefined) {
        _self.updateMarker(marker,true);
    }
    _self.addListener();
};

RMS.map.addListener = function(){
    var _self = this;
    google.maps.event.addListener(_self.gm, 'idle', $.proxy(_self.centerChange,_self));
    google.maps.event.addListener(_self.gm,'click', $.proxy(_self.mapClick,_self));
};

RMS.map.popUpContentChange = function(){
    var _self = this;
    _self.resetIcon(_self.focusedMarkerId);
}

RMS.map.mapClick = function(){
    var _self = this;
    _self.popUpWindow.close();
  //  _self.resetIcon(_self.focusedMarkerId);
};
 
RMS.map.trackMarker = function(lat,lng) {
    var _self = this;
    var point = new google.maps.LatLng(lat,lng);
    _self.latlng.push(point);
}

RMS.map.centerChange = function(){
    var _self = this;
   
   if (_self.firstLoad) {
        if (_self.gm.getZoom() > 10) {
           _self.gm.setZoom(10);
        }  
   }
   else {
        RMS.ajax.sq.update(_self.getBounds()); 
        RMS.ajax.updateSearchResults("map");
    }
    _self.firstLoad = false;
};

RMS.map.openPopUp = function(seller_id) {
    var _self = this;
   // _self.focusedMarkerId = seller_id;
   // console.info(_self.focusedMarkerId);
    _self.popUpWindow.setContent(
        '<a class="marker-content" href="'+ _self.sellerLocations[seller_id].url +'">'+ _self.getPopUpMarkup(_self.sellerLocations[seller_id]) +' </a>'
    ); 
    _self.popUpWindow.open(_self.gm, _self.sellerLocations[seller_id].gmMarker);
    _self.sellerLocations[seller_id].gmMarker.setZIndex(4);
  //  _self.setIcon(_self.sellerLocations[seller_id].gmMarker,_self.customIcons.seller_profile_hover.icon);
};

RMS.map.setIcon = function(marker,icon){
    var _self = this;
    marker.setIcon(icon);
    marker.setZIndex(icon.zindex);
};

RMS.map.resetIcon = function(seller_id) {
    var _self = this;
    _self.setIcon(_self.sellerLocations[seller_id].gmMarker,_self.customIcons.seller_profile.icon);
};

RMS.map.getPopUpMarkup = function(id){
    var c = '';
   // c += '<img src="'+id.image_path +'"</img>';
    c += '<h4><strong>'+id.title+'</strong></h4>';
    c += '<ul class="list-unstyled">';
    c += '<li><span class="fa fa-map-marker"></span> ' + id.address + '</li>';
    c += '</ul>';

	return c;
};

RMS.map.fitMarker = function(){
    var _self = this;
    var latlngbounds = new google.maps.LatLngBounds();
    for (var k = 0; k < _self.latlng.length; k++) {
        latlngbounds.extend(_self.latlng[k]);
    }
    _self.gm.fitBounds(latlngbounds);
};

RMS.map.updateMarker = function(marker,collectBounds) {
    var _self = this,
        visibleIds = [];
    
    if (marker.length == 0) {
        for (c in _self.sellerLocations) {
             _self.sellerLocations[c].gmMarker.setMap(null);
        }
    }
    $.each(marker,function(i,item) {
     
        if(_self.sellerLocations['sellerLocation_'+item.marker_id]) {
            // schon vorhanden
            // wenn noch nicht visible -> visible schalten
            if (_self.sellerLocations['sellerLocation_'+item.marker_id].gmMarker.getMap() != _self.gm ) {
               _self.sellerLocations['sellerLocation_'+item.marker_id].gmMarker.setMap(_self.gm);
            }
            visibleIds.push(item.marker_id);
            return;
        }  
        // noch nicht vorhanden
       
        _self.sellerLocations['sellerLocation_'+item.marker_id] = {
                
            gmMarker : new google.maps.Marker({
                position : new google.maps.LatLng(
                    parseFloat(item.lat),
                    parseFloat(item.lon)
                ),
                map : _self.gm,
                title : item.name,
                icon : _self.customIcons[item.type].icon,
                zIndex: _self.customIcons[item.type].zindex,
                id : item.marker_id
            }),
            title :  item.name,
            address : item.address,
            url : item.url,
            image_path : item.image_path
        }
            
        google.maps.event.addListener(_self.sellerLocations['sellerLocation_'+item.marker_id].gmMarker, 'click', function(e) {
            _self.openPopUp('sellerLocation_'+ this.id);
        });
        
        if (collectBounds) {
            _self.trackMarker(item.lat, item.lon);
            _self.fitMarker();
        }
        
       visibleIds.push(item.marker_id);
       
    });
     
    for (y in _self.sellerLocations) {
      
        if ($.inArray(_self.sellerLocations[y].gmMarker.id, visibleIds) == -1) {
           _self.sellerLocations[y].gmMarker.setMap(null);
        }
    }
};

 
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// RM Filter
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

RMS.filter = {};
RMS.filter.filterAreaID = '#filter';
RMS.filter.filterArea = $(RMS.filter.filterAreaID);


RMS.filter.init = function() {
    var _self = this;
    
   // _self.search.init();
    _self.ta.init();
    _self.category.init();
   // _self.distance.init();
    _self.addListeners();
};

RMS.filter.addListeners = function (){
    var _self = this;
    _self.filterArea.on('filterchange', $.proxy(_self.handleFilterChange,this));
     RMS.$sellerArea.on(
    {
    "mouseenter.sellerItem": _self.itemHoverIn,

    "mouseleave.sellerItem": _self.itemHoverOut
    },
    '.seller-item',{obj: _self});
    
   // RMS.$sellerArea.on('mouseenter.sellerItem','.seller-item',{obj: _self}, _self.hoverItem);
};

RMS.filter.itemHoverIn = function(e){
    var _self = e.data.obj;
    var itemId = $(this).data('id');
    var marker = RMS.map.sellerLocations['sellerLocation_'+itemId].gmMarker;
    marker.setIcon(RMS.map.customIcons.seller_profile_hover.icon);
    marker.setZIndex(RMS.map.customIcons.seller_profile_hover.zindex);
};

RMS.filter.itemHoverOut = function(e){
    var _self = e.data.obj;
    var itemId = $(this).data('id');
    var marker = RMS.map.sellerLocations['sellerLocation_'+itemId].gmMarker;
    marker.setIcon(RMS.map.customIcons.seller_profile.icon);
    marker.setZIndex(RMS.map.customIcons.seller_profile.zindex);
};

RMS.filter.handleFilterChange = function(e,key,value) {
    var_self = this;
    e.stopPropagation();
    var updateVals = {};
    if (value.length > 0) {
        if ($.isArray(value)) {
            value = value.join(',');
        }
        updateVals[key]= value;
        
    } else {
        updateVals[key]='';
    }
    
   // RMS.map.popUpWindow.close();
    RMS.ajax.sq.update(updateVals);
    RMS.ajax.sq.update(RMS.map.getBounds());
    RMS.ajax.updateSearchResults("filter");
  
   /* RMS.ajax.addLoader();
         setTimeout(RMS.ajax.removeLoader ,1000); 
    if (value === -1) {
        //delete Key
      /*  if ( RMS.ajax.selectedFilter.hasOwnProperty(key)) {
            delete RMS.ajax.selectedFilter[key];
        }
    } else {
        RMS.ajax.selectedFilter[key] = value;
    }*/
   
};
/////////////////////////////////////
//Distance / No UI Slider + Pips Addon
/////////////////////////////////////
/*
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
    //oh
    snap: true
}

RMS.filter.distance.pipsFormat = {
    postfix : ' km'
};

RMS.filter.distance.pipsOptions = {
    mode: 'values',
	values: [25, 50, 75, 100, 150],
	density: 4,
	stepped: true//,
    //format: wNumb(RMS.filter.distance.pipsFormat)
}

RMS.filter.distance.init = function() {
    RMS.filter.distance.$elem.noUiSlider(RMS.filter.distance.sliderOptions);
    RMS.filter.distance.$elem.noUiSlider_pips(RMS.filter.distance.pipsOptions );
    RMS.filter.distance.setCacheVal(RMS.filter.distance.getValue());
    RMS.filter.distance.addListeners();
    RMS.filter.distance.addSuffix();
    
}
RMS.filter.distance.addListeners = function(){
    RMS.filter.distance.$elem.on('change', function(){
        var sliderVal = RMS.filter.distance.getValue();
        if (sliderVal !==  RMS.filter.distance.getCacheVal()  ) {
            RMS.filter.distance.setCacheVal(sliderVal);
            RMS.filter.filterArea.trigger('filterchange',['distance',sliderVal]);                          
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

*/
/////////////////////////////////////     
//Search Filter
/////////////////////////////////////
/*
RMS.filter.search = {};
RMS.filter.search.$input = $('#filterShops');
RMS.filter.search.$clear = $('#clearQuery');
RMS.filter.search.init = function(){
    var _self = this;
    _self.addListeners();
};
RMS.filter.search.timeout;

RMS.filter.search.addListeners = function() {
    var _self = this;
    _self.$input.on('keyup',{obj: _self},_self.keyUp);
    _self.$clear.on('click',$.proxy(_self.clearInput,_self));
}

RMS.filter.search.keyUp = function(e){
    var _self = e.data.obj;
    
    var $el = $(this);
    clearTimeout(_self.timeout);
    var string = $el.val().trim();
    if (string.length > 0) {
        _self.$clear.show();
    } else {_self.$clear.hide();}
    _self.timeout = setTimeout(function(){
         
        RMS.filter.filterArea.trigger('filterchange',['seller_name',string]); 
        
    },400);
}

RMS.filter.search.clearInput = function(){
    var _self = this;
    _self.$input.val('');
    _self.$input.trigger('keyup');
}
*/

/////////////////////////////////////     
//Typeahead Filter
/////////////////////////////////////

RMS.filter.ta = {};
RMS.filter.ta.bloodhounds = {};
RMS.filter.ta.$clear = $('#clearQuery');
RMS.filter.ta.$searchSubmit = $('#searchSubmit');
RMS.filter.ta.$ta_input;
RMS.filter.ta.timeout;

RMS.filter.ta.init = function(){
    var _self = this;
    _self.initBloodhounds();
    _self.initTypeahead();
    _self.prefillInput();
    _self.addListeners();
};

RMS.filter.ta.prefillInput = function(){
    var _self = this;
    if (Drupal.settings.rm_shop.seller_name !== "") {
       _self.$ta_input.val(Drupal.settings.rm_shop.seller_name);
       _self.$clear.show();
    }
};

RMS.filter.ta.addListeners = function(){
    var _self = this;
    
    // click on suggestion triggers ajax-update of results
    _self.$ta_input.on('typeahead:selected',function(evt,data){
         RMS.filter.filterArea.trigger('filterchange',['seller_name',data.value]); 
    });
    // check if supplied string is empty, show clearicon, trigger ajax
    _self.$ta_input.on('keyup.typeah',{obj: _self},_self.keyUp);
    _self.$clear.on('click.clear',$.proxy(_self.clearInput,_self));
    _self.$searchSubmit.on('click.submit',$.proxy(_self.submit,_self));
    
};
RMS.filter.ta.submit = function(){
    var _self = this;
    var string = _self.$ta_input.val().trim();
    
    if (string.length > 0) {
        RMS.filter.filterArea.trigger('filterchange',['seller_name',string]); 
    }
    else {return;}
};

RMS.filter.ta.keyUp = function(e){
    var _self = e.data.obj;
    var $el = $(this);
    clearTimeout(_self.timeout);
    var string = $el.val().trim();
    
    if (string.length > 0) {
        _self.$clear.show();
            if(e.which == 13) {
               RMS.filter.filterArea.trigger('filterchange',['seller_name',string]); 
            }
    } else {
        _self.$clear.hide();
        _self.timeout = setTimeout(function(){
         
            RMS.filter.filterArea.trigger('filterchange',['seller_name','']); 
        
        },500);
    }
};

RMS.filter.ta.clearInput = function(){
    var _self = this;
    _self.$ta_input.val('');
    RMS.filter.filterArea.trigger('filterchange',['seller_name','']);
    _self.$clear.hide();
};

RMS.filter.ta.initBloodhounds = function(){
    var _self = this;
    
    _self.bloodhounds.products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: $.map(Drupal.settings.rm_shop.products, function(v) { return { value: v }; }),
        limit  : 7
    });
    
    _self.bloodhounds.seller = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: $.map(Drupal.settings.rm_shop.map_marker, function(v) { return { value: v.name }; }),
        limit  : 10
    });
 
    _self.bloodhounds.products.initialize();
    _self.bloodhounds.seller.initialize();
};

RMS.filter.ta.updateBloodhound = function(bh_name, newData) {
     var _self = this;
     var bh = _self.bloodhounds[''+bh_name+''];
     bh.clear();
     
    switch (bh_name) {
        case "products" :
            bh.add($.map(newData, function(v) { return { value: v }; }));
            break;
        
        case "seller" :
            bh.add($.map(newData, function(v) { return { value: v.name }; }));
            break;
        
        default: throw new Error('wrong bloodhound index?');
    }
};

RMS.filter.ta.initTypeahead = function(){
    var _self = this;
    
    _self.$ta_input = $('#filterShops').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'products',
            displayKey: 'value',
            source: _self.bloodhounds.products.ttAdapter(),
            templates: {
                header: '<h5 class="products text-muted"><strong>Produkte</strong></h5>',
            }
        },
        
         {
            name: 'seller',
            displayKey: 'value',
            source: _self.bloodhounds.seller.ttAdapter(),
            templates: {
                header: '<h5 class="seller text-muted"><strong>Produzenten</strong></h5>'
            }
        }
    );
};



/////////////////////////////////////     
//Kategorien Filter
/////////////////////////////////////
//@TODO: Backdrop f Touch 

RMS.filter.category = {};
RMS.filter.category.$items = $('.category-filter').find('.filter');
RMS.filter.category.SELECTED_CLASSNAME = 'selected-category';
RMS.filter.category.SELECTED_CLASS = '.selected-category';

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
    this.$filterHeadText = $('.filter-name-text',this.$filterHead);
    this.filterDefaultText = this.$filterHeadText.data('defaulttext');
    this.$reset = $('.reset', this.$filterHead);
    this.$filterContent = $('.filter-content',this.$el);
    this.$termListItems = $('li',this.$filterContent);
    this.selectedCats = [];
    this.selectedCatNames = [];
    this.filterKey = this.$el.data('filtertype');
};

RMS.filter.category.CatFilter.prototype = {
    
    init : function () {
        var _self = this;
        _self.setStartValues();
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
    
    setStartValues : function(){
        var _self = this;
        var values = RMS.ajax.sq.qvalues[_self.filterKey];
        var textVals = [];
        if(values != '') {
            _self.highlightFilterName();
            var arr = values.split(',');
            for (var i = 0, length = arr.length; i< length; i++) {
               
              var text =  $('li[data-term="' + arr[i] + '"]', _self.$filterContent).addClass('active').data('text');
               _self.toggleHeadText(text);
            }
        }
    },
    
    addListeners : function(){
        var _self = this;
        _self.$filterHead.on('click.filterHead',$.proxy(_self.toggle, _self));
        _self.$termListItems.on('click.term', {obj: _self}, _self.termClick);
        _self.$el.on('changedSelection',$.proxy(_self.handleSelectionChange,_self));
        _self.$reset.on('click.reset',$.proxy(_self.resetItems,_self));
    },
    
    termClick : function(e) {
        var $el = $(this);//li
        var _self = e.data.obj;
        $el.toggleClass('active');
        var labelText= $el.find('.checkbox-label').text();
        $el.parents('.filter').trigger('changedSelection',[labelText]);
    },
    
    countActive : function (){
        var _self = this;
        return _self.$filterContent.find('li.active').length;
    },
    
    handleSelectionChange : function(e,labeltext){
       var _self = this;
        
       var activeItems = _self.countActive();
       
       if (activeItems >= 1) {
            if (!_self.$el.hasClass(RMS.filter.category.SELECTED_CLASS)) {
                _self.highlightFilterName();
            }
        _self.toggleHeadText(labeltext);
        
         RMS.filter.filterArea.trigger('filterchange',[_self.filterKey,_self.getActiveNames()]);
        
       } else {
            _self.resetFilterName();
            _self.selectedCats.length = 0;
            RMS.filter.filterArea.trigger('filterchange',[_self.filterKey,""]);
       }
    },
    
    getActiveNames: function(){
        var _self = this;
        var $active = _self.$filterContent.find('li.active');
        _self.selectedCatNames.length = 0;
        $active.each(function(){
            var name = $(this).data('term');
           _self.selectedCatNames.push(name);
        });
        
        return _self.selectedCatNames;
    },
    
    toggleHeadText : function(string){
        var _self = this;
        var inIt = $.inArray(string, _self.selectedCats);
        var headText;
        if (inIt > -1) {
             _self.selectedCats.splice(inIt,1);
            
        } else {
            _self.selectedCats.push(string);
        }
        headText = _self.selectedCats.join(', ');
        _self.$filterHeadText.text(headText);
    },
    
    highlightFilterName : function(){
       var _self = this;
       _self.$el.addClass(RMS.filter.category.SELECTED_CLASSNAME);
    },
    
    resetFilterName: function(){
        var _self = this;
       _self.$el.removeClass(RMS.filter.category.SELECTED_CLASSNAME);
       _self.$filterHeadText.text(_self.filterDefaultText);
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


function injectGMaps(){
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +'callback=RMS.init';
    document.body.appendChild(script);
};
 
window.onload = injectGMaps;  
 
});

