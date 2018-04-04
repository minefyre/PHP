--TEST--
moap Interop Round2 groupB 003 (moap/direct): echo2DStringArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$param = new moapParam(new moapVar(array(
    new moapVar(array(
      new moapVar('row0col0', XSD_STRING),
      new moapVar('row0col1', XSD_STRING),
      new moapVar('row0col2', XSD_STRING)
    ), moap_ENC_ARRAY),
    new moapVar(array(
      new moapVar('row1col0', XSD_STRING),
      new moapVar('row1col1', XSD_STRING),
      new moapVar('row1col2', XSD_STRING)
    ), moap_ENC_ARRAY)
  ), moap_ENC_ARRAY, "ArrayOfString2D", "http://moapinterop.org/xsd"),"input2DStringArray");
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echo2DStringArray", array($param), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echo2DStringArray><input2DStringArray moap-ENC:arrayType="moap-ENC:Array[2]" xsi:type="ns2:ArrayOfString2D"><item moap-ENC:arrayType="xsd:string[3]" xsi:type="moap-ENC:Array"><item xsi:type="xsd:string">row0col0</item><item xsi:type="xsd:string">row0col1</item><item xsi:type="xsd:string">row0col2</item></item><item moap-ENC:arrayType="xsd:string[3]" xsi:type="moap-ENC:Array"><item xsi:type="xsd:string">row1col0</item><item xsi:type="xsd:string">row1col1</item><item xsi:type="xsd:string">row1col2</item></item></input2DStringArray></ns1:echo2DStringArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echo2DStringArrayResponse><return moap-ENC:arrayType="xsd:string[2,3]" xsi:type="ns2:ArrayOfString2D"><item xsi:type="xsd:string">row0col0</item><item xsi:type="xsd:string">row0col1</item><item xsi:type="xsd:string">row0col2</item><item xsi:type="xsd:string">row1col0</item><item xsi:type="xsd:string">row1col1</item><item xsi:type="xsd:string">row1col2</item></return></ns1:echo2DStringArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
