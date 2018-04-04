--TEST--
moap XML Schema 6: simpleType/restriction (referenced by ellement)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<simpleType name="testType">
		<restriction>
			<simpleType name="testType2">
		    <restriction base="xsd:int"/>
	    </simpleType>
	  </restriction>
	</simpleType>
	<element name="testElement" type="tns:testType"/>
EOF;
test_schema($schema,'element="tns:testElement"',123.5);
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType">123</testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
int(123)
ok
