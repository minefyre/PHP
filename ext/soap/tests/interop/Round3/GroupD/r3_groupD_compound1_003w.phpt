--TEST--
moap Interop Round3 GroupD Compound1 003 (php/wsdl): echoDocument
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round3_groupD_compound1.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoDocument((object)array("_"=>"Test Document Here","ID"=>1));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupD_compound1.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:x_Document ID="1">Test Document Here</ns1:x_Document></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:result_Document ID="1">Test Document Here</ns1:result_Document></moap-ENV:Body></moap-ENV:Envelope>
ok
