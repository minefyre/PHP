--TEST--
moap Interop Round4 GroupH Simple RPC Enc 009 (php/wsdl): echoMultipleFaults2(2)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_simple_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults2(2, "Hello World", 12.345, array("one","two","three"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_simple_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/types" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoMultipleFaults2><whichFault xsi:type="xsd:int">2</whichFault><param1 xsi:type="xsd:string">Hello World</param1><param2 xsi:type="xsd:float">12.345</param2><param3 moap-ENC:arrayType="xsd:string[3]" xsi:type="ns2:ArrayOfString"><item xsi:type="xsd:string">one</item><item xsi:type="xsd:string">two</item><item xsi:type="xsd:string">three</item></param3></ns1:echoMultipleFaults2></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults2'.</faultstring><detail><ns1:part2 xsi:type="xsd:string">Hello World</ns1:part2></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
