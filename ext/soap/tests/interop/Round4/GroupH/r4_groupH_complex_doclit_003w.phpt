--TEST--
moap Interop Round4 GroupH Complex Doc Lit 003 (php/wsdl): echoExtendedStructFault
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
class ExtendedStruct extends BaseStruct {
    function ExtendedStruct($f, $s, $x1, $x2, $x3) {
        $this->BaseStruct($f,$s);
        $this->stringMessage = $x1;
        $this->intMessage = $x2;
        $this->anotherIntMessage = $x3;
    }
}
$struct = new ExtendedStruct(new moapStruct("a1",11,12.345),12,"arg",-3,5);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoExtendedStructFault($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/requestresponse"><moap-ENV:Body><ns2:echoExtendedStructFaultRequest><ns1:structMessage><ns1:varString>a1</ns1:varString><ns1:varInt>11</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns1:structMessage><ns1:shortMessage>12</ns1:shortMessage><ns1:stringMessage>arg</ns1:stringMessage><ns1:intMessage>-3</ns1:intMessage><ns1:anotherIntMessage>5</ns1:anotherIntMessage></ns2:echoExtendedStructFaultRequest></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoExtendedStructFault'.</faultstring><detail><ns2:ExtendedStructPart><ns1:structMessage><ns1:varString>a1</ns1:varString><ns1:varInt>11</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns1:structMessage><ns1:shortMessage>12</ns1:shortMessage><ns1:stringMessage>arg</ns1:stringMessage><ns1:intMessage>-3</ns1:intMessage><ns1:anotherIntMessage>5</ns1:anotherIntMessage></ns2:ExtendedStructPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
