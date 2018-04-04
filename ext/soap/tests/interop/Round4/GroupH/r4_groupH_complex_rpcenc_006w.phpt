--TEST--
moap Interop Round4 GroupH Complex RPC Enc 006 (php/wsdl): echoMultipleFaults1(3)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
class moapStruct {
    function moapStruct($s, $i, $f) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
    }
}
class BaseStruct {
    function BaseStruct($f, $s) {
        $this->floatMessage = $f;
        $this->shortMessage = $s;
    }
}
$s1 = new moapStruct('arg',34,325.325);
$s2 = new BaseStruct(12.345,12);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults1(3,$s1,$s2);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/wsdl" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/types" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoMultipleFaults1><whichFault xsi:type="xsd:int">3</whichFault><param1 xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></param1><param2 xsi:type="ns2:BaseStruct"><floatMessage xsi:type="xsd:float">12.345</floatMessage><shortMessage xsi:type="xsd:short">12</shortMessage></param2></ns1:echoMultipleFaults1></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/wsdl" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults1'.</faultstring><detail><ns2:part1 xsi:type="ns1:moapStructFault"><moapStruct xsi:type="ns1:moapStruct"><varString xsi:type="xsd:string">arg</varString><varInt xsi:type="xsd:int">34</varInt><varFloat xsi:type="xsd:float">325.325</varFloat></moapStruct></ns2:part1></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
