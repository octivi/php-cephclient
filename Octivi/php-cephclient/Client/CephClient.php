<?php

namespace Client;

use Exception\CephResponseException;

class CephClient {

    private $useragent = 'nautilus ceph client';
    private $url;
    private $postFields;
    private $info;
    private $authentication = 0;
    private $auth_name = '';
    private $auth_pass = '';

    public function __construct($url) {
        $this->url = $url;
    }

    public function useAuth(boolean $use) {
        $this->authentication = 0;
        if ($use == true && !$this->auth_name && !$this->auth_pass) {
            $this->authentication = 1;
        }
    }

    public function setName($name) {
        $this->auth_name = $name;
    }

    public function setPass($pass) {
        $this->auth_pass = $pass;
    }

    public function setPostFields($postFields) {
        $this->postFields = $postFields;
    }

    public function getInfo() {
        return $this->info;
    }

    public function createCurl($url = null, $method = "GET", $body = 'json') {
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
            curl_setopt($s, CURLOPT_USERPWD, $this->auth_name . ':' . $this->auth_pass);
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
