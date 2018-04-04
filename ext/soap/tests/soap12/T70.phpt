--TEST--
moap 1.2: T70 echoOk
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope">
  <env:Header>
	<test:echoOk xmlns:test="http://example.org/ts-tests">foo</test:echoOk>
  </env:Header>
  <env:Body>
  </env:Body>
  <Trailer>
  </Trailer>
</env:Envelope>
EOF;
include "moap12-test.inc";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope"><env:Body><env:Fault><env:Code><env:Value>env:Sender</env:Value></env:Code><env:Reason><env:Text>A moap 1.2 envelope can contain only Header and Body</env:Text></env:Reason></env:Fault></env:Body></env:Envelope>
