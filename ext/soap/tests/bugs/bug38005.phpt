--TEST--
Bug #38005 (moapFault faultstring doesn't follow encoding rules)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
function Test($param) {
	return new moapFault('Test', 'This is our fault: �');
}

class TestmoapClient extends moapClient {
  function __construct($wsdl, $opt) {
    parent::__construct($wsdl, $opt);
    $this->server = new moapServer($wsdl, $opt);
    $this->server->addFunction('Test');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }
}

$client = new TestmoapClient(NULL, array(
    'encoding' => 'ISO-8859-1',
	'uri' => "test://",
	'location' => "test://",
	'moap_version'=>moap_1_2,
	'trace'=>1, 
	'exceptions'=>0));
$res = $client->Test();
echo($res->faultstring."\n");
echo($client->__getLastResponse());
?>
--EXPECT--
This is our fault: �
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>Test</env:Value></env:Code><env:Reason><env:Text>This is our fault: Ä</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>
