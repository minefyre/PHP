--TEST--
Bug #39832 (moap Server: parameter not matching the WSDL specified type are set to 0)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test.pl"><moap-ENV:Body>
<moap-ENV:Test>
<parameters priority="high">
<ns1:NetworkErrorCode>1</ns1:NetworkErrorCode>
</parameters>
</moap-ENV:Test></moap-ENV:Body></moap-ENV:Envelope>
EOF;

function Test($x) {
  return $x->priority;
}

$x = new moapServer(dirname(__FILE__)."/bug39832.wsdl");
$x->addFunction("Test");
$x->handle($HTTP_RAW_POST_DATA);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>moap-ERROR: Encoding: Violation of encoding rules</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
