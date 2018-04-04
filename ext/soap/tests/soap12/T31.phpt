--TEST--
moap 1.2: T31 returnVoid
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"> 
  <env:Body>
    <test:returnVoid xmlns:test="http://example.org/ts-tests">
    </test:returnVoid>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://example.org/ts-tests" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:enc="http://www.w3.org/2003/05/moap-encoding"><env:Body><ns1:returnVoidResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"/></env:Body></env:Envelope>
ok

