<?php
/**
 * Admin Panel menus
 */
/*$admin_menus =  [
                    ["name" => "Dashboard",     "url" => '',                'icon' => 'pe-7s-graph'],
                    ["name" => "Users",         "url" => 'users',            'icon' => 'pe-7s-user'],
                    ["name" => "Table",         "url" => 'table',           'icon' => 'pe-7s-note2'],
                    ["name" => "typography",    "url" => 'typography',      'icon' => 'pe-7s-news-paper'],
                    ["name" => "icons",         "url" => 'icons',           'icon' => 'pe-7s-science'],
                    ["name" => "maps",          "url" => 'maps',            'icon' => 'pe-7s-map-marker'],
                    ["name" => "notifications", "url" => 'notifications',   'icon' => 'pe-7s-bell'],
                ];
  */



$admin_menus =  [
                    "Dashboard" => [
                                    'icon'              => 'pe-7s-graph',
                                    'controller'        => '\Micro\Controller\AdminController',
                                    'url'               => '',
                                    "actions"           => [
                                                                // All users index page "www.example.com/admin/users"
                                                                ['action' => 'index', "route" => '/?',        'method' => METHOD_GET ],
                                                            ],
                                    ],
                    "Users" =>  [
                                    'icon'              => 'pe-7s-user',
                                    'controller'        => '\Micro\Controller\AdminUserController',
                                    'url'               => 'users',
                                    'sub_menu'          => [
                                                                'All Users' => ['url' => 'users'],
                                                                'Add New User' => ['url' => 'user']
                                                            ],
                                    "actions"           => [
                                                                // All users index page "www.example.com/admin/users"
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/users',
                                                                    'action' => 'index'
                                                                ],

                                                                // New user Show/Save "www.example.com/admin/user"
                                                                [   'method' => [ METHOD_POST, METHOD_GET ],
                                                                    "route" => '/user',
                                                                    'action' => 'create'
                                                                ],

                                                                // Edit user "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/user/[i:id]',
                                                                    'action' => 'edit'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_PUT,
                                                                    "route" => '/user/[i:id]',
                                                                    'action' => 'update'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_DELETE,
                                                                    "route" => '/users/[i:id]',
                                                                    'action' => 'ajaxDelete'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/user/block/[i:id]/[i:mode]',
                                                                    'action' => 'block'
                                                                ],

                                                                // Validate username "www.example.com/admin/user/validateusername"
                                                                [   'method' => [ METHOD_POST ],
                                                                    "route" => '/user/validateusercreate',
                                                                    'action' => 'ajaxValidateusercreate'
                                                                ],

                                                            ],
                                ],
                    "Posts" =>  [
                                    'icon'              => 'pe-7s-news-paper',
                                    'controller'        => '\Micro\Controller\AdminPostController',
                                    'url'               => 'posts',
                                    'sub_menu'          => [
                                                                'All Posts' => ['url' => 'posts'],
                                                                'Add New Post' => ['url' => 'post']
                                                            ],
                                    "actions"           => [
                                                                // All users index page "www.example.com/admin/users"
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/posts',
                                                                    'action' => 'index'
                                                                ],

                                                                // New user Show/Save "www.example.com/admin/user"
                                                                [   'method' => [ METHOD_POST, METHOD_GET ],
                                                                    "route" => '/post',
                                                                    'action' => 'create'
                                                                ],

                                                                // Edit user "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/post/[i:id]',
                                                                    'action' => 'edit'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_PUT,
                                                                    "route" => '/post/[i:id]',
                                                                    'action' => 'update'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_DELETE,
                                                                    "route" => '/post/[i:id]',
                                                                    'action' => 'ajaxDelete'
                                                                ],

                                                                // Save Edited user data "www.example.com/admin/user/[id]" (user id)
                                                                [   'method' => METHOD_GET,
                                                                    "route" => '/post/block/[i:id]/[i:mode]',
                                                                    'action' => 'block'
                                                                ],

                                                                // Validate username "www.example.com/admin/user/validateusername"
                                                                [   'method' => [ METHOD_POST ],
                                                                    "route" => '/post/validateusercreate',
                                                                    'action' => 'ajaxValidateusercreate'
                                                                ],

                                                            ],
                                ],
];


define('ADMIN_MENUS', serialize($admin_menus));
