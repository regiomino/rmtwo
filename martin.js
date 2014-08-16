/**
 * Created by Martin on 04.08.14.
 */
jQuery(document).ready(function ($) {

    /**
     * In Bootstrap können Select Boxen nicht an Input Boxen attached werden
     * Deshalb attache ich im Angebotsformular statt einer Select Box ein
     * Dropdown Menu. Die Auswahl des Dropdowns wird dann sowohl als Default-
     * Title des Dropdowns gesetzt, als auch in ein verstecktes Input Feld geschrieben
     * um beim Form-Submit übergeben zu werden.
     * Siehe auch hier: http://stackoverflow.com/questions/19905166/bootstrap-3-select-input-form-inline
     */
     
    $('.dropdown_unit_unit li').click(function(e) {
        e.preventDefault();
        var selected = $(this).text();
        $(this).parent().parent().find('.hidden_unit_unit').val(selected);
        $(this).parent().parent().find('.dropdown-toggle').html(selected + ' <span class="caret"></span>');
    });
    
    
    $('.priorities select').change(function() {
        var nidstring = $(this).attr('id');
        var res = nidstring.split("_");
        alert("test");
        data = new Object;
        data['nid'] = res[1];
        data['prio'] = $(this).val();

        callback_url = Drupal.settings.basePath + 'manage/sales/changepriority/' + data['nid'] + '/' + data['prio'];
            
        $.ajax({
            url: callback_url,
            type: 'POST',
            data: data
        });
    });
});