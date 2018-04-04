--TEST--
moap Interop Round2 groupB 004 (php/direct): echoNestedStruct
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
$param = (object)array(
  'varString' => "arg",
  'varInt' => 34,
  'varFloat' => 123.45,
  'varStruct' => (object)array(
    'varString' => "arg2",
    'varInt' => 342,
    'varFloat' => 123.452,
  ));

$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoNestedStruct", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoNestedStruct><param0 xsi:type="moap-ENC:Struct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">123.45</varFloat><varStruct xsi:type="moap-ENC:Struct"><varString xsi:type="xsd:string">arg2</varString><varInt xsi:type="xsd:int">342</varInt><varFloat xsi:type="xsd:float">123.452</varFloat></varStruct></param0></ns1:echoNestedStruct></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoNestedStructResponse><return xsi:type="ns2:moapStructStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">123.45</varFloat><varStruct xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">arg2</varString><varInt xsi:type="xsd:int">342</varInt><varFloat xsi:type="xsd:float">123.452</varFloat></varStruct></return></ns1:echoNestedStructResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
