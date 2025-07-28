<?php

if (!function_exists('sidebar_active')) {
    /**
     * Kiểm tra xem URI segment có khớp với key không
     * Dùng để xác định menu con nào đang được active
     */
    function sidebar_active(int $segment, string $value): bool
    {
        $uri = service('uri');
        return $uri->getTotalSegments() >= $segment && $uri->getSegment($segment) === $value;
    }
}

if (!function_exists('sidebar_parent_open')) {
    /**
     * Kiểm tra xem bất kỳ menu con nào trong nhóm có đang active không
     * Dùng khi cần gán thuộc tính `open` cho <details> trong PHP (nếu không dùng JS)
     */
    function sidebar_parent_open(array $keys, int $segment = 2): bool
    {
        $uri = service('uri');
        $current = $uri->getSegment($segment);
        return in_array($current, $keys);
    }
}

if (!function_exists('render_sidebar_link')) {
    /**
     * Tự động render link sidebar, highlight nếu bất kỳ segment nào trùng key
     * @param array|int $segments – số thứ tự segment hoặc mảng segment để kiểm tra (mặc định: [2,3])
     */
    function render_sidebar_link(string $url, string $label, string $icon, string $key, $segments = [2, 3]): string
    {
        $uri = service('uri');
        $segments = (array) $segments;

        $active = false;
        foreach ($segments as $seg) {
            if ($uri->getTotalSegments() >= $seg && $uri->getSegment($seg) === $key) {
                $active = true;
                break;
            }
        }

        $classes = $active ? 'text-white bg-blue-600' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900';
        $iconColor = $active ? 'text-white' : 'text-gray-500 group-hover:text-gray-600';

        return <<<HTML
<a href="$url" class="flex items-center px-3 py-2 text-sm font-medium rounded-md $classes group">
    <i class="$icon mr-3 w-5 text-center $iconColor"></i>
    $label
</a>
HTML;
    }
}


