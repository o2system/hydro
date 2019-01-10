<?php
/**
 * This file is part of the O2System PHP Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Steeve Andrian Salim
 * @copyright      Copyright (c) Steeve Andrian Salim
 */

// ------------------------------------------------------------------------

namespace App\Http\Middleware;

// ------------------------------------------------------------------------

use O2System\Psr\Http\Message\ServerRequestInterface;
use O2System\Psr\Http\Server\RequestHandlerInterface;

/**
 * Class WebToken
 *
 * @package O2System\Framework\Http\Middleware
 */
class WebToken implements RequestHandlerInterface
{
    /**
     * WebToken::handle
     *
     * Handles a request and produces a response
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request)
    {
        if (services()->has('webTokenAuthentication')) {

            services('webTokenAuthentication')->setToken('WEBTOKEN-TESTING');

            if ( ! services('webTokenAuthentication')->verify()) {
                output()->sendError(403, [
                    'message' => language()->getLine('403_INVALID_WEBTOKEN')
                ]);
            }
        }
    }
}