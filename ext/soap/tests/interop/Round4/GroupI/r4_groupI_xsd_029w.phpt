--TEST--
moap Interop Round4 GroupI XSD 029 (php/wsdl): echoAnyElement
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoAnyElement(array("inputAny"=>array("any"=>"<bold>Hello World</bold>")));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoAnyElement><ns1:inputAny><bold>Hello World</bold></ns1:inputAny></ns1:echoAnyElement></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoAnyElementResponse><ns1:return><bold>Hello World</bold></ns1:return></ns1:echoAnyElementResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
