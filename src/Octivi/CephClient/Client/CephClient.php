<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CurlClient;
use Octivi\CephClient\Client\Commands\AuthCommands;
use Octivi\CephClient\Client\Commands\ConfigKeyCommands;
use Octivi\CephClient\Client\Commands\MdsCommands;
use Octivi\CephClient\Client\Commands\MonCommands;
use Octivi\CephClient\Client\Commands\OsdCommands;
use Octivi\CephClient\Client\Commands\PgCommands;
use Octivi\CephClient\Client\Commands\RootCommands;
use Octivi\CephClient\Client\Commands\TellCommands;

/**
 * CephClient
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 * @author Antoni Orfin <aorfin@imagin.pl>
 */
class CephClient
{
    /**
     * @var CurlClient
     */
    protected $client;
    protected $debug;
    
    public function __construct($url, $debug = false)
    {
        $this->client = new CurlClient($url);
        $this->debug = $debug;
    }

    public function setAuth($name, $pass)
    {
        if (isset($name) && isset($pass)) {
            $this->client->useAuth(true);
            $this->client->setName($name);
            $this->client->setPass($pass);
        } else {
            $this->client->useAuth(false);
        }
    }

    public function getAuth()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new AuthCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getConfigKey()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new ConfigKeyCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getMds()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new MdsCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getMon()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new MonCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getOsd()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new OsdCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getPg()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new PgCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getRoot()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new RootCommands($this->client, $this->debug);
        }
        
        return $commands;
    }

    public function getTell()
    {
        static $commands;
        
        if (!isset($commands)) {
            $commands = new TellCommands($this->client, $this->debug);
        }
        
        return $commands;
    }
    
    public function getInfo()
    {
        return $this->client->getInfo();
    }
}
