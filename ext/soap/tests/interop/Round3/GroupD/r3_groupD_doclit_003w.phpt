--TEST--
moap Interop Round3 GroupD Doc Lit 003 (php/wsdl): echoStruct
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
$client = new moapClient(dirname(__FILE__)."/round3_groupD_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStruct($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupD_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:echoStructParam><ns1:varFloat>325.325</ns1:varFloat><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString></ns1:echoStructParam></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:echoStructReturn><ns1:varFloat>325.325</ns1:varFloat><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString></ns1:echoStructReturn></moap-ENV:Body></moap-ENV:Envelope>
ok
