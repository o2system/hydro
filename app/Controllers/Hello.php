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

namespace App\Controllers;

// ------------------------------------------------------------------------

use O2System\Framework\Http\Controllers\Restful as Controller;

/**
 * Class Hello
 *
 * @package App\Controllers
 */
class Hello extends Controller
{
    public function index()
    {
        $headers = apache_request_headers();

        $this->sendPayload(
            [
                'request' => [
                    'method' => $_SERVER[ 'REQUEST_METHOD' ],
                    'time'   => $_SERVER[ 'REQUEST_TIME' ],
                    'uri'    => $_SERVER[ 'REQUEST_URI' ],
                    'agent'  => $_SERVER[ 'HTTP_USER_AGENT' ],
                ],
                'headers' => $headers,
                'data'    => [
                    'get'  => $_GET,
                    'post' => $_POST,
                ],
            ]
        );
    }
}