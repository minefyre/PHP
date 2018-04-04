--TEST--
moap 1.2: T56 echoString
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xmlns:enc="http://www.w3.org/2003/05/moap-encoding">
  <env:Header>
    <test:DataHolder xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <test:Data enc:id="data-1" xsi:type="xsd:string">
        hello world
      </test:Data>
    </test:DataHolder>
  </env:Header>
  <env:Body>
    <test:echoString xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <inputString enc:ref="#data-2" xsi:type="xsd:string" />
    </test:echoString>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>env:Receiver</env:Value></env:Code><env:Reason><env:Text>moap-ERROR: Encoding: Unresolved reference '#data-2'</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>

