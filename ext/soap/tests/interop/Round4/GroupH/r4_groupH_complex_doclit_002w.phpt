--TEST--
moap Interop Round4 GroupH Complex Doc Lit 002 (php/wsdl): echoBaseStructFault
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
        $this->structMessage = $f;
        $this->shortMessage = $s;
    }
}
$struct = new BaseStruct(new moapStruct("a1",11,12.345),11);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoBaseStructFault($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/requestresponse"><moap-ENV:Body><ns2:echoBaseStructFaultRequest><ns1:structMessage><ns1:varString>a1</ns1:varString><ns1:varInt>11</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns1:structMessage><ns1:shortMessage>11</ns1:shortMessage></ns2:echoBaseStructFaultRequest></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoBaseStructFault'.</faultstring><detail><ns2:BaseStructPart><ns1:structMessage><ns1:varString>a1</ns1:varString><ns1:varInt>11</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns1:structMessage><ns1:shortMessage>11</ns1:shortMessage></ns2:BaseStructPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
