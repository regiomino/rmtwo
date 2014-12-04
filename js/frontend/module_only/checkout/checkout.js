jQuery(document).ready(function ($) {

var CO = CO || {};
window.CO = CO; 
CO.$cartToggle = $('#cart-toggle');
CO.$cartContainer = $('.cart-container');
CO.$itemDisplay = $('#item-amount');
CO.$sidebar = $('.flexfix-sidebar');

CO.init = function(){
    var _self = this;
    _self.updateItemAmount();
    _self.addListeners();
};

CO.addListeners = function(){
    var _self = this;
    _self.$cartToggle.on('click.cartToggle', function() {
        $(this).toggleClass('active');
        _self.$sidebar.toggleClass('active');
    });
};

CO.updateItemAmount = function(){
    var _self = this;
    var items = _self.$cartContainer.find('.cart-item').length;
    if (items > 0) {
        _self.$itemDisplay.text(items);
    } else {
        _self.$itemDisplay.text('0');
    }
}

CO.init();
 
if($('label[for="edit-delivery-pickup-agreement"]').siblings('input[type="radio"]').is(':checked')) {
   
    $('div.delivery-address').hide();
};

$('label[for="edit-delivery-pickup-agreement"]').click(function(){
    $('div.delivery-address').hide();
});

$('label[for="edit-delivery-shipping-agreement"]').click(function(){
    $('div.delivery-address').show();
});

});