<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Client\CephClient;

/**
 * CommandsWrapper
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class CommandsWrapper
{
    /**
     * @var CurlClient
     */
    protected $client;
    private $debug;

    public function __construct(CurlClient $client, $debug = false)
    {
        $this->client = $client;
        $this->debug = $debug;
    }

    protected function getCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "GET", $body);
        if ($body === 'json' && !$this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function postCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "POST", $body);
        if ($body === 'json' && !$this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function putCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "PUT", $body);
        if ($body === 'json' && !$this->debug) {
            return $this->decodeAnswer($answer);
        } else {
            return $answer;
        }
    }

    protected function deleteCurl($url, $body = 'json')
    {
        $answer = $this->client->createCurl($url, "DELETE", $body);
        if ($body === 'json' && !$this->debug) {
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
