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
 * Class JsonWebToken
 *
 * @package O2System\Framework\Http\Middleware
 */
class JsonWebToken implements RequestHandlerInterface
{
    /**
     * JsonWebToken::handle
     *
     * Handles a request and produces a response
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request)
    {
        if (services()->has('jsonWebTokenAuthentication')) {
            if(false !== ($token = input()->bearerToken())) {
                print_out($token);
                $payload = services('jsonWebTokenAuthentication')->decode($token);
                globals()->store('payload', $payload);
            } else {
                output()->sendError(403, [
                    'message' => language()->getLine('403_INVALID_JSONWEBTOKEN')
                ]);
            }
        }
    }
}