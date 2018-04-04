--TEST--
moap Server 2: function with parameters and result
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function Add($x,$y) {
  return $x+$y;
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("Add");

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
  <moap-ENV:Body>
    <ns1:Add xmlns:ns1="http://testuri.org">
      <x xsi:type="xsd:int">22</x>
      <y xsi:type="xsd:int">33</y>
    </ns1:Add>
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;

$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:AddResponse><return xsi:type="xsd:int">55</return></ns1:AddResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
