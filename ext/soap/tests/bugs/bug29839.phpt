--TEST--
Bug #29839 (incorrect convert (xml:lang to lang))
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php

function EchoString($s) {
  return $s;
}

class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->addFunction('EchoString');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}

$client = new LocalmoapClient(dirname(__FILE__)."/bug29839.wsdl", array("trace"=>1)); 
$client->EchoString(array("value"=>"hello","lang"=>"en"));
echo $client->__getLastRequest();
echo $client->__getLastResponse();
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri"><moap-ENV:Body><string xml:lang="en"><ns1:value>hello</ns1:value></string></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri"><moap-ENV:Body><string xml:lang="en"><ns1:value>hello</ns1:value></string></moap-ENV:Body></moap-ENV:Envelope>
ok
