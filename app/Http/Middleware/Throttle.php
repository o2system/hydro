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
 * Class Throttle
 * @package App\Http\Middleware
 */
class Throttle implements RequestHandlerInterface
{
    /**
     * Throttle::handle
     *
     * Handles a request and produces a response
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request)
    {
        services()->throttle->request($request);
        services()->throttle->rate([
            'span' => 1,
            'retry' => 10,
            'attempts' => 5,
        ]);

        if( ! services()->throttle->verify()) {
            output()->sendError(429);
        }
    }
}