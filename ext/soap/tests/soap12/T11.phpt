--TEST--
moap 1.2: T11 unknownHdr
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"> 
  <env:Header>
    <test:Unknown xmlns:test="http://example.org/ts-tests"
          env:role="http://www.w3.org/2003/05/moap-envelope/role/ultimateReceiver"
          env:mustUnderstand="false">foo</test:Unknown>
  </env:Header>
  <env:Body>
  </env:Body>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body/></env:Envelope>
ok
