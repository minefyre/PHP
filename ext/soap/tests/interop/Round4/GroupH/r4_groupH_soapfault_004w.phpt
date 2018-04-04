--TEST--
moap Interop Round4 GroupH moapFault 004 (php/wsdl): echoMustUnderstandFault
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$hdr = new moapHeader("http://moapinterop.org/wsdl", "UnknownHeaderRequest", "Hello World", 1);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_moapfault.wsdl",array("trace"=>1,"exceptions"=>0));
$client->__moapCall("echoVersionMismatchFault",array(), null, $hdr);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_moapfault.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:UnknownHeaderRequest moap-ENV:mustUnderstand="1">Hello World</ns1:UnknownHeaderRequest></moap-ENV:Header><moap-ENV:Body><ns1:echoVersionMismatchFault/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:MustUnderstand</faultcode><faultstring>Header not understood</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
