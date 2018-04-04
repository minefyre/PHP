--TEST--
Bug #31422 (No Error-Logging on moapServer-Side)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
log_errors=1
--FILE--
<?php
function Add($x,$y) {
	fopen();
	user_error("Hello", E_USER_ERROR);
  return $x+$y;
}

$server = new moapServer(null,array('uri'=>"http://testuri.org"));
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
--EXPECTF--
PHP Warning:  fopen() expects at least 2 parameters, 0 given in %sbug31422.php on line %d
PHP Fatal error:  Hello in %sbug31422.php on line %d
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Hello</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
