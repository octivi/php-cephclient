<?php

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CephClient;

class CallsWrapper {

    protected $client;

    public function __construct(CephClient $client) {
        $this->client = $client;
    }

    protected function getCurl($url, $body = 'json') {
        return $this->client->createCurl($url, "GET", $body);
    }

    protected function postCurl($url, $body = 'json') {
        return $this->client->createCurl($url, "POST", $body);
    }

    protected function putCurl($url, $body = 'json') {
        return $this->client->createCurl($url, "PUT", $body);
    }

    protected function deleteCurl($url, $body = 'json') {
        return $this->client->createCurl($url, "DELETE", $body);
    }

    public function getInfo() {
        return $this->client->getInfo();
    }

}
