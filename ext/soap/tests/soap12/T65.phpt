--TEST--
moap 1.2: T65 echoOk
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<!DOCTYPE DOC [
<!ELEMENT Envelope (Body) >
<!ELEMENT Body (echoOk) >
<!ELEMENT echoOk (#PCDATA) >
]>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"> 
  <env:Body>
    <test:echoOk xmlns:test="http://example.org/ts-tests">
      foo
    </test:echoOk>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>env:Receiver</env:Value></env:Code><env:Reason><env:Text>DTD are not supported by moap</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>
