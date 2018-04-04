--TEST--
moap Interop Round4 GroupH Complex Doc Lit 001 (php/wsdl): echomoapStructFault
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
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echomoapStructFault($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/requestresponse"><moap-ENV:Body><ns2:echomoapStructFaultRequest><ns1:varString>arg</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>325.325</ns1:varFloat></ns2:echomoapStructFaultRequest></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echomoapStructFault'.</faultstring><detail><ns2:moapStructFaultPart><ns1:moapStruct><ns1:varString>arg</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>325.325</ns1:varFloat></ns1:moapStruct></ns2:moapStructFaultPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
