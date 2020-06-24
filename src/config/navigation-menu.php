<?php

/*

Contains the settings for adding the modules options to the hubs navigation menu

icon - specify a fe icon
dashboard - 'all', 'business', 'professional' or 'desk'
title - specify the visible title
route - specify laravel route name
clickable - boolen if it should be clickable or only its choldren should be


*/
return [
    'modules-sample' => [
        'title' => 'Sample',
        'route' => 'sample-main',
        'icon' => 'fe fe-settings',
        'clickable' => true,
        'navbar' => true,
        'sub-menu' => []
    ]
];