--TEST--
moap Interop Round2 groupB 005 (moap/direct): echoNestedArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
$param = new moapParam(new moapVar(array(
    new moapVar("arg", XSD_STRING, null, null, "varString"),
    new moapVar(34, XSD_INT, null, null, "varInt"),
    new moapVar(325.325, XSD_FLOAT, null, null, "varFloat"),
    new moapVar(array(
	    new moapVar("red", XSD_STRING),
	    new moapVar("blue", XSD_STRING),
	    new moapVar("green", XSD_STRING),
    ), moap_ENC_ARRAY, "ArrayOfString", "http://moapinterop.org/xsd", 'varArray')
  ), moap_ENC_OBJECT, "moapArrayStruct", "http://moapinterop.org/xsd"), "inputStruct");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoNestedArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoNestedArray><inputStruct xsi:type="ns2:moapArrayStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat><varArray moap-ENC:arrayType="xsd:string[3]" xsi:type="ns2:ArrayOfString"><item xsi:type="xsd:string">red</item><item xsi:type="xsd:string">blue</item><item xsi:type="xsd:string">green</item></varArray></inputStruct></ns1:echoNestedArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoNestedArrayResponse><return xsi:type="ns2:moapArrayStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat><varArray moap-ENC:arrayType="xsd:string[3]" xsi:type="ns2:ArrayOfstring"><item xsi:type="xsd:string">red</item><item xsi:type="xsd:string">blue</item><item xsi:type="xsd:string">green</item></varArray></return></ns1:echoNestedArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
