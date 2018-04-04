--TEST--
moap Interop Round3 GroupD RPC Encoded 002 (php/wsdl): echoStringArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round3_groupD_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStringArray(array("one","two","three"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupD_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArray><param0 moap-ENC:arrayType="xsd:string[3]" xsi:type="ns2:ArrayOfstring"><item xsi:type="xsd:string">one</item><item xsi:type="xsd:string">two</item><item xsi:type="xsd:string">three</item></param0></ns1:echoStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArrayResponse><return moap-ENC:arrayType="xsd:string[3]" xsi:type="ns2:ArrayOfstring"><item xsi:type="xsd:string">one</item><item xsi:type="xsd:string">two</item><item xsi:type="xsd:string">three</item></return></ns1:echoStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
