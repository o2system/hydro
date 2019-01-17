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

namespace App\Http;

// ------------------------------------------------------------------------

use O2System\Framework\Http;
use App\Http\Middleware;

/**
 * Class Middleware
 *
 * @package App\Http
 */
class Middleware extends Http\Middleware
{
    public function __construct()
    {
        parent::__construct();

        $this->register( new Middleware\WebToken(), 'webToken' );
        $this->register( new Middleware\JsonWebToken(), 'jsonWebToken' );
    }
}