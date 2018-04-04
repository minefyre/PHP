--TEST--
moap Interop Round4 GroupI XSD 010 (php/wsdl): echoIntegerMultiOccurs
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoIntegerMultiOccurs(array("inputIntegerMultiOccurs"=>array(22,29,36)));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoIntegerMultiOccurs><ns1:inputIntegerMultiOccurs><ns1:int>22</ns1:int><ns1:int>29</ns1:int><ns1:int>36</ns1:int></ns1:inputIntegerMultiOccurs></ns1:echoIntegerMultiOccurs></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoIntegerMultiOccursResponse><ns1:return>22</ns1:return><ns1:return>29</ns1:return><ns1:return>36</ns1:return></ns1:echoIntegerMultiOccursResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
