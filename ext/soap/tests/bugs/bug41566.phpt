--TEST--
Bug #41566 (moap Server not properly generating href attributes)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function test() {
  $aUser = new User();
  $aUser->sName = 'newUser';

  $aUsers = Array();
  $aUsers[] = $aUser;
  $aUsers[] = $aUser;
  $aUsers[] = $aUser;
  $aUsers[] = $aUser;
  return $aUsers;
}

/* Simple User definition */
Class User {
  /** @var string */
  public $sName;
}

$server = new moapserver(null,array('uri'=>"http://testuri.org", 'moap_version'=>moap_1_2));
$server->addfunction("test");

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
  <moap-ENV:Body>
    <ns1:test xmlns:ns1="http://testuri.org" />
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
ob_start();
$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" 
  xmlns:ns1="http://testuri.org" 
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:enc="http://www.w3.org/2003/05/moap-encoding">
  <env:Body>
    <ns1:test env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"/>
  </env:Body>
</env:Envelope>
EOF;
$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";
ob_flush();
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:testResponse><return moap-ENC:arrayType="moap-ENC:Struct[4]" xsi:type="moap-ENC:Array"><item xsi:type="moap-ENC:Struct" id="ref1"><sName xsi:type="xsd:string">newUser</sName></item><item href="#ref1"/><item href="#ref1"/><item href="#ref1"/></return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
<?xml version="1.0" encoding="UTF-8"?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/moap-envelope" xmlns:ns1="http://testuri.org" xmlns:enc="http://www.w3.org/2003/05/moap-encoding" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><env:Body xmlns:rpc="http://www.w3.org/2003/05/moap-rpc"><ns1:testResponse env:encodingStyle="http://www.w3.org/2003/05/moap-encoding"><rpc:result>return</rpc:result><return enc:itemType="enc:Struct" enc:arraySize="4" xsi:type="enc:Array"><item xsi:type="enc:Struct" enc:id="ref1"><sName xsi:type="xsd:string">newUser</sName></item><item enc:ref="#ref1"/><item enc:ref="#ref1"/><item enc:ref="#ref1"/></return></ns1:testResponse></env:Body></env:Envelope>
ok
