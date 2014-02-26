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

class CallsWrapper
{

    /**
     *
     * @var CephClient
     */
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