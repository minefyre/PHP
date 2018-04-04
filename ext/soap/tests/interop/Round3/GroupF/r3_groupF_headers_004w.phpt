--TEST--
moap Interop Round3 GroupF Headers 004 (php/wsdl): echoString
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$hdr = array(
  new moapHeader("http://moapinterop.org/xsd","Header1", array("int"=>34,"string"=>"arg1")),
  new moapHeader("http://moapinterop.org/xsd","Header2", array("int"=>43,"string"=>"arg2"))
);
$client = new moapClient(dirname(__FILE__)."/round3_groupF_headers.wsdl",array("trace"=>1,"exceptions"=>0));
$client->__moapCall("echoString",array("Hello World"),null,$hdr);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupF_headers.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Header><ns1:Header1><ns1:string>arg1</ns1:string><ns1:int>34</ns1:int></ns1:Header1><ns1:Header2><ns1:int>43</ns1:int><ns1:string>arg2</ns1:string></ns1:Header2></moap-ENV:Header><moap-ENV:Body><ns1:echoStringParam>Hello World</ns1:echoStringParam></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:echoStringReturn>Hello World</ns1:echoStringReturn></moap-ENV:Body></moap-ENV:Envelope>
ok
