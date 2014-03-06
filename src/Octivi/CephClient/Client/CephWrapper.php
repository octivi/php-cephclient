<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CephClient;
use Octivi\CephClient\Client\Commands\AuthCommands;
use Octivi\CephClient\Client\Commands\ConfigKeyCommands;
use Octivi\CephClient\Client\Commands\MdsCommands;
use Octivi\CephClient\Client\Commands\MonCommands;
use Octivi\CephClient\Client\Commands\OsdCommands;
use Octivi\CephClient\Client\Commands\PgCommands;
use Octivi\CephClient\Client\Commands\RootCommands;
use Octivi\CephClient\Client\Commands\TellCommands;

/**
 * CephWrapper
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class CephWrapper
{
    /**
     * @var CephClient
     */
    private $client;

    /**
     * @var AuthCommands
     */
    public $auth;

    /**
     * @var ConfigKeyCommands
     */
    public $confKey;

    /**
     * @var MdsCommands
     */
    public $mds;

    /**
     * @var MonCommands
     */
    public $mon;

    /**
     * @var OsdCommands
     */
    public $osd;

    /**
     * @var PgCommands
     */
    public $pg;

    /**
     * @var RootCommands
     */
    public $root;

    /**
     * @var TellCommands
     */
    public $tell;

    public function __construct($url, $debug = false)
    {
        $this->client = new CephClient($url);

        $this->auth = new AuthCommands($this->client, $debug);
        $this->confKey = new ConfigKeyCommands($this->client, $debug);
        $this->mds = new MdsCommands($this->client, $debug);
        $this->mon = new MonCommands($this->client, $debug);
        $this->osd = new OsdCommands($this->client, $debug);
        $this->pg = new PgCommands($this->client, $debug);
        $this->root = new RootCommands($this->client, $debug);
        $this->tell = new TellCommands($this->client, $debug);
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