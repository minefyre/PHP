--TEST--
moap Interop Round2 base 020 (moap/direct): echoDate
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoDate", array(new moapParam(new moapVar('2001-05-24T17:31:41Z', XSD_DATETIME), "inputDate")), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoDate><inputDate xsi:type="xsd:dateTime">2001-05-24T17:31:41Z</inputDate></ns1:echoDate></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoDateResponse><outputDate xsi:type="xsd:dateTime">2001-05-24T17:31:41Z</outputDate></ns1:echoDateResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
