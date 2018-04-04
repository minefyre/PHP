--TEST--
moap Interop Round4 GroupI XSD 007 (php/wsdl): echoDate
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoDate(array("inputDate"=>"2002-12-22T21:41:17Z"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoDate><ns1:inputDate>2002-12-22T21:41:17Z</ns1:inputDate></ns1:echoDate></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/"><moap-ENV:Body><ns1:echoDateResponse><ns1:return>2002-12-22T21:41:17Z</ns1:return></ns1:echoDateResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
