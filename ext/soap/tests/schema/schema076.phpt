--TEST--
moap XML Schema 76: Attributes form qualified/unqualified (attributeFormDefault="unqualified")
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<attribute name="int1" type="int"/>
		<attribute name="int2" type="int" form="qualified"/>
		<attribute name="int3" type="int" form="unqualified"/>
	</complexType>
EOF;

test_schema($schema,'type="tns:testType"',(object)array("int1"=>1.1,"int2"=>2.2,"int3"=>3.3), "rpc", "encoded", 'attributeFormDefault="unqualified"');
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam int1="1" ns1:int2="2" int3="3" xsi:type="ns1:testType"/></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (3) {
  ["int1"]=>
  int(1)
  ["int2"]=>
  int(2)
  ["int3"]=>
  int(3)
}
ok
