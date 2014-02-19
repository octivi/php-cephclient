<?php

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

class CephWrapper {

    private $client;
    public $auth;
    public $confKey;
    public $mds;
    public $mon;
    public $osd;
    public $pg;
    public $root;
    public $tell;

    public function __construct($url) {

        $this->client = new CephClient($url);

        $this->auth = new AuthCalls($this->client);
        $this->confKey = new ConfigKeyCalls($this->client);
        $this->mds = new MdsCalls($this->client);
        $this->mon = new MonCalls($this->client);
        $this->osd = new OsdCalls($this->client);
        $this->pg = new PgCalls($this->client);
        $this->root = new RootCalls($this->client);
        $this->tell = new TellCalls($this->client);
    }

    public function useAuth(boolean $use) {
        $this->client->useAuth($use);
    }

    public function setName($name) {
        $this->client->setName($name);
    }

    public function setPass($pass) {
        $this->client->setPass($pass);
    }

}
