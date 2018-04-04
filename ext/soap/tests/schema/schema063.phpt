--TEST--
moap XML Schema 63: standard unsignedLong type
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
include "test_schema.inc";
$schema = '';
test_schema($schema,'type="xsd:unsignedLong"',0xffffffff);
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="xsd:unsignedLong">4294967295</testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
%s(4294967295)
ok
