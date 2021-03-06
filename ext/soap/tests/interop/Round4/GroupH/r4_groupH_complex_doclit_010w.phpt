--TEST--
moap Interop Round4 GroupH Complex Doc Lit 010 (php/wsdl): echoMultipleFaults2(4)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
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
class MoreExtendedStruct extends ExtendedStruct {
    function MoreExtendedStruct($f, $s, $x1, $x2, $x3, $b) {
        $this->ExtendedStruct($f, $s, $x1, $x2, $x3);
        $this->booleanMessage = $b;
    }
}
$s1 = new BaseStruct(new moapStruct("s1",1,1.1),1);
$s2 = new ExtendedStruct(new moapStruct("s2",2,2.2),2,"arg",-3,5);
$s3 = new MoreExtendedStruct(new moapStruct("s3",3,3.3),3,"arg",-3,5,true);
$client = new moapClient(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoMultipleFaults2(array("whichFault" => 4,
                                   "param1"     => $s1,
                                   "param2"     => $s2,
                                   "param3"     => $s3));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round4_groupH_complex_doclit.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types/requestresponse" xmlns:ns2="http://moapinterop.org/types"><moap-ENV:Body><ns1:echoMultipleFaults2Request><ns1:whichFault>4</ns1:whichFault><ns1:param1><ns2:structMessage><ns2:varString>s1</ns2:varString><ns2:varInt>1</ns2:varInt><ns2:varFloat>1.1</ns2:varFloat></ns2:structMessage><ns2:shortMessage>1</ns2:shortMessage></ns1:param1><ns1:param2><ns2:structMessage><ns2:varString>s2</ns2:varString><ns2:varInt>2</ns2:varInt><ns2:varFloat>2.2</ns2:varFloat></ns2:structMessage><ns2:shortMessage>2</ns2:shortMessage><ns2:stringMessage>arg</ns2:stringMessage><ns2:intMessage>-3</ns2:intMessage><ns2:anotherIntMessage>5</ns2:anotherIntMessage></ns1:param2><ns1:param3><ns2:structMessage><ns2:varString>s3</ns2:varString><ns2:varInt>3</ns2:varInt><ns2:varFloat>3.3</ns2:varFloat></ns2:structMessage><ns2:shortMessage>3</ns2:shortMessage><ns2:stringMessage>arg</ns2:stringMessage><ns2:intMessage>-3</ns2:intMessage><ns2:anotherIntMessage>5</ns2:anotherIntMessage><ns2:booleanMessage>true</ns2:booleanMessage></ns1:param3></ns1:echoMultipleFaults2Request></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/types" xmlns:ns2="http://moapinterop.org/types/part"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Fault in response to 'echoMultipleFaults2'.</faultstring><detail><ns2:BaseStructPart><ns1:structMessage><ns1:varString>s1</ns1:varString><ns1:varInt>1</ns1:varInt><ns1:varFloat>1.1</ns1:varFloat></ns1:structMessage><ns1:shortMessage>1</ns1:shortMessage></ns2:BaseStructPart></detail></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
ok
