--TEST--
moap Interop Round2 base 011 (php/direct): echoIntegerArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoIntegerArray", array(array(1,234324324,2)), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoIntegerArray><param0 moap-ENC:arrayType="xsd:int[3]" xsi:type="moap-ENC:Array"><item xsi:type="xsd:int">1</item><item xsi:type="xsd:int">234324324</item><item xsi:type="xsd:int">2</item></param0></ns1:echoIntegerArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoIntegerArrayResponse><outputIntegerArray moap-ENC:arrayType="xsd:int[3]" xsi:type="ns2:ArrayOfint"><item xsi:type="xsd:int">1</item><item xsi:type="xsd:int">234324324</item><item xsi:type="xsd:int">2</item></outputIntegerArray></ns1:echoIntegerArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
