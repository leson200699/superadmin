<?php

namespace App\Controllers\F;

use App\Controllers\F\BaseFrontendController;

class TestController extends BaseFrontendController
{
    public function domainMapping()
    {
        $currentDomain = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $domainInfo = get_domain_info();
        $username = get_username_from_domain();
        $isValid = is_valid_domain();
        
        $result = [
            'current_domain' => $currentDomain,
            'domain_info' => $domainInfo,
            'username' => $username,
            'is_valid_domain' => $isValid,
            'user_data' => $this->user,
            'user_id' => $this->userId
        ];
        
        return $this->response->setJSON($result);
    }
    
    public function allDomains()
    {
        $domainMapping = config('DomainMapping');
        $allDomains = $domainMapping->getAllDomains();
        
        $result = [
            'all_domains' => $allDomains,
            'domain_mappings' => $domainMapping->domainMappings
        ];
        
        return $this->response->setJSON($result);
    }
} 