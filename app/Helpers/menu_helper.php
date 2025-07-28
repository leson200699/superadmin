<?php

if (!function_exists('buildMenuTree')) {
    function buildMenuTree($menus, $parentId = 0)
    {
        $tree = [];
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $children = buildMenuTree($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $tree[] = $menu;
            }
        }
        return $tree;
    }
}
