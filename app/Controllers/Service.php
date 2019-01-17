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
 * Class Service
 *
 * @package App\Controllers
 */
class Service extends Controller
{
    public function index()
    {
        $headers = apache_request_headers();

        $this->sendPayload(
            [
                'request' => [
                    'method' => $this->input->server('REQUEST_METHOD'),
                    'time'   => $this->input->server('REQUEST_TIME'),
                    'uri'    => $this->input->server('REQUEST_URI'),
                    'agent'  => $this->input->server('HTTP_USER_AGENT'),
                    'authorization' => $this->input->server('HTTP_AUTHORIZATION')
                ],
                'headers' => $headers,
                'get'  => $_GET,
                'post' => $_POST,
                'payload' => $this->globals->payload
            ]
        );
    }
}