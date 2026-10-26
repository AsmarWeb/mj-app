<?php

namespace App\Services\Raslo;

use RuntimeException;

class RasloEndpoint
{
    public function base(): string
    {
        $base = rtrim((string) config('raslo.api_base_url'), '/');
        $parts = parse_url($base);
        if (! $parts || ($parts['scheme'] ?? '') !== 'https' || empty($parts['host'])
            || isset($parts['user']) || isset($parts['pass']) || isset($parts['query']) || isset($parts['fragment'])
            || (isset($parts['port']) && $parts['port'] !== 443) || ! str_ends_with($parts['path'] ?? '', '/api/integrations/v1')
            || ! preg_match('/^[a-z0-9.-]+$/iD', $parts['host']) || filter_var($parts['host'], FILTER_VALIDATE_IP)) {
            throw new RuntimeException('RASLO_ENDPOINT_INVALID');
        }

        return $base;
    }

    public function options(): array
    {
        $host = parse_url($this->base(), PHP_URL_HOST);
        $records = dns_get_record($host, DNS_A | DNS_AAAA) ?: [];
        $ips = [];
        foreach ($records as $record) {
            $ip = $record['ip'] ?? $record['ipv6'] ?? null;
            if (! $ip) {
                continue;
            }
            if (! $this->isPublicAddress($ip)) {
                throw new RuntimeException('RASLO_ADDRESS_BLOCKED');
            }
            $ips[] = $ip;
        }
        if (! $ips) {
            throw new RuntimeException('RASLO_DNS_FAILED');
        }
        if (! extension_loaded('curl')) {
            throw new RuntimeException('RASLO_CURL_REQUIRED');
        }
        $ip = $ips[0];
        if (str_contains($ip, ':')) {
            $ip = '['.$ip.']';
        }

        return ['allow_redirects' => false, 'proxy' => '', 'decode_content' => false, 'curl' => [CURLOPT_RESOLVE => [$host.':443:'.$ip]], 'verify' => true,
            'progress' => function ($total, $downloaded) {
                if ($total > 65536 || $downloaded > 65536) {
                    throw new RuntimeException('RASLO_RESPONSE_TOO_LARGE');
                }
            }];
    }

    public function isPublicAddress(string $ip): bool
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return false;
        }
        if (str_contains($ip, ':')) {
            return (ord(inet_pton($ip)[0]) & 0xE0) === 0x20;
        }
        $parts = array_map('intval', explode('.', $ip));

        return $parts[0] > 0 && $parts[0] < 224 && ! ($parts[0] === 100 && $parts[1] >= 64 && $parts[1] <= 127)
            && ! ($parts[0] === 198 && in_array($parts[1], [18, 19], true));
    }

    public function tracking(mixed $url): ?string
    {
        if ($url === null || $url === '') {
            return null;
        }
        if (! is_string($url) || strlen($url) > 2048) {
            return null;
        }
        $parts = parse_url($url);
        $hosts = array_merge(array_filter([parse_url((string) config('raslo.api_base_url'), PHP_URL_HOST)]), config('raslo.tracking_hosts', []));

        return $parts && ($parts['scheme'] ?? '') === 'https' && in_array($parts['host'] ?? '', $hosts, true)
            && ! isset($parts['user']) && ! isset($parts['pass']) && (! isset($parts['port']) || $parts['port'] === 443)
            ? $url : null;
    }
}
