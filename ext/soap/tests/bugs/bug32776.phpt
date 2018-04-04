--TEST--
Bug #32776 (moap doesn't support one-way operations)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php

$d = null;

function test($x) {
	global $d;
	$d = $x;
}

class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->addFunction('test');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}

$x = new LocalmoapClient(dirname(__FILE__)."/bug32776.wsdl",array("trace"=>true,"exceptions"=>false)); 
var_dump($x->test("Hello"));
var_dump($d);
var_dump($x->__getLastRequest());
var_dump($x->__getLastResponse());
echo "ok\n";
?>
--EXPECT--
NULL
string(5) "Hello"
string(459) "<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><moap-ENV:test><x xsi:type="xsd:string">Hello</x></moap-ENV:test></moap-ENV:Body></moap-ENV:Envelope>
"
string(0) ""
ok
