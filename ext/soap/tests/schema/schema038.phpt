--TEST--
moap XML Schema 38: Structure with attributes (ref)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<sequence>
			<element name="str" type="string"/>
		</sequence>
		<attribute ref="tns:int"/>
	</complexType>
	<attribute name="int" type="int"/>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("str"=>"str","int"=>123.5));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam int="123" xsi:type="ns1:testType"><str xsi:type="xsd:string">str</str></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["str"]=>
  string(3) "str"
  ["int"]=>
  int(123)
}
ok
