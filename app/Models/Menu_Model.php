<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu_Model extends Model
{
    protected $table         = 'menu';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['author', 'name', 'name_en', 'url', 'parent_id', 'position', 'display_location'];

    // Lấy tất cả menu, sắp xếp theo cha và vị trí
    public function getAllMenus($userId)
    {
        return $this->where('author', $userId)
                    ->orderBy('parent_id', 'ASC')
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }

    public function getSubMenus($parent_id)
    {
        return $this->where('parent_id', $parent_id)
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }

    public function getMaxPosition($parentId)
    {
        $this->where('parent_id', $parentId);
        $this->selectMax('position');
        $result = $this->get()->getRowArray();
        return $result['position'] ?? 0;
    }
    public function incrementPositions($parentId, $startPosition)
    {
        $this->where('parent_id', $parentId)
             ->where('position >=', $startPosition)
             ->set('position', 'position + 1', false)
             ->update();
    }

    // Lưu menu mới hoặc cập nhật menu
    public function saveMenu($data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            return $this->update($data['id'], $data);
        } else {
            return $this->insert($data);
        }
    }

    // Xóa một menu và các menu con của nó
    public function deleteMenuAndChildren($menuId)
    {
        // Tìm tất cả các menu con của menu này
        $subMenus = $this->where('parent_id', $menuId)->findAll();

        // Xóa tất cả các menu con trước
        foreach ($subMenus as $subMenu) {
            $this->deleteMenuAndChildren($subMenu['id']); // Đệ quy xóa menu con
        }

        // Xóa menu hiện tại
        return $this->delete($menuId);
    }

}
