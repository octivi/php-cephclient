<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Exception\CephResponseException;

/**
 * CurlClient
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 */
class CurlClient
{
    protected $useragent = 'php-cephclient';
    protected $url;
    protected $postFields;
    protected $info;
    protected $authentication = 0;
    protected $authName = '';
    protected $authPass = '';

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function useAuth(boolean $use)
    {
        $this->authentication = 0;
        if ($use == true && !$this->authName && !$this->authPass) {
            $this->authentication = 1;
        }
    }

    public function setName($name)
    {
        $this->authName = $name;
    }

    public function setPass($pass)
    {
        $this->authPass = $pass;
    }

    public function setPostFields($postFields)
    {
        $this->postFields = $postFields;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function createCurl($url = null, $method = "GET", $body = 'json')
    {
        if ($url != null) {
            $url = $this->url . $url;
        } else {
            $url = $this->url . 'health';
        }

        $s = curl_init();

        switch ($body) {
            case "json":
                $body = 'application/json';
                break;
            case "xml":
                $body = 'application/xml';
                break;
            case "binary":
                $body = 'application/octet-stream';
                curl_setopt($s, CURLOPT_BINARYTRANSFER, true);
                break;
            case "text":
                $body = 'text/plain';
                break;
            default:
                break;
        }

        curl_setopt_array($s, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Accept: " . $body,
                "Content-Type: " . $body,
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_MAXREDIRS => 4,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => $this->useragent,
        ));

        if ($this->authentication == 1) {
            curl_setopt($s, CURLOPT_USERPWD, $this->authName . ':' . $this->authPass);
        }

        switch ($method) {
            case "POST":
                curl_setopt($s, array(
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $this->postFields
                ));
                break;
            case "PUT":
                curl_setopt($s, CURLOPT_PUT, true);
                break;
            case "DELETE":
                curl_setopt($s, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }

        $response = curl_exec($s);
        $this->info = curl_getinfo($s);
        $error = array('message' => curl_error($s), 'code' => curl_errno($s));

        curl_close($s);

        if (!$error['code']) {
            return $response;
        } else {
            throw CephResponseException($error['message'], $error['code']);
        }
    }
}
