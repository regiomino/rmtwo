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
        case 'rm_sales_profilequeue_form':
        case 'rm_sales_profileset_form':
        case 'rm_sales_profilecare_form':
            $form['#prefix'] = '<div class="col-sm-12 col-md-12 main">';
            $form['#suffix'] = '</div>';
            $form['suggestions']['#attributes']['class'][] = 'table';
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
    if(($variables['page']['#type'] == 'page' && (arg(0) == 'lieferanten')) || (array_key_exists('node', $variables) && $variables['node']->type == 'seller_profile') || arg(0) == 'admin') {
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

function rmtwo_menu_local_tasks(&$variables) {
    $output = '';

    if (!empty($variables['primary'])) {
        $variables['primary']['#prefix'] = '<ul class="nav nav-tabs" role="tablist">';
        $variables['primary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['primary']);
    }
    if (!empty($variables['secondary'])) {
        $variables['secondary']['#prefix'] = '<ul class="nav nav-tabs" role="tablist">';
        $variables['secondary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['secondary']);
    }

    return $output;
}

function rmtwo_pager($variables) {
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];
    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // current is the page we are currently paged to
    $pager_current = $pager_page_array[$element] + 1;
    // first is the first page listed by this pager piece (re quantity)
    $pager_first = $pager_current - $pager_middle + 1;
    // last is the last page listed by this pager piece (re quantity)
    $pager_last = $pager_current + $quantity - $pager_middle;
    // max is the maximum page number
    $pager_max = $pager_total[$element];
    // End of marker calculations.

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
        // Adjust "center" if at end of query.
        $i = $i + ($pager_max - $pager_last);
        $pager_last = $pager_max;
    }
    if ($i <= 0) {
        // Adjust "center" if at start of query.
        $pager_last = $pager_last + (1 - $i);
        $i = 1;
    }
    // End of generation loop preparation.

    $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
    $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

    if ($pager_total[$element] > 1) {
        if ($li_first) {
            $items[] = array(
                'class' => array('pager-first'),
                'data' => $li_first,
            );
        }
        if ($li_previous) {
            $items[] = array(
                'class' => array('pager-previous'),
                'data' => $li_previous,
            );
        }

        // When there is more than one page, create the pager list.
        if ($i != $pager_max) {
            if ($i > 1) {
                $items[] = array(
                    'class' => array('pager-ellipsis'),
                    'data' => '…',
                );
            }
            // Now generate the actual pager piece.
            for (; $i <= $pager_last && $i <= $pager_max; $i++) {
                if ($i < $pager_current) {
                    $items[] = array(
                        'class' => array('pager-item'),
                        'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
                    );
                }
                if ($i == $pager_current) {
                    $items[] = array(
                        'class' => array('pager-current', 'disabled'),
                        'data' => theme('pager_link', array('text' => $i, 'page_new' => $i, 'element' => $element, 'parameters' => $parameters)),
                    );
                }
                if ($i > $pager_current) {
                    $items[] = array(
                        'class' => array('pager-item'),
                        'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
                    );
                }
            }
            if ($i < $pager_max) {
                $items[] = array(
                    'class' => array('pager-ellipsis'),
                    'data' => '…',
                );
            }
        }
        // End generation.
        if ($li_next) {
            $items[] = array(
                'class' => array('pager-next'),
                'data' => $li_next,
            );
        }
        if ($li_last) {
            $items[] = array(
                'class' => array('pager-last'),
                'data' => $li_last,
            );
        }
        return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
            'items' => $items,
            'attributes' => array('class' => array('pagination')),
        ));
    }
}