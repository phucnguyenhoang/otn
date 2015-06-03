<?php
$regions['container'] = array(
    'id' => 'pan_container',
    'class' => 'pan-container container'
);
$regions['header'] = array(
    'id' => 'pan_header',
    'class' => 'pan-header row',
    'regions' => array(
        'menu' => array(
            'id' => 'pan_menu',
            'class' => 'pan-menu col-md-9'
        ),
        'search' => array(
            'id' => 'pan-search',
            'class' => 'pan-search col-md-3'
        )
    )
);
$regions['content'] = array(
    'id' => 'pan_content',
    'class' => 'pan-content row'
);
$regions['footer'] = array(
    'id' => 'pan_footer',
    'class' => 'pan-footer row'
);