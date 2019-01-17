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
            /**
             * This is an example to implement HTTP Authentication with Json Web Token (JWT).
             * Try put this code into your request and see the result.
             *
             * eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjcsInVzZXJuYW1lIjoic3RlZXZlbnoifQ.D29MZcJa2svH5kNt4bFcUtIXvJ4ohYJ-0vNxsgMWAvc
             */
            if(false !== ($token = input()->bearerToken())) {
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