--TEST--
moap Interop Round2 base 008 (php/wsdl): echoStringArray(empty)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round2_base.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStringArray(array());
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArray><inputStringArray moap-ENC:arrayType="xsd:string[0]" xsi:type="ns2:ArrayOfstring"/></ns1:echoStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArrayResponse><outputStringArray moap-ENC:arrayType="xsd:string[0]" xsi:type="ns2:ArrayOfstring"/></ns1:echoStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
