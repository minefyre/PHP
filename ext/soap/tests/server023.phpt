--TEST--
moap Server 23: Send moap headers those were not received
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function test() {
	global $server;
	$server->addmoapHeader(new moapHeader("http://testuri.org", "Test1", "Hello Header!"));
	$server->addmoapHeader(new moapHeader("http://testuri.org", "Test2", "Hello Header!"));
	return "Hello Body!";
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("test");

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
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
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:Test1>Hello Header!</ns1:Test1><ns1:Test2>Hello Header!</ns1:Test2></moap-ENV:Header><moap-ENV:Body><ns1:testResponse><return xsi:type="xsd:string">Hello Body!</return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
