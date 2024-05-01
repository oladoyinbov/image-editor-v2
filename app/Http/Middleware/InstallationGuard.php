<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Model\Configuration;
use FastVolt\Helper\Session;
use FastVolt\Core\Http\{
    HttpRequest as Request,
    HttpResponse as Response
};

class InstallationGuard extends \FastVolt\Core\Middleware
{
    public function implement(Request $request)
    {
        $config = (new Configuration)->num_rows();

        if ($config == 0) {
            (new Configuration)->insert([
                'id' => 1,
                'site_email' => 'support@mail.com',
                'disable_install' => false
            ]);

        } else {
            $config = (new Configuration)->where('id', "=", 1)->fetch_one();

            if ($config['disable_install'] == true) {
                exit(render_error_page());
            }
        }
        
        # disabled serp indexing
        (new Response)->setHeader('x-robots-tag', 'noindex,noarchive,nosnippet');
    }

}