--TEST--
moap Interop Round4 GroupH Simple RPC Enc 004 (php/wsdl): echoMultipleFaults1(1)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_simple_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults1(1,"Hello world",array(12.345,45,678));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_simple_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/types" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoMultipleFaults1><whichFault xsi:type="xsd:int">1</whichFault><param1 xsi:type="xsd:string">Hello world</param1><param2 moap-ENC:arrayType="xsd:float[3]" xsi:type="ns2:ArrayOfFloat"><item xsi:type="xsd:float">12.345</item><item xsi:type="xsd:float">45</item><item xsi:type="xsd:float">678</item></param2></ns1:echoMultipleFaults1></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults1'.</faultstring><detail><ns2:part1 xsi:nil="true" xsi:type="ns1:EmptyFault"/></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
