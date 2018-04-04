--TEST--
moap Interop Round4 GroupI XSD 035 (php/wsdl): echoVoidmoapHeader(6)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
$hdr = new moapHeader("http://moapinterop.org/","echoMeComplexTypeRequest", array("varInt"=>34,"varString"=>"arg","varFloat"=>12.345), 1, moap_ACTOR_NEXT);
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->__moapCall("echoVoidmoapHeader",array(),null,$hdr);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org" xmlns:ns2="http://moapinterop.org/echoheader/" xmlns:ns3="http://moapinterop.org/"><moap-ENV:Header><ns3:echoMeComplexTypeRequest moap-ENV:mustUnderstand="1" moap-ENV:actor="http://schemas.xmlmoap.org/moap/actor/next"><ns2:varString>arg</ns2:varString><ns2:varInt>34</ns2:varInt><ns2:varFloat>12.345</ns2:varFloat></ns3:echoMeComplexTypeRequest></moap-ENV:Header><moap-ENV:Body><ns1:echoVoidmoapHeader/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/echoheader/" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Header><ns2:echoMeComplexTypeResponse><ns1:varString>arg</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns2:echoMeComplexTypeResponse></moap-ENV:Header><moap-ENV:Body><ns2:echoVoidmoapHeaderResponse/></moap-ENV:Body></moap-ENV:Envelope>
ok
