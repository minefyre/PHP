--TEST--
moap Interop Round3 GroupD Compound1 001 (php/wsdl): echoPerson
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
class Person {
    function Person($a=NULL, $i=NULL, $n=NULL, $m=NULL) {
        $this->Age = $a;
        $this->ID = $i;
        $this->Name = $n;
        $this->Male = $m;
    }
}
$person = new Person(32,12345,'Shane',TRUE);
$client = new moapClient(dirname(__FILE__)."/round3_groupD_compound1.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoPerson($person);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupD_compound1.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:x_Person Name="Shane" Male="true"><ns1:Age>32</ns1:Age><ns1:ID>12345</ns1:ID></ns1:x_Person></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/xsd"><moap-ENV:Body><ns1:result_Person Name="Shane" Male="true"><ns1:Age>32</ns1:Age><ns1:ID>12345</ns1:ID></ns1:result_Person></moap-ENV:Body></moap-ENV:Envelope>
ok
