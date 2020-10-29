<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        // Setting
        [
            'section' => 'Settings'
        ],
        [
            'title' => 'Settings',
            'root' => true,
            'icon' => 'assets/media/svg/icons/Shopping/Settings.svg',
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'Master Data',
                    'bullet' => 'line',
                    'submenu' => [
                        [
                            'title' => 'Bandwidth Package',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Base Transmission Station',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Branch',
                            'page' => '#'
                        ],
                        [
                            'title' => 'City',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Client Type',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Country',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Currency',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Customer',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Department',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Division',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Island',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Item',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Item Brand',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Item Category',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Job Position',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Product',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Province',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Serial No Detail',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Team',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Team Personal',
                            'page' => '#'
                        ],
                        [
                            'title' => 'Unit Of Measure',
                            'page' => '#'
                        ]
                    ]
                ]
            ]
        ],
        [
            'title' => 'User Management',
            'root' => true,
            'icon' => 'assets/media/svg/icons/General/User.svg',
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'User',
                    'page' =>  'management/user'
                ],
                [
                    'title' => 'User Login History',
                    'page' => '#'
                ],
                [
                    'title' => 'Role & Permission',
                    'page' => '#'
                ]
            ]
        ]
    ]

];
