--TEST--
moap 1.2: T42 echoStructArray
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <env:Body>
    <test:echoStructArray xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <inputStructArray enc:itemType="ns1:moapStruct"
                        enc:arraySize="2"
                        xmlns:ns1="http://example.org/ts-tests/xsd"
                        xmlns:enc="http://www.w3.org/2003/05/moap-encoding">
        <item xsi:type="ns1:moapStruct">
          <varInt xsi:type="xsd:int">42</varInt>
          <varFloat xsi:type="xsd:float">0.005</varFloat>
          <varString xsi:type="xsd:string">hello world</varString>
        </item>
        <item xsi:type="ns1:moapStruct">
          <varInt xsi:type="xsd:int">43</varInt>
          <varFloat xsi:type="xsd:float">0.123</varFloat>
          <varString xsi:type="xsd:string">bye world</varString>
        </item>
      </inputStructArray>
    </test:echoStructArray>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://example.org/ts-tests" xmlns:ns2="http://example.org/ts-tests/xsd" xmlns:enc="http://www.w3.org/2003/05/moap-encoding" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><env:Body xmlns:rpc="http://www.w3.org/2003/05/moap-rpc"><ns1:echoStructArrayResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"><rpc:result>return</rpc:result><return enc:itemType="ns2:moapStruct" enc:arraySize="2" xsi:type="ns2:ArrayOfmoapStruct"><item xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">hello world</varString><varInt xsi:type="xsd:int">42</varInt><varFloat xsi:type="xsd:float">0.005</varFloat></item><item xsi:type="ns2:moapStruct"><varString xsi:type="xsd:string">bye world</varString><varInt xsi:type="xsd:int">43</varInt><varFloat xsi:type="xsd:float">0.123</varFloat></item></return></ns1:echoStructArrayResponse></env:Body></env:Envelope>
ok
