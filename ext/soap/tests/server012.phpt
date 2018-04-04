--TEST--
moap Server 12: WSDL generation
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--GET--
WSDL
--FILE--
<?php
function Add($x,$y) {
  return $x+$y;
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("Add");
$server->handle();
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>WSDL generation is not supported yet</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
