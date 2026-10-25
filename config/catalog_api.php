<?php

return [
    // Shared by legacy and v1 catalog routes, per observed client IP. Tune for your deployment.
    'rate_limit' => (int) env('CATALOG_API_RATE_LIMIT', 60),
];
