--TEST--
moap 1.2: T53 echoDate
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <env:Body>
    <test:echoDate xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <inputDate xsi:type="xsd:date">1956-10-18T22:20:00-07:00</inputDate>
    </test:echoDate>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://example.org/ts-tests" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/moap-encoding"><env:Body xmlns:rpc="http://www.w3.org/2003/05/moap-rpc"><ns1:echoDateResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"><rpc:result>return</rpc:result><return xsi:type="xsd:dateTime">1956-10-18T22:20:00-07:00</return></ns1:echoDateResponse></env:Body></env:Envelope>
ok
