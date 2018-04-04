--TEST--
moap Interop Round4 GroupI XSD 030 (php/wsdl): echoVoidmoapHeader(1)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$hdr = new moapHeader("http://moapinterop.org/","echoMeStringRequest", array("varString"=>"Hello World"), 1);
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->__moapCall("echoVoidmoapHeader",array(),null,$hdr);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org" xmlns:ns2="http://moapinterop.org/echoheader/" xmlns:ns3="http://moapinterop.org/"><moap-ENV:Header><ns3:echoMeStringRequest moap-ENV:mustUnderstand="1"><ns2:varString>Hello World</ns2:varString></ns3:echoMeStringRequest></moap-ENV:Header><moap-ENV:Body><ns1:echoVoidmoapHeader/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/echoheader/" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Header><ns2:echoMeStringResponse><ns1:varString>Hello World</ns1:varString></ns2:echoMeStringResponse></moap-ENV:Header><moap-ENV:Body><ns2:echoVoidmoapHeaderResponse/></moap-ENV:Body></moap-ENV:Envelope>
ok
