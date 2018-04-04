--TEST--
moap XML Schema 54: Apache Map
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
include "test_schema.inc";
$schema = '';
test_schema($schema,'type="apache:Map" xmlns:apache="http://xml.apache.org/xml-moap"',array('a'=>123,'b'=>123.5));
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ns2="http://xml.apache.org/xml-moap" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns2:Map"><item><key xsi:type="xsd:string">a</key><value xsi:type="xsd:int">123</value></item><item><key xsi:type="xsd:string">b</key><value xsi:type="xsd:float">123.5</value></item></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
array(2) {
  ["a"]=>
  int(123)
  ["b"]=>
  float(123.5)
}
ok
