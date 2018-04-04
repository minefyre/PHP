--TEST--
Bug #42488 (moapServer reports an encoding error and the error itself breaks)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$request = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test:\" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:getBadUTF/></moap-ENV:Body></moap-ENV:Envelope>
EOF;
$moap = new moapServer(NULL, array('uri'=>'test://'));
function getBadUTF(){
    return "stuff\x93thing";
}
$moap->addFunction('getBadUTF');
$moap->handle($request);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>moap-ERROR: Encoding: string 'stuff\x93...' is not a valid utf-8 string</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>