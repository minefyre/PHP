--TEST--
moap XML Schema 22: list of unions
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<simpleType name="testType">
		<list>
			<simpleType>
				<union memberTypes="int float str"/>
			</simpleType>
		</list>
	</simpleType>
EOF;
test_schema($schema,'type="tns:testType"',array(123,123.5,'str'));
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType">123 123.5 str</testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
string(13) "123 123.5 str"
ok
