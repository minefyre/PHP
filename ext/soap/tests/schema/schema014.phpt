--TEST--
moap XML Schema 14: simpleType/union
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<simpleType name="testType">
		<union memberTypes="string int float"/>
	</simpleType>
EOF;
test_schema($schema,'type="tns:testType"',123.5);
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType">123.5</testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
string(5) "123.5"
ok
