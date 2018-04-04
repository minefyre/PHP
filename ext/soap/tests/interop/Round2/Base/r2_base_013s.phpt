--TEST--
moap Interop Round2 base 013 (moap/direct): echoFloatArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
$param =  new moapParam(new moapVar(array(
    new moapVar(1.3223, XSD_FLOAT),
    new moapVar(34.2, XSD_FLOAT),
    new moapVar(325.325, XSD_FLOAT)
  ), moap_ENC_ARRAY, "ArrayOffloat","http://moapinterop.org/xsd"), "inputFloatArray");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoFloatArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoFloatArray><inputFloatArray moap-ENC:arrayType="xsd:float[3]" xsi:type="ns2:ArrayOffloat"><item xsi:type="xsd:float">1.3223</item><item xsi:type="xsd:float">34.2</item><item xsi:type="xsd:float">325.325</item></inputFloatArray></ns1:echoFloatArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoFloatArrayResponse><outputFloatArray moap-ENC:arrayType="xsd:float[3]" xsi:type="ns2:ArrayOffloat"><item xsi:type="xsd:float">1.3223</item><item xsi:type="xsd:float">34.2</item><item xsi:type="xsd:float">325.325</item></outputFloatArray></ns1:echoFloatArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
