--TEST--
moap Server 13: array handling
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function Sum($a) {
  $sum = 0;
  if (is_array($a)) {
    foreach($a as $val) {
      $sum += $val;
    }
  }
  return $sum;
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("Sum");

$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <moap-ENV:Body xmlns:ns1="http://linuxsrv.home/~dmitry/moap/">
    <ns1:sum>
      <param0 moap-ENC:arrayType="xsd:int[2]" xsi:type="moap-ENC:Array">
        <val xsi:type="xsd:int">3</val>
        <val xsi:type="xsd:int">5</val>
      </param0>
    </ns1:sum>
  </moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:sumResponse><return xsi:type="xsd:int">8</return></ns1:sumResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
