--TEST--
moap XML Schema 41: Structure (group)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<group ref="tns:testGroup"/>
	</complexType>
	<group name="testGroup">
		<sequence>
			<element name="int" type="int"/>
			<element name="str" type="string"/>
		</sequence>
	</group>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("str"=>"str","int"=>123.5));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType"><int xsi:type="xsd:int">123</int><str xsi:type="xsd:string">str</str></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["int"]=>
  int(123)
  ["str"]=>
  string(3) "str"
}
ok
