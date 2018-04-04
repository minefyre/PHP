--TEST--
moap Interop Round2 groupB 003 (php/wsdl): echo2DStringArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$param = array(
    array('row0col0', 'row0col1', 'row0col2'),
    array('row1col0', 'row1col1', 'row1col2'));
$client = new moapClient(dirname(__FILE__)."/round2_groupB.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echo2DStringArray($param);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echo2DStringArray><input2DStringArray moap-ENC:arrayType="xsd:string[2,3]" xsi:type="ns2:ArrayOfString2D"><item xsi:type="xsd:string">row0col0</item><item xsi:type="xsd:string">row0col1</item><item xsi:type="xsd:string">row0col2</item><item xsi:type="xsd:string">row1col0</item><item xsi:type="xsd:string">row1col1</item><item xsi:type="xsd:string">row1col2</item></input2DStringArray></ns1:echo2DStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echo2DStringArrayResponse><return moap-ENC:arrayType="xsd:string[2,3]" xsi:type="ns2:ArrayOfString2D"><item xsi:type="xsd:string">row0col0</item><item xsi:type="xsd:string">row0col1</item><item xsi:type="xsd:string">row0col2</item><item xsi:type="xsd:string">row1col0</item><item xsi:type="xsd:string">row1col1</item><item xsi:type="xsd:string">row1col2</item></return></ns1:echo2DStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
