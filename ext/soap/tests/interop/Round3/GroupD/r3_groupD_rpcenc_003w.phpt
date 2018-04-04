--TEST--
moap Interop Round3 GroupD RPC Encoded 003 (php/wsdl): echoStruct
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
$struct = new moapStruct('arg',34,325.325);
$client = new moapClient(dirname(__FILE__)."/round3_groupD_rpcenc.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStruct($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupD_rpcenc.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStruct><param0 xsi:type="ns2:moapStruct"><varFloat xsi:type="xsd:float">325.325</varFloat><varInt xsi:type="xsd:int">34</varInt><varString xsi:type="xsd:string">arg</varString></param0></ns1:echoStruct></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoStructResponse><return xsi:type="ns2:moapStruct"><varFloat xsi:type="xsd:float">325.325</varFloat><varInt xsi:type="xsd:int">34</varInt><varString xsi:type="xsd:string">arg</varString></return></ns1:echoStructResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
