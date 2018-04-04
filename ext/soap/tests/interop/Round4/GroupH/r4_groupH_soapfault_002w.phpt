--TEST--
moap Interop Round4 GroupH moapFault 002 (php/wsdl): echoVersionMismatchFault(moap 1.2)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round4_groupH_moapfault.wsdl",array("trace"=>1,"exceptions"=>0,"moap_version"=>moap_1_2));
$client->echoVersionMismatchFault();
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_moapfault.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:enc="http://www.w3.org/2003/05/moap-encoding"><env:Body><ns1:echoVersionMismatchFault env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"/></env:Body></env:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:enc="http://www.w3.org/2003/05/moap-encoding"><env:Body><ns1:echoVersionMismatchFaultResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"/></env:Body></env:Envelope>
ok
