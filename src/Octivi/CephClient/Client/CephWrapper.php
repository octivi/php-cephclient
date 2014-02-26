<?php
/*
    php-cephcielnt is a PHP library to communicate with Ceph's REST API
    Copyright (C) 2014  IMAGIN Sp. z o.o.
    Author: Rafał Lorenz <rlorenz@imagin.pl>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CephClient;
use Octivi\CephClient\Client\Calls\AuthCalls;
use Octivi\CephClient\Client\Calls\ConfigKeyCalls;
use Octivi\CephClient\Client\Calls\MdsCalls;
use Octivi\CephClient\Client\Calls\MonCalls;
use Octivi\CephClient\Client\Calls\OsdCalls;
use Octivi\CephClient\Client\Calls\PgCalls;
use Octivi\CephClient\Client\Calls\RootCalls;
use Octivi\CephClient\Client\Calls\TellCalls;

class CephWrapper
{

    /**
     *
     * @var CephClient
     */
    private $client;

    /**
     *
     * @var AuthCalls
     */
    public $auth;

    /**
     *
     * @var ConfigKeyCalls
     */
    public $confKey;

    /**
     *
     * @var MdsCalls
     */
    public $mds;

    /**
     *
     * @var MonCalls
     */
    public $mon;

    /**
     *
     * @var OsdCalls
     */
    public $osd;

    /**
     *
     * @var PgCalls
     */
    public $pg;

    /**
     *
     * @var RootCalls
     */
    public $root;

    /**
     *
     * @var TellCalls
     */
    public $tell;

    public function __construct($url, $debug = false)
    {
        $this->client = new CephClient($url);

        $this->auth = new AuthCalls($this->client, $debug);
        $this->confKey = new ConfigKeyCalls($this->client, $debug);
        $this->mds = new MdsCalls($this->client, $debug);
        $this->mon = new MonCalls($this->client, $debug);
        $this->osd = new OsdCalls($this->client, $debug);
        $this->pg = new PgCalls($this->client, $debug);
        $this->root = new RootCalls($this->client, $debug);
        $this->tell = new TellCalls($this->client, $debug);
    }

    public function useAuth($name, $pass)
    {
        if (isset($name) && isset($pass)) {
            $this->client->useAuth(true);
            $this->client->setName($name);
            $this->client->setPass($pass);
        } else {
            $this->client->useAuth(false);
        }
    }

    public function getInfo()
    {
        return $this->client->getInfo();
    }

}