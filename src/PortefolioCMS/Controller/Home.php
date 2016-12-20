<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 09-12-2016 14:36
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortefolioCMS\Controller;

use StendenINF1B\PortefolioCMS\Kernel\BaseController;
use StendenINF1B\PortefolioCMS\Kernel\Http\Request;
use StendenINF1B\PortefolioCMS\Kernel\Http\Response;

class Home extends BaseController
{
    public function index( Request $request = NULL )
    {
        ob_start();
        dump( $request );
        $dumpData = ob_get_clean();

        return new Response(
            '<html>
                <head>
                    <title>Test controller</title>
                </head>
                <body>
                    <h1>Test Controller</h1>
                    '.
                    $dumpData .
                    '
                </body>
            </html>',
            Response::HTTP_STATUS_OK
        );
    }
}