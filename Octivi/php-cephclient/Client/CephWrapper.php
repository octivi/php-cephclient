<?php

namespace Client;

use Client\CephClient;
use Client\Calls\AuthCalls;
use Client\Calls\ConfigKeyCalls;
use Client\Calls\MdsCalls;
use Client\Calls\MonCalls;
use Client\Calls\OsdCalls;
use Client\Calls\PgCalls;
use Client\Calls\RootCalls;
use Client\Calls\TellCalls;

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
