<?php

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CephClient;

class CallsWrapper
{

    protected $client;
    private $debug;

    public function __construct(CephClient $client, $debug = false)
    {
        $this->client = $client;
        $this->debug = $debug;
    }

    protected function getCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "GET", $body);
        if ($body === 'json' && $this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function postCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "POST", $body);
        if ($body === 'json' && $this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function putCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "PUT", $body);
        if ($body === 'json' && $this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function deleteCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "DELETE", $body);
        if ($body === 'json' && $this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    private function decodeAnswer($answer)
    {
        return json_decode($answer);
    }

}