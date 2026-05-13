<?php
// config/app.php

return [
    'app_name' => 'Burger Labs',
    'tagline' => 'Cook. Break. Exploit.',
    'env' => 'training', // 'training' or 'production' (secure)
    'debug' => true,
    
    // Core Vulnerability settings
    'vulnerabilities' => [
        'enabled' => true, // Global toggle
        'difficulty' => 'soft_bun', // soft_bun (No Protection), grilled_bun, burnt_bun, black_hole
    ],
    
    'jwt_secret' => 'HGEMA_EXPLOIT_ENGINE_SUPER_SECRET_KEY_2026',
];
