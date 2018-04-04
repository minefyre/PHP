--TEST--
moap Server 25: One-way moap headers encoding using WSDL
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class TestHeader1 extends moapHeader {
	function __construct($data) {
		parent::__construct("http://testuri.org", "Test1", $data);
	}
}

class TestHeader2 extends moapHeader {
	function __construct($data) {
		parent::__construct("http://testuri.org", "Test2", $data);
	}
}

function test() {
	global $server;
	$server->addmoapHeader(new TestHeader1("Hello Header!"));
	$server->addmoapHeader(new TestHeader2("Hello Header!"));
	return "Hello Body!";
}

$server = new moapserver(dirname(__FILE__)."/server025.wsdl");
$server->addfunction("test");

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/">
  <moap-ENV:Body>
    <ns1:test xmlns:ns1="http://testuri.org"/>
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;

$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://testuri.org"><moap-ENV:Header><ns1:Test1 xsi:type="xsd:string">Hello Header!</ns1:Test1><ns1:Test2 xsi:type="xsd:string">Hello Header!</ns1:Test2></moap-ENV:Header><moap-ENV:Body><ns1:testResponse><result>Hello Body!</result></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
