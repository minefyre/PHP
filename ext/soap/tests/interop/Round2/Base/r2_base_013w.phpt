--TEST--
moap Interop Round2 base 013 (php/wsdl): echoFloatArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round2_base.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoFloatArray(array(1.3223,34.2,325.325));
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
