--TEST--
moap 1.2: T74 doubleHdr
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"> 
  <env:Header>
    <test:echoOk xmlns:test="http://example.org/ts-tests"
          env:role="http://www.w3.org/2003/05/moap-envelope/role/next">foo</test:echoOk>
    <test:Unknown xmlns:test="http://example.org/ts-tests">
      <test:raiseFault env:mustUnderstand="1" 
            env:role="http://www.w3.org/2003/05/moap-envelope/role/next">
      </test:raiseFault>
    </test:Unknown>
  </env:Header>
  <env:Body>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://example.org/ts-tests"><env:Header><ns1:responseOk>foo</ns1:responseOk></env:Header><env:Body/></env:Envelope>
ok
