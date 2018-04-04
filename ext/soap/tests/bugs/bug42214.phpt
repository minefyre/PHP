--TEST--
Bug #42214 (moapServer sends clients internal PHP errors)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$request = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://localhost/server.php" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
EOF;

function test() {
	$a = $b;
	obvious_error(); // will cause an error
}

$server = new moapServer(NULL, array('uri' =>'http://localhost/server.php',
	'send_errors'=>0));
$server->addFunction('test');
$server->handle($request);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Internal Error</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
