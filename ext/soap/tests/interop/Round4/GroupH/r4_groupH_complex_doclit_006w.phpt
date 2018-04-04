--TEST--
moap Interop Round4 GroupH Complex Doc Lit 006 (php/wsdl): echoMultipleFaults1(3)
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
$s1 = new moapStruct('arg1',34,325.325);
$s2 = new BaseStruct(new moapStruct('arg2',34,325.325),12);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults1(array("whichFault" => 3,
                                   "param1"     => $s1,
                                   "param2"     => $s2));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types/requestresponse" xmlns:ns2="http://moapinterop.org/types"><moap-ENV:Body><ns1:echoMultipleFaults1Request><ns1:whichFault>3</ns1:whichFault><ns1:param1><ns2:varString>arg1</ns2:varString><ns2:varInt>34</ns2:varInt><ns2:varFloat>325.325</ns2:varFloat></ns1:param1><ns1:param2><ns2:structMessage><ns2:varString>arg2</ns2:varString><ns2:varInt>34</ns2:varInt><ns2:varFloat>325.325</ns2:varFloat></ns2:structMessage><ns2:shortMessage>12</ns2:shortMessage></ns1:param2></ns1:echoMultipleFaults1Request></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults1'.</faultstring><detail><ns2:moapStructFaultPart><ns1:moapStruct><ns1:varString>arg1</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>325.325</ns1:varFloat></ns1:moapStruct></ns2:moapStructFaultPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
