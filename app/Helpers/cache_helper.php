<?php

/**
 * Cache Helper - Quản lý cache hiệu quả cho ứng dụng
 */

if (!function_exists('cache_get')) {
    /**
     * Lấy dữ liệu từ cache với fallback
     */
    function cache_get($key, $callback = null, $ttl = 3600)
    {
        $cache = \Config\Services::cache();
        
        // Thử lấy từ cache trước
        $data = $cache->get($key);
        
        if ($data !== null) {
            return $data;
        }
        
        // Nếu không có trong cache và có callback, thực hiện callback
        if ($callback && is_callable($callback)) {
            $data = $callback();
            
            if ($data !== null) {
                $cache->save($key, $data, $ttl);
            }
            
            return $data;
        }
        
        return null;
    }
}

if (!function_exists('cache_set')) {
    /**
     * Lưu dữ liệu vào cache
     */
    function cache_set($key, $data, $ttl = 3600)
    {
        $cache = \Config\Services::cache();
        return $cache->save($key, $data, $ttl);
    }
}

if (!function_exists('cache_delete')) {
    /**
     * Xóa dữ liệu khỏi cache
     */
    function cache_delete($key)
    {
        $cache = \Config\Services::cache();
        return $cache->delete($key);
    }
}

if (!function_exists('cache_clear')) {
    /**
     * Xóa toàn bộ cache
     */
    function cache_clear()
    {
        $cache = \Config\Services::cache();
        return $cache->clean();
    }
}

if (!function_exists('cache_invalidate_pattern')) {
    /**
     * Xóa cache theo pattern
     */
    function cache_invalidate_pattern($pattern)
    {
        $cache = \Config\Services::cache();
        
        // Nếu sử dụng file cache
        if ($cache instanceof \CodeIgniter\Cache\Handlers\FileHandler) {
            $storePath = $cache->getStorePath();
            $files = glob($storePath . '*' . $pattern . '*');
            
            foreach ($files as $file) {
                unlink($file);
            }
            
            return true;
        }
        
        return false;
    }
}

if (!function_exists('cache_remember')) {
    /**
     * Lưu cache với remember pattern
     */
    function cache_remember($key, $ttl, $callback)
    {
        return cache_get($key, $callback, $ttl);
    }
}

if (!function_exists('cache_tags')) {
    /**
     * Quản lý cache theo tags (simplified)
     */
    function cache_tags($tags)
    {
        return new class($tags) {
            private $tags;
            
            public function __construct($tags)
            {
                $this->tags = is_array($tags) ? $tags : [$tags];
            }
            
            public function remember($key, $ttl, $callback)
            {
                $taggedKey = implode(':', $this->tags) . ':' . $key;
                return cache_remember($taggedKey, $ttl, $callback);
            }
            
            public function flush()
            {
                foreach ($this->tags as $tag) {
                    cache_invalidate_pattern($tag);
                }
            }
        };
    }
}

if (!function_exists('cache_stats')) {
    /**
     * Lấy thống kê cache
     */
    function cache_stats()
    {
        $cache = \Config\Services::cache();
        
        if ($cache instanceof \CodeIgniter\Cache\Handlers\FileHandler) {
            $storePath = $cache->getStorePath();
            $files = glob($storePath . '*');
            $totalSize = 0;
            
            foreach ($files as $file) {
                $totalSize += filesize($file);
            }
            
            return [
                'handler' => 'file',
                'files_count' => count($files),
                'total_size' => $totalSize,
                'total_size_mb' => round($totalSize / 1024 / 1024, 2)
            ];
        }
        
        return [
            'handler' => get_class($cache),
            'status' => 'unknown'
        ];
    }
}

if (!function_exists('cache_optimize')) {
    /**
     * Tối ưu cache
     */
    function cache_optimize()
    {
        $cache = \Config\Services::cache();
        
        if ($cache instanceof \CodeIgniter\Cache\Handlers\FileHandler) {
            $storePath = $cache->getStorePath();
            $files = glob($storePath . '*');
            $deleted = 0;
            
            foreach ($files as $file) {
                // Xóa file cache cũ hơn 24 giờ
                if (filemtime($file) < (time() - 86400)) {
                    unlink($file);
                    $deleted++;
                }
            }
            
            return [
                'deleted_files' => $deleted,
                'remaining_files' => count($files) - $deleted
            ];
        }
        
        return ['status' => 'not_supported'];
    }
} 