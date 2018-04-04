--TEST--
moap Interop Round2 base 009 (moap/direct): echoStringArray(NULL)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$param =  new moapParam(new moapVar(NULL, moap_ENC_ARRAY, "ArrayOfstring","http://moapinterop.org/xsd"), "inputStringArray");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoStringArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArray><inputStringArray xsi:nil="true" xsi:type="ns2:ArrayOfstring"/></ns1:echoStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStringArrayResponse><outputStringArray xsi:nil="true" xsi:type="ns2:ArrayOfstring"/></ns1:echoStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
