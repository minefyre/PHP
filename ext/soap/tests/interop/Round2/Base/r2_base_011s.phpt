--TEST--
moap Interop Round2 base 011 (moap/direct): echoIntegerArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$param =  new moapParam(new moapVar(array(
    new moapVar(1,XSD_INT),
    new moapVar(234324324,XSD_INT),
    new moapVar(2,XSD_INT)
  ), moap_ENC_ARRAY, "ArrayOfint","http://moapinterop.org/xsd"), "inputIntegerArray");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoIntegerArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoIntegerArray><inputIntegerArray moap-ENC:arrayType="xsd:int[3]" xsi:type="ns2:ArrayOfint"><item xsi:type="xsd:int">1</item><item xsi:type="xsd:int">234324324</item><item xsi:type="xsd:int">2</item></inputIntegerArray></ns1:echoIntegerArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoIntegerArrayResponse><outputIntegerArray moap-ENC:arrayType="xsd:int[3]" xsi:type="ns2:ArrayOfint"><item xsi:type="xsd:int">1</item><item xsi:type="xsd:int">234324324</item><item xsi:type="xsd:int">2</item></outputIntegerArray></ns1:echoIntegerArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
