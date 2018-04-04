--TEST--
moap Interop Round4 GroupH Simple Doc Lit 003 (php/wsdl): echoIntArrayFault
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_simple_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoIntArrayFault(array(34,12.345));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_simple_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/requestresponse"><moap-ENV:Body><ns2:echoIntArrayFaultRequest><ns1:value>34</ns1:value><ns1:value>12</ns1:value></ns2:echoIntArrayFaultRequest></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoIntArrayFault'.</faultstring><detail><ns2:ArrayOfIntPart><ns1:value>34</ns1:value><ns1:value>12</ns1:value></ns2:ArrayOfIntPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
