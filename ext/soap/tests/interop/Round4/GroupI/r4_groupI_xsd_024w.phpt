--TEST--
moap Interop Round4 GroupI XSD 024 (php/wsdl): echoNestedComplexType(minOccurs=0)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
class moapComplexTypeComplexType {
    function moapComplexTypeComplexType($s, $i, $f, $c) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
        $this->varComplexType = $c;
    }
}
$struct = new moapComplexTypeComplexType("arg",34,12.345,NULL);
unset($struct->varComplexType);
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoNestedComplexType(array("inputComplexType"=>$struct));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoNestedComplexType><ns2:inputComplexType><ns1:varString>arg</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns2:inputComplexType></ns2:echoNestedComplexType></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoNestedComplexTypeResponse><ns2:return><ns1:varString>arg</ns1:varString><ns1:varInt>34</ns1:varInt><ns1:varFloat>12.345</ns1:varFloat></ns2:return></ns2:echoNestedComplexTypeResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
