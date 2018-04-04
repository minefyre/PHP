--TEST--
moap Interop Round4 GroupI XSD 018 (php/wsdl): echoHexBinary
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoHexBinary(array("inputHexBinary"=>"\x80\xFF\x00\x01\x7F"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoHexBinary><ns1:inputHexBinary>80FF00017F</ns1:inputHexBinary></ns1:echoHexBinary></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoHexBinaryResponse><ns1:return>80FF00017F</ns1:return></ns1:echoHexBinaryResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
