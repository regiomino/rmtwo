jQuery(document).ready(function ($) {

    /*
     *
     * GLOBAL - alles notwendig für die Adresseingabe im Header
     *
     */

    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.
    
    if($('#edit-address').length) {
        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            postal_code: 'short_name'
        };

        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('edit-address')),
            { types: ['address'] });
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });
    }
    
    $('#edit-address').on('input', function() {
        clearAddress();
    });
    
    function clearAddress() {
        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
    }
    
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        clearAddress();

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
        
        //merge route and street_number to thoroughfare
        var streetNumber = document.getElementById('street_number').value;
        if(streetNumber.length) {
            document.getElementById('thoroughfare').value = document.getElementById('route').value + ' ' + streetNumber;
        }
        else {
            document.getElementById('thoroughfare').value = document.getElementById('route').value + ' 1';
        }
    }

});