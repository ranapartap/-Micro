<?php

$admin_menus =  [
                    ["name" => "Dashboard",     "url" => '',                'icon' => 'pe-7s-graph'],
                    ["name" => "Users",         "url" => 'user',            'icon' => 'pe-7s-user'],
                    ["name" => "Table",         "url" => 'table',           'icon' => 'pe-7s-note2'],
                    ["name" => "typography",    "url" => 'typography',      'icon' => 'pe-7s-news-paper'],
                    ["name" => "icons",         "url" => 'icons',           'icon' => 'pe-7s-science'],
                    ["name" => "maps",          "url" => 'maps',            'icon' => 'pe-7s-map-marker'],
                    ["name" => "notifications", "url" => 'notifications',   'icon' => 'pe-7s-bell'],
                ];

define('ADMIN_MENUS', serialize($admin_menus));
