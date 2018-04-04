--TEST--
moap Interop Round4 GroupI XSD 014 (php/wsdl): echoComplexTypeMultiOccurs(1)
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
$struct1 = new moapComplexType('arg',34,325.325);
$struct2 = new moapComplexType('arg',34,325.325);
$struct3 = new moapComplexType('arg',34,325.325);
$client = new moapClient(dirname(__FILE__)."/round4_groupI_xsd.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoComplexTypeMultiOccurs(array("inputComplexTypeMultiOccurs"=>array($struct1,$struct2,$struct3)));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupI_xsd.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoComplexTypeMultiOccurs><ns2:inputComplexTypeMultiOccurs><ns2:moapComplexType><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:moapComplexType><ns2:moapComplexType><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:moapComplexType><ns2:moapComplexType><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:moapComplexType></ns2:inputComplexTypeMultiOccurs></ns2:echoComplexTypeMultiOccurs></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd" xmlns:ns2="http://moapinterop.org/"><moap-ENV:Body><ns2:echoComplexTypeMultiOccursResponse><ns2:return><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:return><ns2:return><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:return><ns2:return><ns1:varInt>34</ns1:varInt><ns1:varString>arg</ns1:varString><ns1:varFloat>325.325</ns1:varFloat></ns2:return></ns2:echoComplexTypeMultiOccursResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
