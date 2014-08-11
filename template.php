<?php

function rmtwo_theme() {
    $items = array();
    $items['user_register_form'] = array(
        'render element' => 'form',
        'path' => drupal_get_path('theme', 'rmtwo') . '/templates',
        'template' => 'user-register-form',
    );
    return $items;
}

function rmtwo_form_alter(&$form, &$form_state, $form_id) {
    switch($form_id) {
        case 'user_register_form':
            $form['account']['mail']['#attributes']['placeholder'] = t('Your E-Mail');
            $form['account']['mail']['#attributes']['class'][] = 'form-control';
            $form['account']['mail']['#attributes']['required'] = NULL;
            unset($form['account']['mail']['#description']);
            $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t('First name');
            $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';
            $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['required'] = NULL;
            $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t('Last name');
            $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';
            $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['required'] = NULL;
            $form['field_address'][LANGUAGE_NONE][0]['street_block']['thoroughfare']['#attributes']['class'][] = 'form-control';
            $form['field_address'][LANGUAGE_NONE][0]['street_block']['premise']['#attributes']['class'][] = 'form-control';
            $form['field_address'][LANGUAGE_NONE][0]['locality_block']['postal_code']['#attributes']['class'][] = 'form-control';
            $form['field_address'][LANGUAGE_NONE][0]['locality_block']['locality']['#attributes']['class'][] = 'form-control';
            $form['field_gender'][LANGUAGE_NONE]['#attributes']['class'][] = 'form-control';
            $form['field_gender'][LANGUAGE_NONE]['#title'] = t('Salutation');
            unset($form['account']['pass']['#description']);
            $form['account']['pass']['#process'] = array(
                'form_process_password_confirm',
                'rmtwo_password_confirm_process',
                'user_form_process_password_confirm'
            );
            $form['actions']['submit']['#attributes']['class'][] = 'btn';
            $form['actions']['submit']['#attributes']['class'][] = 'btn-success';
        break;
        case 'user_pass':
            //General declaration
            $form['#attributes']['class'][] = 'form-vertical';
            $form['#attributes']['class'][] = 'col-md-12';
            $form['name']['#attributes']['placeholder'] = t('Your E-Mail');
            $form['name']['#attributes']['class'][] = 'form-control';
            $form['name']['#attributes']['required'] = NULL;
            $form['actions']['submit']['#attributes']['class'][] = 'btn';
            $form['actions']['submit']['#attributes']['class'][] = 'btn-success';
        break;
        case 'user_login_block':
            $form['name']['#attributes']['placeholder'] = t('Your E-Mail');
            $form['name']['#attributes']['class'][] = 'form-control';
            $form['name']['#attributes']['required'] = NULL;
            $form['pass']['#attributes']['class'][] = 'form-control';
            $form['pass']['#attributes']['placeholder'] = t('Your password');
            $form['pass']['#attributes']['required'] = NULL;
            $form['actions']['submit']['#attributes']['class'][] = 'btn';
            $form['actions']['submit']['#attributes']['class'][] = 'btn-success';
            $form['links']['#markup'] = '<div class="item-list"><ul><li class="first"><a href="/user/password" title="' . t('Request new password via e-mail.') . '">' . t('Request new password') . '</a></li></ul></div>';
        break;
        case 'rm_sales_suggest_form':
            //General declaration
            $form['#attributes']['class'][] = 'form-vertical';
            //Type
            $form['suggest']['necessary']['type']['#attributes']['required'] = NULL;
            $form['suggest']['necessary']['type']['#title_display'] = 'none';
            $form['suggest']['necessary']['type']['#field_prefix'] = '<div class="radio-inline">';
            $form['suggest']['necessary']['type']['#field_suffix'] = '</div>';
            //Title
            $form['suggest']['necessary']['title']['#attributes']['placeholder'] = t('Name of the vendor or gastronomy');
            $form['suggest']['necessary']['title']['#attributes']['class'][] = 'form-control';
            $form['suggest']['necessary']['title']['#attributes']['required'] = NULL;
            //Locality
            $form['suggest']['necessary']['locality']['#attributes']['placeholder'] = t('City');
            $form['suggest']['necessary']['locality']['#attributes']['class'][] = 'form-control';
            $form['suggest']['necessary']['locality']['#attributes']['required'] = NULL;
            //Thoroughfare
            $form['suggest']['necessary']['thoroughfare']['#attributes']['placeholder'] = t('Street');
            $form['suggest']['necessary']['thoroughfare']['#attributes']['class'][] = 'form-control';
            $form['suggest']['necessary']['thoroughfare']['#attributes']['required'] = NULL;
            //Postal code
            $form['suggest']['nicetohave']['postal_code']['#attributes']['placeholder'] = t('Postal code');
            $form['suggest']['nicetohave']['postal_code']['#attributes']['class'][] = 'form-control';
            //Phone
            $form['suggest']['nicetohave']['phone']['#attributes']['placeholder'] = t('Phone');
            $form['suggest']['nicetohave']['phone']['#attributes']['class'][] = 'form-control';
            //Suggester
            $form['suggest']['nicetohave']['suggester']['#attributes']['placeholder'] = t('Your E-Mail');
            $form['suggest']['nicetohave']['suggester']['#attributes']['class'][] = 'form-control';
            //Owner
            $form['suggest']['nicetohave']['owner']['#prefix'] = '<div class="checkbox-inline">';
            $form['suggest']['nicetohave']['owner']['#suffix'] = '</div>';
            //Submit
            $form['suggest']['submit']['#attributes']['class'][] = 'btn';
            $form['suggest']['submit']['#attributes']['class'][] = 'btn-success';
        break;
        case 'rm_shop_regionselect':

//            $form['street']['#attributes']['placeholder'] = 'Habichtweg 6';
            $form['street']['#attributes']['required'] = NULL;

//            $form['zipcode']['#attributes']['placeholder'] = '91096';
            $form['zipcode']['#attributes']['required'] = NULL;

//            $form['city']['#attributes']['placeholder'] = 'Möhrendorf';
            $form['city']['#attributes']['required'] = NULL;

            $form['street']['#attributes']['class'][] = 'form-control';
            $form['street']['#prefix'] = '<div class="col-md-12">';
            $form['street']['#suffix'] = '</div>';

            $form['zipcode']['#attributes']['class'][] = 'form-control';
            $form['zipcode']['#prefix'] = '<div class="col-md-4">';
            $form['zipcode']['#suffix'] = '</div>';

            $form['city']['#attributes']['class'][] = 'form-control';
            $form['city']['#prefix'] = '<div class="col-md-8">';
            $form['city']['#suffix'] = '</div>';

            $form['submit']['#attributes']['class'][] = 'btn';
            $form['submit']['#attributes']['class'][] = 'btn-success';
            $form['submit']['#attributes']['class'][] = 'form-control';
            $form['submit']['#prefix'] = '<div class="col-md-12">';
            $form['submit']['#suffix'] = '</div>';

            if(drupal_is_front_page()) {
                //check if user is logged in and has a filled out address field
                //if so automatically fill in address form
                global $user;
                if($user->uid > 0) {
                    $userobject = rm_user_address_complete($user->uid);
                    if($userobject) {
                        $form['street']['#default_value'] = $userobject->field_address[LANGUAGE_NONE][0]['thoroughfare'];
                        $form['zipcode']['#default_value'] = $userobject->field_address[LANGUAGE_NONE][0]['postal_code'];
                        $form['city']['#default_value'] = $userobject->field_address[LANGUAGE_NONE][0]['locality'];
                    }
                }
            }

//            $form['zipcode']['#field_prefix'] = '<div class="input-group input-group-lg">';
//            $form['zipcode']['#field_suffix'] = '<span class="input-group-btn"><button class="btn btn-success" type="submit">' . t('Find vendor') . '</button></span></div>';
        break;
        case 'rm_shop_contact_form':
            $form['#attributes']['class'][] = 'form-vertical';
            $form['email']['#attributes']['required'] = NULL;
            $form['email']['#attributes']['placeholder'] = t('Your E-Mail');
            $form['email']['#attributes']['class'][] = 'form-control';
            $form['name']['#attributes']['required'] = NULL;
            $form['name']['#attributes']['placeholder'] = t('Your name');
            $form['name']['#attributes']['class'][] = 'form-control';
            $form['body']['#attributes']['required'] = NULL;
            $form['body']['#attributes']['placeholder'] = t('Your inquiry');
            $form['body']['#attributes']['class'][] = 'form-control';
            $form['submit']['#attributes']['class'][] = 'btn';
            $form['submit']['#attributes']['class'][] = 'btn-success';
        break;
    }

}

function rmtwo_password_confirm_process($element) {
    $element['pass1']['#attributes']['class'][] = 'form-control';
    $element['pass1']['#attributes']['placeholder'] = t('Your password');
    $element['pass1']['#attributes']['required'] = NULL;
    $element['pass2']['#attributes']['class'][] = 'form-control';
    $element['pass2']['#attributes']['placeholder'] = t('Repeat password');
    $element['pass2']['#attributes']['required'] = NULL;
    return $element;
}

function rmtwo_preprocess_page(&$variables) {
    if(($variables['page']['#type'] == 'page' && (arg(0) == 'lieferanten')) || (array_key_exists('node', $variables) && $variables['node']->type == 'seller_profile')) {
        $variables['theme_hook_suggestions'][] = 'page__lieferanten';
    }
    $variables['page']['content']['regiominouserlogin'] = render(drupal_get_form('user_login_block'));
    $variables['suggestform'] = render(drupal_get_form('rm_sales_suggest_form'));
}

function rmtwo_form_element($variables) {
    $element = &$variables['element'];

    // This function is invoked as theme wrapper, but the rendered form element
    // may not necessarily have been processed by form_builder().
    $element += array(
        '#title_display' => 'before',
    );

    // Add element #id for #type 'item'.
    if (isset($element['#markup']) && !empty($element['#id'])) {
        $attributes['id'] = $element['#id'];
    }
    // Add element's #type and #name as class to aid with JS/CSS selectors.
    $attributes['class'] = array('form-item');
    if (!empty($element['#type'])) {
        $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
    }
    if (!empty($element['#name'])) {
        $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
    }
    // Add a class for disabled elements to facilitate cross-browser styling.
    if (!empty($element['#attributes']['disabled'])) {
        $attributes['class'][] = 'form-disabled';
    }
    $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

    // If #title is not set, we don't display any label or required marker.
    if (!isset($element['#title'])) {
        $element['#title_display'] = 'none';
    }
//    $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
//    $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

    $prefix = isset($element['#field_prefix']) ? $element['#field_prefix'] : '';
    $suffix = isset($element['#field_suffix']) ? $element['#field_suffix'] : '';


        switch ($element['#title_display']) {
            case 'before':
            case 'invisible':
                $output .= ' ' . theme('form_element_label', $variables);
                $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
                break;

            case 'after':
                $output .= ' ' . $prefix . $element['#children'] . $suffix;
                $output .= ' ' . theme('form_element_label', $variables) . "\n";
                break;

            case 'none':
            case 'attribute':
                // Output no label and no required marker, only the children.
                $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
                break;
        }

    if (!empty($element['#description'])) {
        $output .= '<div class="description">' . $element['#description'] . "</div>\n";
    }

    $output .= "</div>\n";

    return $output;
}
