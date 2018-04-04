--TEST--
moap 1.2: T59 echoStringArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <env:Body>
    <test:echoStringArray xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <inputStringArray enc:itemType="xsd:string" 
                        xmlns:enc="http://www.w3.org/2003/05/moap-encoding">
        <item enc:id="data" xsi:type="xsd:string" enc:ref="#data">hello</item>
        <item>world</item>
      </inputStringArray>
    </test:echoStringArray>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>env:Receiver</env:Value></env:Code><env:Reason><env:Text>moap-ERROR: Encoding: Violation of id and ref information items '#data'</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>
