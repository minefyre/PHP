--TEST--
moap 1.2: T73 echoString
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
    <test:echoString xmlns:test="http://example.org/ts-tests"
                     env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">
      <test:inputString xsi:type="xsd:string"
            env:encodingStyle="http://www.w3.org/2003/05/moap-encoding">hello world</test:inputString>
    </test:echoString>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://example.org/ts-tests" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/moap-encoding"><env:Body xmlns:rpc="http://www.w3.org/2003/05/moap-rpc"><ns1:echoStringResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"><rpc:result>return</rpc:result><return xsi:type="xsd:string">hello world</return></ns1:echoStringResponse></env:Body></env:Envelope>
ok
