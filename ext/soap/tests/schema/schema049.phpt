--TEST--
moap XML Schema 49: Restriction of complex type (2)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType2">
		<sequence>
			<element name="int" type="int"/>
			<element name="int2" type="int"/>
		</sequence>
	</complexType>
	<complexType name="testType">
		<complexContent>
			<restriction base="tns:testType2">
				<sequence>
					<element name="int2" type="int"/>
				</sequence>
			</restriction>
		</complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("_"=>123.5,"int"=>123.5,"int2"=>123.5));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType"><int2 xsi:type="xsd:int">123</int2></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (1) {
  ["int2"]=>
  int(123)
}
ok
