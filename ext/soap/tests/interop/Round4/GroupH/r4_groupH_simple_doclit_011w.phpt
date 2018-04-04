--TEST--
moap Interop Round4 GroupH Simple Doc Lit 011 (php/wsdl): echoMultipleFaults2(4)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_simple_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults2(array("whichFault" => 4,
                                   "param1" => "Hello world",
                                   "param2" => 12.345,
                                   "param3" => array("one","two","three")));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_simple_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types/requestresponse" xmlns:ns2="http://moapinterop.org/types"><moap-ENV:Body><ns1:echoMultipleFaults2Request><ns1:whichFault>4</ns1:whichFault><ns1:param1>Hello world</ns1:param1><ns1:param2>12.345</ns1:param2><ns1:param3><ns2:value>one</ns2:value><ns2:value>two</ns2:value><ns2:value>three</ns2:value></ns1:param3></ns1:echoMultipleFaults2Request></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults2'.</faultstring><detail><ns1:FloatPart>12.345</ns1:FloatPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
