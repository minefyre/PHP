--TEST--
Bug #42183 (classmap cause crash in non-wsdl mode )
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
class PHPObject {
}

$req = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://ws.sit.com" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
EOF;

function test() {
	return new PHPObject();
}

$server = new moapServer(NULL, array('uri' => 'http://ws.sit.com', 
	'classmap' => array('Object' => 'PHPObject')));
$server->addFunction("test");
ob_start();
$server->handle($req);
ob_end_clean();
echo "ok\n";
--EXPECT--
ok
