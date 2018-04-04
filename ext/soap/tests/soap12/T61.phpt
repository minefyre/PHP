--TEST--
moap 1.2: T61 countItems
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <env:Body>
    <test:countItems xmlns:test="http://example.org/ts-tests"
          xmlns:enc="http://www.w3.org/2003/05/moap-encoding"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <inputStringArray enc:itemType="xsd:string" enc:arraySize="2 *">
        <item xsi:type="xsd:string">hello</item>
        <item xsi:type="xsd:string">world</item>
      </inputStringArray>
    </test:countItems>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>env:Receiver</env:Value></env:Code><env:Reason><env:Text>moap-ERROR: Encoding: '*' may only be first arraySize value in list</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>
