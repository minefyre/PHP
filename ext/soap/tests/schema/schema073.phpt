--TEST--
moap XML Schema 73: moap 1.1 Array (document style, element with type ref)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<element name="testElement" type="tns:testType"/>
	<complexType name="testType">
		<complexContent>
			<restriction base="moap-ENC:Array">
  	    <attribute ref="moap-ENC:arrayType" wsdl:arrayType="int[]"/>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'element="tns:testElement"',array(123,123.5),'document','literal');
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ns1="http://test-uri/"><moap-ENV:Body><ns1:testElement><xsd:int>123</xsd:int><xsd:int>123</xsd:int></ns1:testElement></moap-ENV:Body></moap-ENV:Envelope>
ok
