<?php

namespace App\Controllers\B;

use App\Models\DistrictModel;

class District_Controller extends BaseControllervn
{
    public function getByProvince($provinceId)
    {
        $districtModel = new DistrictModel();
        $districts     = $districtModel->where('province_id', $provinceId)->findAll();

        return $this->response->setJSON($districts);
    }
}
