<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use FastVolt\Core\Http\HttpRequest as Request;

class VerifyCsrfToken extends \FastVolt\Core\Middleware
{
    public function implement(Request $request)
    {
        if (
            (
                $request->is_post_request() ||
                $request->is_put_request()
            ) &&
            verify_csrf_token() === false
        ) {
            exit(csrf_error());
        }
    }

}