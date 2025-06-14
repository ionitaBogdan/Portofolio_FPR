<?php

if (!function_exists('getLocationColor')) {
    function getLocationColor($location) {
        $locationColors = [
            'Office Building A' => '#f78ef0',
            'Factory Floor B' => '#937df8',
            'Warehouse C' => '#6d9efc',
            'Retail Store D' => '#69ebfc',
            'Distribution Center E' => '#98f786',
            'Workshop F' => '#f3f87f',
        ];

        return $locationColors[$location] ?? '#ededed';
    }
}
