<?php


class Soap
{

    public $baseUrl = 'https://example.com/soap.wsdl';

    public $client = null;

    public $url = null;
    public $location = null;

    public const VERSIONS = [
        1 => SOAP_1_1,
        2 => SOAP_1_2,
    ];


    public function __construct()
    {

    }

    public function configure($wsdl = false)
    {

        if ($wsdl)
            $this->client = new SoapClient($this->baseUrl, [
                'soap_version' => SOAP_1_2,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                'cache_wsdl' => WSDL_CACHE_BOTH,
                'trace' => TRUE,
                'exceptions' => TRUE
            ]);
        else
            $this->client = new SoapClient(NULL, [
                'location' => $this->location,
                'uri' => $this->url
            ]);

    }

    public function send($data)
    {
        $result = $this->client->requestData($data);
    }

    public function debug()
    {
        SoapClient::__getLastRequest();
        SoapClient::__getLastRequestHeaders();
        SoapClient::__getLastResponse();
        SoapClient::__getLastResponseHeaders();
    }


}
