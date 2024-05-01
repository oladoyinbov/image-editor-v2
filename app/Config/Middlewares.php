<?php

namespace App\Config;

use App\Http\Middleware\{
    VerifyCsrfToken,
    AdminDashGuard,
    AdminAuthGuard,
    InstallationGuard
};

class Middlewares
{
    /**
     * Declare your middleware alias name here
     */
    public static array $aliases = [
        "verify.csrf" => VerifyCsrfToken::class,

        "admin.dash" => AdminDashGuard::class,

        "admin.auth" => AdminAuthGuard::class,

        "admin.installation" => InstallationGuard::class
    ];
}