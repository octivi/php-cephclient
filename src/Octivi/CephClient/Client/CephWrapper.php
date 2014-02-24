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