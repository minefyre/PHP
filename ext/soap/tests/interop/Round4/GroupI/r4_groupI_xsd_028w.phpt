--TEST--
moap Interop Round4 GroupI XSD 028 (php/wsdl): echoAnyType
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
class moapComplexType {
    function moapComplexType($s, $i, $f) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
    }
}
$struct = new moapComplexType('arg',34,325.325);
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoAnyType(array('inputAnyType'=>new moapVar($struct,moap_ENC_OBJECT,"moapComplexType","http://moapinterop.org/xsd")));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoAnyType><ns2:inputAnyType xsi:type="ns1:moapComplexType"><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:inputAnyType></ns2:echoAnyType></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoAnyTypeResponse><ns2:return xsi:type="ns1:moapComplexType"><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:return></ns2:echoAnyTypeResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
