--TEST--
moap Interop Round2 groupB 001 (moap/direct): echoStructAsSimpleTypes
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
$param = new moapParam(new moapVar(array(
    new moapVar("arg", XSD_STRING, null, null, "varString"),
    new moapVar(34, XSD_INT, null, null, "varInt"),
    new moapVar(34.345, XSD_FLOAT, null, null, "varFloat")
  ), moap_ENC_OBJECT, "moapStruct", "http://moapinterop.org/xsd"), "inputStruct");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoStructAsSimpleTypes", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStructAsSimpleTypes><inputStruct xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">34.345</varFloat></inputStruct></ns1:echoStructAsSimpleTypes></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStructAsSimpleTypesResponse><outputString xsi:type="xsd:string">arg</outputString><outputInteger xsi:type="xsd:int">34</outputInteger><outputFloat xsi:type="xsd:float">34.345</outputFloat></ns1:echoStructAsSimpleTypesResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
