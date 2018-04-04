--TEST--
moap Server 9: setclass and setpersistence(moap_PERSISTENCE_SESSION)
--SKIPIF--
<?php
	require_once('skipif.inc');
	if (!extension_loaded('session')) {
		die('skip this test needs session extension');
	}
?>
--INI--
session.auto_start=1
session.save_handler=files
--FILE--
<?php
class foo {
  private $sum = 0;

  function Sum($num) {
    return $this->sum += $num;
  }
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->setclass("foo");
$server->setpersistence(moap_PERSISTENCE_SESSION);

ob_start();
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
  <moap-ENV:Body>
    <ns1:Sum xmlns:ns1="http://testuri.org">
      <num xsi:type="xsd:int">5</num>
    </ns1:Sum>
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
$server->handle($HTTP_RAW_POST_DATA);
ob_clean();

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="ISO-8859-1"?>
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
  <moap-ENV:Body>
    <ns1:Sum xmlns:ns1="http://testuri.org">
      <num xsi:type="xsd:int">3</num>
    </ns1:Sum>
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
$server->handle($HTTP_RAW_POST_DATA);
ob_end_flush();

echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:SumResponse><return xsi:type="xsd:int">8</return></ns1:SumResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
