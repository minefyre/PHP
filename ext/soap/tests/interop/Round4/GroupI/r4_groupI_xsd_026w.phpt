--TEST--
moap Interop Round4 GroupI XSD 026 (php/wsdl): echoChoice
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoChoice(array("inputChoice"=>(object)array("name1"=>"Hello World")));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoChoice><ns2:inputChoice><ns1:name1>Hello World</ns1:name1></ns2:inputChoice></ns2:echoChoice></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoChoiceResponse><ns2:return><ns1:name1>Hello World</ns1:name1></ns2:return></ns2:echoChoiceResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
