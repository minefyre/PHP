--TEST--
moap Interop Round2 base 007 (moap/direct): echoStringArray(one)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$param =  new moapParam(new moapVar(array(
    new moapVar('good', XSD_STRING)
  ), moap_ENC_ARRAY, "ArrayOfstring","http://moapinterop.org/xsd"), "inputStringArray");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoStringArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArray><inputStringArray moap-ENC:arrayType="xsd:string[1]" xsi:type="ns2:ArrayOfstring"><item xsi:type="xsd:string">good</item></inputStringArray></ns1:echoStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArrayResponse><outputStringArray moap-ENC:arrayType="xsd:string[1]" xsi:type="ns2:ArrayOfstring"><item xsi:type="xsd:string">good</item></outputStringArray></ns1:echoStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
