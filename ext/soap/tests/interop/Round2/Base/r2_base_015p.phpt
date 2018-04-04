--TEST--
moap Interop Round2 base 015 (php/direct): echoStructArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
class moapStruct {
    function moapStruct($s, $i, $f) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
    }
}

$struct1 = new moapStruct('arg',34,325.325);
$struct2 = new moapStruct('arg',34,325.325);
$client = new moapClient(NULL,array("location"=>"test://","uri"=>"http://moapinterop.org/","trace"=>1,"exceptions"=>0));
$client->__moapCall("echoStructArray", array(array($struct1,$struct2)), array("moapaction"=>"http://moapinterop.org/","uri"=>"http://moapinterop.org/"));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_base.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStructArray><param0 moap-ENC:arrayType="moap-ENC:Struct[2]" xsi:type="moap-ENC:Array"><item xsi:type="moap-ENC:Struct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></item><item xsi:type="moap-ENC:Struct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></item></param0></ns1:echoStructArray></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStructArrayResponse><outputStructArray moap-ENC:arrayType="ns2:moapStruct[2]" xsi:type="ns2:ArrayOfmoapStruct"><item xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></item><item xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></item></outputStructArray></ns1:echoStructArrayResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
