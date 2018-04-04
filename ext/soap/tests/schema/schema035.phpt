--TEST--
moap XML Schema 35: Nested complex types (element ref + anonymous type)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<element name="testType2">
		<complexType>
			<sequence>
				<element name="int" type="int"/>
			</sequence>
		</complexType>
	</element>
	<complexType name="testType">
		<sequence>
			<element name="int" type="int"/>
			<element ref="tns:testType2"/>
		</sequence>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("int"=>123.5,"testType2"=>array("int"=>123.5)));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType"><int xsi:type="xsd:int">123</int><testType2 xsi:type="ns1:testType2"><int xsi:type="xsd:int">123</int></testType2></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["int"]=>
  int(123)
  ["testType2"]=>
  object(stdClass)#%d (1) {
    ["int"]=>
    int(123)
  }
}
ok
