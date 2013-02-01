<?php

return array(
    'frontend'        => 'Core',
    'backend'         => 'File',
    'frontendOptions' => array(
       'lifetime'                => 60 * 10,
       'automatic_serialization' => false
    ),

    'backendOptions' => array(
        'cache_dir' => ROOTDIR . '/cache/'
    )
);