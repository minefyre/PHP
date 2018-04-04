--TEST--
moap Interop Round4 GroupH Simple RPC Enc 003 (php/wsdl): echoIntArrayFault
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_simple_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoIntArrayFault(array(34,12.345));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_simple_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/types" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoIntArrayFault><param moap-ENC:arrayType="xsd:int[2]" xsi:type="ns2:ArrayOfInt"><item xsi:type="xsd:int">34</item><item xsi:type="xsd:int">12</item></param></ns1:echoIntArrayFault></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/wsdl" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoIntArrayFault'.</faultstring><detail><ns2:part5 moap-ENC:arrayType="xsd:int[2]" xsi:type="ns1:ArrayOfInt"><item xsi:type="xsd:int">34</item><item xsi:type="xsd:int">12</item></ns2:part5></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
