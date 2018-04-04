--TEST--
moap Interop Round4 GroupI XSD 012 (php/wsdl): echoStringMultiOccurs
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStringMultiOccurs(array("inputStringMultiOccurs"=>array("arg1","arg2","arg3")));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoStringMultiOccurs><ns1:inputStringMultiOccurs><ns1:string>arg1</ns1:string><ns1:string>arg2</ns1:string><ns1:string>arg3</ns1:string></ns1:inputStringMultiOccurs></ns1:echoStringMultiOccurs></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoStringMultiOccursResponse><ns1:return>arg1</ns1:return><ns1:return>arg2</ns1:return><ns1:return>arg3</ns1:return></ns1:echoStringMultiOccursResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
