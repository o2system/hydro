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

            /**
             * $token
             *
             * This is an example to implement HTTP X-WEB-TOKEN authentication.
             * The web token can be generated freely according to your own token generator concept.
             *
             * @example
             * This token is generated from simple generator concept.
             * $token = md5(json_encode(['uid' => 7, 'username' => 'steevenz'] ));
             *
             * // result: ed3d68c4d51f52734e5bb6add37147d2
             * 
             * @var string
             */

            /**
             * $users
             *
             * This is a users database thats hold users accounts.
             * 
             * @var array
             */
            $users = [
                'ed3d68c4d51f52734e5bb6add37147d2' => [
                    'uid' => 7,
                    'username' => 'steevenz',
                ]
            ];

            if($token = input()->webToken()) {
                /**
                 * Let's verify it with Web Token Authentication service callback.
                 */
                $validate = services('webTokenAuthentication')->verify($token, function($token) use ($users) {
                    return array_key_exists($token, $users);
                });

                if($validate) {
                    $payload = $users[ $token ]; // this is an example payload
                    globals()->store('payload', $payload);
                }
            }
            
            if(empty($payload)) {
                output()->sendError(403, [
                    'message' => language()->getLine('403_INVALID_WEBTOKEN')
                ]);
            }
        }
    }
}