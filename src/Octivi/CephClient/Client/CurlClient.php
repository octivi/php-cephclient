<?php

/*
 * Copyright 2014 IMAGIN Sp. z o.o. - imagin.pl
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Octivi\CephClient\Client;

use Octivi\CephClient\Exception\CephResponseException;
use Octivi\CephClient\Exception\FormatNotSupportedException;

/**
 * CurlClient
 *
 * @author Rafał Lorenz <rlorenz@imagin.pl>
 * @author Antoni Orfin <aorfin@imagin.pl>
 */
class CurlClient
{
    /**
     * HTTP methods constants 
     */
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * Response formats constants 
     */
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';
    const FORMAT_BINARY = 'binary';
    const FORMAT_TEXT = 'text';

    protected $useragent = 'php-cephclient';
    protected $url;
    protected $postFields;
    protected $info;
    protected $authentication = false;
    protected $authName;
    protected $authPass;

    /**
     * The array of request content types based on the specified response format
     * 
     * @var String[]
     */
    protected static $contentType = array(
        self::FORMAT_JSON => 'application/json',
        self::FORMAT_XML => 'application/xml',
        self::FORMAT_BINARY => 'application/octet-stream',
        self::FORMAT_TEXT => 'text/plain',
    );

    public function __construct($url)
    {
        $this->url = rtrim($url, '/') . '/';
    }

    public function useAuth($use)
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

    public function createCurl($endpoint, $method = self::METHOD_GET, $format = self::FORMAT_JSON)
    {
        $curl = curl_init();

        $this->setContentType($curl, $format);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . '' .$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_MAXREDIRS => 4,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => $this->useragent,
        ));

        if ($this->authentication == 1) {
            curl_setopt($curl, CURLOPT_USERPWD, $this->authName . ':' . $this->authPass);
        }

        switch ($method) {
            case self::METHOD_POST:
                curl_setopt($curl, array(
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $this->postFields
                ));
                break;
            case self::METHOD_PUT:
                curl_setopt($curl, CURLOPT_PUT, true);
                break;
            case self::METHOD_DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }

        $response = curl_exec($curl);
        $this->info = curl_getinfo($curl);
        $error = array('message' => curl_error($curl), 'code' => curl_errno($curl));

        curl_close($curl);

        if (!$error['code']) {
            return $response;
        } else {
            throw new CephResponseException($error['message'], $error['code']);
        }
    }

    protected function setContentType($curl, $format)
    {
        if (!isset(self::$contentType[$format])) {
            throw new FormatNotSupportedException($format, array_keys(self::$contentType));
        }
        
        $contentType = self::$contentType[$format];

        if (self::FORMAT_BINARY === $format) {
            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
        }

        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => array(
                'Accept: ' . $contentType,
                'Content-Type: ' . $contentType,
        )));
    }
}
