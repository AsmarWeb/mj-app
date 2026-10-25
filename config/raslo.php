<?php

return [
    'api_base_url' => env('RASLO_API_BASE_URL'),
    'tracking_hosts' => array_filter(array_map('trim', explode(',', env('RASLO_TRACKING_HOSTS', '')))),
];
