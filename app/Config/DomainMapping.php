<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class DomainMapping extends BaseConfig
{
    /**
     * Domain mapping configuration
     * Maps custom domains to usernames
     */
    public array $domainMappings = [
        'vinfastanthai.vn' => [
            'username' => 'vf',
            'type' => 'custom_domain',
            'subdomain' => 'vf.amx.vn'
        ],
        'insightsystems.vn' => [
            'username' => 'insight',
            'type' => 'custom_domain', 
            'subdomain' => 'insight.amx.vn'
        ],
        'company3.com' => [
            'username' => 'company3',
            'type' => 'custom_domain',
            'subdomain' => 'company3.amx.vn'
        ],
        // Thêm các domain mapping khác ở đây
    ];

    /**
     * Get username from domain
     */
    public function getUsernameFromDomain(string $domain): ?string
    {
        // Check custom domain mapping
        if (isset($this->domainMappings[$domain])) {
            return $this->domainMappings[$domain]['username'];
        }

        // Check subdomain pattern: username.amx.vn
        $parts = explode('.', $domain);
        if (count($parts) >= 3 && $parts[1] === 'amx' && $parts[2] === 'vn') {
            $username = $parts[0];
            // Validate username format
            if (preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                return $username;
            }
        }

        return null;
    }

    /**
     * Get domain info
     */
    public function getDomainInfo(string $domain): ?array
    {
        // Check custom domain mapping
        if (isset($this->domainMappings[$domain])) {
            return [
                'username' => $this->domainMappings[$domain]['username'],
                'type' => 'custom_domain',
                'original_domain' => $domain,
                'subdomain' => $this->domainMappings[$domain]['subdomain'],
                'is_mapped' => true
            ];
        }

        // Check subdomain pattern
        $parts = explode('.', $domain);
        if (count($parts) >= 3 && $parts[1] === 'amx' && $parts[2] === 'vn') {
            $username = $parts[0];
            if (preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                return [
                    'username' => $username,
                    'type' => 'subdomain',
                    'original_domain' => $domain,
                    'subdomain' => null,
                    'is_mapped' => false
                ];
            }
        }

        return null;
    }

    /**
     * Check if domain is valid
     */
    public function isValidDomain(string $domain): bool
    {
        return $this->getUsernameFromDomain($domain) !== null;
    }

    /**
     * Get all valid domains
     */
    public function getAllDomains(): array
    {
        $domains = [];
        
        // Add custom domains
        foreach ($this->domainMappings as $domain => $info) {
            $domains[] = $domain;
        }
        
        // Add subdomains
        foreach ($this->domainMappings as $domain => $info) {
            if (isset($info['subdomain'])) {
                $domains[] = $info['subdomain'];
            }
        }
        
        return $domains;
    }
} 