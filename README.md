Octivi - CephClient
======================================

php-cephclient is a PHP library to communicate with [Ceph's REST API](http://ceph.com/docs/master/man/8/ceph-rest-api/).

This is currently a work in progress.

ABOUT
==================================================

CurlClient
--------------------------------------------------

The CurlClient class takes care of sending calls to the API through HTTP and
handle the responses. It supports queries for JSON, XML, plain text or binary.

CephClient
--------------------------------------------------

The CephClient class provides helper functions to
communicate with the API. The CallWrapper uses the CephClient.

Nothing prevents you from calling the client directly.

Development, Feedback, Bugs
--------------------------------------------------
Contributors:

* [Rafał Lorenz](https://github.com/vardius)
* [Antoni Orfin](https://github.com/orfin)

Thanks to [David Moreau Simard](mailto:moi@dmsimard.com), who is an author of [python-cephclient](https://github.com/dmsimard/python-cephclient), which was our inspiration on creating php-cephclient library.

Want to contribute ? Feel free to send pull requests!

Have problems, bugs, feature ideas?
We are using the github [issue tracker](https://github.com/octivi/php-cephclient/issues) to manage them.

HOW TO USE
==================================================

Installation
----------------
Install the package through composer::

    php composer.phar require octivi/php-cephclient:*


Usage
----------------
Instanciate CephClient:

    use Octivi\CephClient\Client\CephClient;

    $url = 'http://10.20.51.201:5000/api/v0.1/';
    $cephClient = new CephClient($url);

Optional with authentication:

    use Octivi\CephClient\Client\CephClient;

    $url = 'http://10.20.51.201:5000/api/v0.1/';
    $cephClient = new CephClient($url);
    $cephClient->useAuth('name', 'password');

Do your request.

    $response = $cephClient->getRoot()->fsId();

Response example:

    object(stdClass)[91]
      public 'status' => string 'OK' (length=2)
      public 'output' => 
        object(stdClass)[109]
          public 'fsid' => string '60d98352-115b-4ca1-a51b-414d98492168' (length=36)

You can set your CephClient to return json respons by setting debug parametr as `true`

    new CephClient($url, true);


Response example:

    {
        "status": "OK",
        "output": {
            "fsid": "d5252e7d-75bc-4083-85ed-fe51fa83f62b"
        }
    }

Optional possibility:
After geting your response you can draw info about the call:

    $cephClient->root->fsId();
    $cephClient->getInfo();

Info example:

    array (size=26)
        'url' => string 'http://10.20.51.201:5000/api/v0.1/fsid' (length=38)
        'content_type' => string 'application/json' (length=16)
        'http_code' => int 200
        'header_size' => int 145
        'request_size' => int 148
        'filetime' => int -1
        'ssl_verify_result' => int 0
        'redirect_count' => int 0
        'total_time' => float 0.015
        'namelookup_time' => float 0
        'connect_time' => float 0
        'pretransfer_time' => float 0
        'size_upload' => float 0
        'size_download' => float 76
        'speed_download' => float 5066
        'speed_upload' => float 0
        'download_content_length' => float 76
        'upload_content_length' => float 0
        'starttransfer_time' => float 0.015
        'redirect_time' => float 0
        'certinfo' => 
          array (size=0)
            empty
        'primary_ip' => string '10.20.51.201' (length=12)
        'primary_port' => int 5000
        'local_ip' => string '10.20.52.231' (length=12)
        'local_port' => int 52062
        'redirect_url' => string '' (length=0)


Read more: [cephClient calls group and functions](docs/more_calls_group.md)

RELEASE NOTES
==================================================
**0.1.0**

- First public release of php-cephclient